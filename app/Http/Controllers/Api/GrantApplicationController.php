<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Grant;
use App\Models\GrantClaim;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
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
            
            // ✅ Calculate credit cost
            $creditCost = $this->getCreditCost($grant->grantType->grant_type);
            $currentScore = $user->creditScore->score ?? 0;
            
            // ✅ VALIDATION 1: Check credit score sufficiency (IMMEDIATE DEDUCTION)
            if ($currentScore < $creditCost) {
                return response()->json([
                    'success' => false,
                    'message' => "Insufficient credits. You need {$creditCost} credits to apply for this grant. Current balance: {$currentScore} credits."
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

            // ✅ All validations passed - Use database transaction
            DB::beginTransaction();
            
            try {
                // ✅ Create application
                $application = Application::create([
                    'user_id' => $user->id,
                    'grant_id' => $request->grant_id,
                    'status_id' => 3, // pending
                    'application_type' => 'Grant Application',
                    'purpose' => $request->purpose ?? 'Grant assistance request',
                ]);

                // ✅ DEDUCT CREDITS IMMEDIATELY
                $user->creditScore->decrement('score', $creditCost);
                
                // ✅ Log credit history
                $user->creditScoreHistory()->create([
                    'activity' => 'Grant Application - ' . $grant->grantType->grant_type,
                    'points' => -$creditCost
                ]);
                
                DB::commit();
                
                $application->load(['user', 'grant.grantType', 'status']);
                
                $newScore = $user->creditScore->fresh()->score;

                Log::info('Grant application submitted with credit deduction', [
                    'application_id' => $application->id,
                    'user_id' => $user->id,
                    'credits_deducted' => $creditCost,
                    'previous_score' => $currentScore,
                    'new_score' => $newScore
                ]);

                return response()->json([
                    'success' => true,
                    'message' => "Application submitted successfully! {$creditCost} credits have been deducted.",
                    'data' => $application,
                    'credits_deducted' => $creditCost,
                    'remaining_credits' => $newScore
                ], 201);
                
            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }

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
            $application = Application::with([
                'grant.grantType',
                'user.creditScore'
            ])->findOrFail($applicationId);
            
            DB::beginTransaction();
            
            try {
                // ✅ Update application status
                $application->update(['status_id' => 4]); // Approved
                
                // ✅ Create grant claim record
                GrantClaim::create([
                    'application_id' => $application->id,
                    'user_id' => $application->user_id,
                    'reference_number' => 'REF-' . strtoupper(Str::random(12)),
                    'qr_code' => Str::uuid()->toString(),
                    'claim_status' => 'claimable',
                    'valid_until' => now()->addDays(30),
                ]);
                
                DB::commit();
                
                Log::info('Grant approved and claim created', [
                    'application_id' => $applicationId,
                    'user_id' => $application->user->id
                ]);
                
                return response()->json([
                    'success' => true,
                    'message' => 'Grant application approved successfully!'
                ]);
                
            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }
            
        } catch (\Exception $e) {
            Log::error('Approve grant error', [
                'application_id' => $applicationId,
                'error' => $e->getMessage()
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
            $application = Application::with([
                'grant.grantType',
                'user.creditScore'
            ])->findOrFail($applicationId);
            
            $creditCost = $this->getCreditCost($application->grant->grantType->grant_type);
            
            DB::beginTransaction();
            
            try {
                // ✅ Update status to rejected
                $application->update(['status_id' => 6]);
                
                // ✅ REFUND credits since application was rejected
                $application->user->creditScore->increment('score', $creditCost);
                
                // ✅ Log credit refund
                $application->user->creditScoreHistory()->create([
                    'activity' => 'Grant Rejected (Refund) - ' . $application->grant->grantType->grant_type,
                    'points' => $creditCost
                ]);
                
                DB::commit();
                
                Log::info('Grant rejected and credits refunded', [
                    'application_id' => $applicationId,
                    'credits_refunded' => $creditCost
                ]);
                
                return response()->json([
                    'success' => true,
                    'message' => "Grant application rejected. {$creditCost} credits have been refunded."
                ]);
                
            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }
            
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

    /**
     * ✅ UPDATED: Get all grant applications with status object and status histories
     */
    public function index(): JsonResponse
    {
        try {
            $applications = Application::with([
                'user',
                'grant.grantType',
                'grant.grantRequirements',
                'status',                    // ✅ Load status relationship
                'statusHistories.status'    // ✅ Load status histories with their status objects
            ])
                ->where('user_id', auth()->id())
                ->whereNotNull('grant_id')
                ->orderBy('created_at', 'desc')
                ->get();

            $transformedApplications = $applications->map(function ($app) {
                if (!$app->grant || !$app->grant->grantType) {
                    return null;
                }

                return [
                    'id' => $app->id,
                    'user_id' => $app->user_id,
                    'grant_id' => $app->grant_id,
                    'status_id' => $app->status_id,
                    'status' => $app->status,  // ✅ FIXED: Return entire status object
                    'status_histories' => $app->statusHistories->map(function($history) {
                        return [
                            'id' => $history->id,
                            'application_id' => $history->application_id,
                            'status_id' => $history->status_id,
                            'created_at' => $history->created_at,
                            'status' => $history->status, // ✅ Include status object
                        ];
                    }),
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
            })->filter();

            return response()->json([
                'success' => true,
                'data' => $transformedApplications->values()
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

    // ✅ NEW: Get grant claim details for Claim screen
    public function getClaimDetails($id): JsonResponse
    {
        try {
            $claim = GrantClaim::with(['application.grant.grantType', 'user'])
                ->where('user_id', auth()->id())
                ->where('application_id', $id)
                ->where('claim_status', 'claimable')
                ->firstOrFail();

            return response()->json([
                'success' => true,
                'application' => [
                    'id' => $claim->application->id,
                    'grant' => [
                        'name' => $claim->application->grant->title,
                        'amount' => $this->extractAmount($claim->application->grant->description),
                    ],
                    'reference_number' => $claim->reference_number,
                    'qr_code' => $claim->qr_code,
                    'valid_until' => $claim->valid_until->format('Y-m-d'),
                    'grant_status' => $claim->claim_status,
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Get claim details error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Grant application not found or not claimable.'
            ], 404);
        }
    }

    // ✅ NEW: Mark grant as claimed
    public function markAsClaimed($applicationId): JsonResponse
    {
        try {
            $claim = GrantClaim::where('application_id', $applicationId)
                ->where('user_id', auth()->id())
                ->where('claim_status', 'claimable')
                ->firstOrFail();
            
            DB::beginTransaction();
            
            try {
                $claim->update([
                    'claim_status' => 'claimed',
                    'claimed_at' => now(),
                ]);
                
                // Update application status to completed
                $claim->application->update(['status_id' => 5]);
                
                DB::commit();
                
                return response()->json([
                    'success' => true,
                    'message' => 'Grant marked as claimed successfully!'
                ]);
            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }
        } catch (\Exception $e) {
            Log::error('Mark as claimed error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to mark grant as claimed.'
            ], 404);
        }
    }

    // ✅ Helper method to extract amount from description
    private function extractAmount($description): string
    {
        if (!$description) return '0';
        
        // Try to extract PHP amount
        if (preg_match('/PHP\s*([\d,]+\.?\d*)/', $description, $matches)) {
            return str_replace(',', '', $matches[1]);
        }
        
        // Try to extract kg amount
        if (preg_match('/(\d+)\s*kg/', $description, $matches)) {
            return $matches[1] . ' kg';
        }
        
        return '0';
    }
}
