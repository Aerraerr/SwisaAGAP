<?php

namespace App\Http\Controllers\mobile;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Grant;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class GrantApplicationController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        try {
            Log::info('Grant application request:', $request->all());

            $validator = Validator::make($request->all(), [
                'grant_id' => 'required|integer|exists:grants,id',
                'purpose' => 'nullable|string|max:500',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 422);
            }

            $user = $request->user();
            $grant = Grant::with('grantType')->findOrFail($request->grant_id);
            
            // ✅ VALIDATION 1: Check credit score sufficiency
            $currentScore = $user->creditScore->score ?? 0;
            $creditCost = $this->getCreditCost($grant->grantType->grant_type);
            
            if ($currentScore - $creditCost < 0) {
                return response()->json([
                    'success' => false,
                    'message' => "Insufficient credits. You need at least {$creditCost} credits to apply for this grant. Current balance: {$currentScore} credits."
                ], 403);
            }
            
            // ✅ VALIDATION 2: Check for duplicate ongoing application
            $ongoingApplication = Application::where('user_id', $user->id)
                ->where('grant_id', $grant->id)
                ->whereIn('status_id', [3, 4, 7])
                ->exists();
                
            if ($ongoingApplication) {
                return response()->json([
                    'success' => false,
                    'message' => 'You already have an ongoing application for this grant.'
                ], 403);
            }
            
            // ✅ VALIDATION 3: Check quarterly application limits
            $quarterStart = Carbon::now()->startOfQuarter();
            $quarterEnd = Carbon::now()->endOfQuarter();
            
            $quarterlyApplications = Application::where('user_id', $user->id)
                ->whereBetween('created_at', [$quarterStart, $quarterEnd])
                ->whereNotNull('grant_id')
                ->whereIn('status_id', [3, 4, 5, 7])
                ->with('grant.grantType')
                ->get();
            
            $grantTypeName = $grant->grantType->grant_type;
            
            // Check Equipment/Machinery Grant limit (1 per quarter each)
            if (in_array($grantTypeName, ['Equipment Grant', 'Machinery Grant'])) {
                $existingSameType = $quarterlyApplications->filter(function($app) use ($grantTypeName) {
                    return $app->grant && $app->grant->grantType && 
                           $app->grant->grantType->grant_type === $grantTypeName;
                })->count();
                
                if ($existingSameType >= 1) {
                    return response()->json([
                        'success' => false,
                        'message' => "You can only apply for {$grantTypeName} once per quarter (3 months)."
                    ], 403);
                }
            } else {
                // Check other grants limit (2 total per quarter)
                $existingOtherGrants = $quarterlyApplications->filter(function($app) {
                    if (!$app->grant || !$app->grant->grantType) return false;
                    $type = $app->grant->grantType->grant_type;
                    return !in_array($type, ['Equipment Grant', 'Machinery Grant']);
                })->count();
                
                if ($existingOtherGrants >= 2) {
                    return response()->json([
                        'success' => false,
                        'message' => 'You can only apply for a maximum of 2 grants per quarter (excluding Equipment and Machinery grants).'
                    ], 403);
                }
            }

            // ✅ All validations passed - Create application
            $application = Application::create([
                'user_id' => $user->id,
                'grant_id' => $request->grant_id,
                'status_id' => 3, // pending
                'application_type' => 'Grant Application',
                'purpose' => $request->purpose ?? 'Grant assistance request',
            ]);

            $application->load(['user', 'grant.grantType', 'status']);

            return response()->json([
                'success' => true,
                'message' => 'Application submitted successfully',
                'data' => $application,
                'credit_cost_on_approval' => $creditCost
            ], 201);

        } catch (\Exception $e) {
            Log::error('Grant application error: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to submit application: ' . $e->getMessage()
            ], 500);
        }
    }

    private function getCreditCost(string $grantType): int
    {
        if (in_array($grantType, ['Equipment Grant', 'Machinery Grant'])) {
            return 15;
        }
        return 10;
    }

    public function approve($applicationId): JsonResponse
{
    try {
        // ✅ Load all necessary relationships
        $application = Application::with([
            'grant.grantType',
            'user.creditScore'
        ])->findOrFail($applicationId);
        
        $user = $application->user;
        
        // ✅ Check if user has creditScore relationship
        if (!$user->creditScore) {
            Log::error('User has no credit score', ['user_id' => $user->id]);
            return response()->json([
                'success' => false,
                'message' => 'User credit score not found'
            ], 404);
        }
        
        // ✅ Check if grant has grantType relationship
        if (!$application->grant || !$application->grant->grantType) {
            Log::error('Grant or GrantType not found', [
                'application_id' => $applicationId,
                'grant_id' => $application->grant_id
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Grant information not found'
            ], 404);
        }
        
        $creditCost = $this->getCreditCost($application->grant->grantType->grant_type);
        
        Log::info('Approving grant application', [
            'application_id' => $applicationId,
            'user_id' => $user->id,
            'current_credits' => $user->creditScore->score,
            'credit_cost' => $creditCost,
            'grant_type' => $application->grant->grantType->grant_type
        ]);
        
        // ✅ Update application status
        $application->update(['status_id' => 4]);
        
        // ✅ Deduct credits
        $user->creditScore->decrement('score', $creditCost);
        
        // ✅ Log credit history
        $user->creditScoreHistory()->create([
            'activity' => 'Grant Approved - ' . $application->grant->grantType->grant_type,
            'points' => -$creditCost
        ]);
        
        // ✅ Get updated credit score
        $newScore = $user->creditScore->fresh()->score;
        
        Log::info('Grant approved successfully', [
            'application_id' => $applicationId,
            'credits_deducted' => $creditCost,
            'new_score' => $newScore
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Grant application approved successfully!',
            'credits_deducted' => $creditCost,
            'remaining_credits' => $newScore
        ]);
        
    } catch (\Exception $e) {
        Log::error('Approve grant error', [
            'application_id' => $applicationId,
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
        
        return response()->json([
            'success' => false,
            'message' => 'Failed to approve application: ' . $e->getMessage()
        ], 500);
    }
    }

    
    public function reject($applicationId): JsonResponse
    {
        try {
            $application = Application::findOrFail($applicationId);
            $application->update(['status_id' => 6]);
            
            return response()->json([
                'success' => true,
                'message' => 'Grant application rejected.'
            ]);
        } catch (\Exception $e) {
            Log::error('Reject grant error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to reject application'
            ], 500);
        }
    }
    
    public function complete($applicationId): JsonResponse
    {
        try {
            $application = Application::findOrFail($applicationId);
            $application->update(['status_id' => 5]);
            
            return response()->json([
                'success' => true,
                'message' => 'Grant marked as completed.'
            ]);
        } catch (\Exception $e) {
            Log::error('Complete grant error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to complete application'
            ], 500);
        }
    }

    public function index(): JsonResponse
    {
        try {
            $applications = Application::with(['user', 'grant.grantType', 'status'])
                ->where('user_id', auth()->id())
                ->whereNotNull('grant_id') // ✅ Only grant applications
                ->orderBy('created_at', 'desc')
                ->get();

            $transformedApplications = $applications->map(function ($app) {
                // ✅ Add null safety checks
                if (!$app->grant || !$app->grant->grantType) {
                    return null;
                }

                return [
                    'id' => $app->id,
                    'user_id' => $app->user_id,
                    'grant_id' => $app->grant_id,
                    'status' => $app->status->status_name ?? 'pending',
                    'purpose' => $app->purpose,
                    'application_type' => $app->application_type,
                    'created_at' => $app->created_at,
                    'updated_at' => $app->updated_at,
                    'grant' => [
                        'id' => $app->grant->id,
                        'title' => $app->grant->title,
                        'description' => $app->grant->description,
                        'total_quantity' => $app->grant->total_quantity,
                        'unit_per_request' => $app->grant->unit_per_request,
                        'available_at' => $app->grant->available_at,
                        'end_at' => $app->grant->end_at,
                        'grant_type' => [
                            'id' => $app->grant->grantType->id,
                            'grant_type' => $app->grant->grantType->grant_type,
                        ],
                        'grant_requirements' => $app->grant->grantRequirements ?? [],
                    ],
                ];
            })->filter(); // ✅ Remove null values

            return response()->json([
                'success' => true,
                'data' => $transformedApplications->values() // ✅ Re-index array
            ]);
        } catch (\Exception $e) {
            Log::error('Fetch applications error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch applications'
            ], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $application = Application::with(['user', 'grant.grantType', 'status', 'documents'])
                ->where('user_id', auth()->id())
                ->find($id);

            if (!$application) {
                return response()->json([
                    'success' => false,
                    'message' => 'Application not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $application
            ]);
        } catch (\Exception $e) {
            Log::error('Show application error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Application not found'
            ], 404);
        }
    }
}
