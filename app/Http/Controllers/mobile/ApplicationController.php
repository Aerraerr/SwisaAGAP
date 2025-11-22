<?php

namespace App\Http\Controllers\mobile;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Document;
use App\Models\Contribution;
use App\Models\ApplicationStatusHistory;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ApplicationController extends Controller
{
    /**
     * ✅ GET SINGLE APPLICATION BY ID - WITH STATUS HISTORY NAMES & DATES
     */
    public function show($id)
    {
        try {
            Log::info('📋 FETCHING APPLICATION: ' . $id);

            $application = Application::with([
                'user',
                'grant.grantType',
                'grant.grantRequirements.requirement',
                'status',
                'documents.grantRequirement',
            ])
            ->where('id', $id)
            ->where('user_id', auth()->id())
            ->first();

            if (!$application) {
                Log::warning('❌ Application not found or unauthorized: ' . $id);
                return response()->json([
                    'success' => false,
                    'message' => 'Application not found or unauthorized'
                ], 404);
            }

            Log::info('✅ Application found: ' . $application->id);

            $statusHistories = DB::table('application_status_histories')
                ->join('statuses', 'application_status_histories.status_id', '=', 'statuses.id')
                ->where('application_status_histories.application_id', $id)
                ->orderBy('application_status_histories.created_at', 'asc')
                ->select(
                    'application_status_histories.id',
                    'application_status_histories.status_id',
                    'statuses.status_name',
                    'application_status_histories.created_at'
                )
                ->get();

            Log::info('📊 Status histories count: ' . $statusHistories->count());
            foreach ($statusHistories as $history) {
                Log::info('  - ' . $history->status_name . ' at ' . $history->created_at);
            }

            return response()->json([
                'success' => true,
                'application' => [
                    'id' => $application->id,
                    'user_id' => $application->user_id,
                    'grant_id' => $application->grant_id,
                    'status_id' => $application->status_id,
                    'created_at' => $application->created_at?->toIso8601String(),
                    'updated_at' => $application->updated_at?->toIso8601String(),
                    
                    'status' => [
                        'id' => $application->status->id,
                        'status_name' => $application->status->status_name,
                    ],
                    
                    'grant' => [
                        'id' => $application->grant->id,
                        'title' => $application->grant->title ?? $application->grant->grant_name,
                        'grant_name' => $application->grant->grant_name ?? $application->grant->title,
                        'description' => $application->grant->description,
                        'total_quantity' => $application->grant->total_quantity ?? $application->grant->applicant_limit,
                        'applicant_limit' => $application->grant->applicant_limit ?? $application->grant->total_quantity,
                        
                        'grant_type' => [
                            'id' => $application->grant->grantType->id ?? null,
                            'grant_type' => $application->grant->grantType->grant_type ?? 'Cash Grant',
                        ],
                        
                        'grant_requirements' => $application->grant->grantRequirements->map(function ($gr) {
                            return [
                                'id' => $gr->id,
                                'requirement_id' => $gr->requirement_id,
                                'requirement_name' => $gr->requirement->requirement_name ?? 'Valid ID',
                                'name' => $gr->requirement->requirement_name ?? 'Valid ID',
                                'description' => $gr->requirement->description ?? 'Please upload a clear photo',
                            ];
                        }),
                    ],
                    
                    'documents' => $application->documents->map(function ($doc) {
                        return [
                            'id' => $doc->id,
                            'file_name' => $doc->file_name,
                            'file_path' => $doc->file_path,
                            'file_type' => $doc->file_type,
                            'file_size' => $doc->file_size,
                            'document_type' => $doc->document_type,
                            'created_at' => $doc->created_at?->toIso8601String(),
                            'grant_requirement_id' => $doc->grant_requirement_id,
                        ];
                    }),
                    
                    'status_histories' => $statusHistories->map(function ($history) {
                        return [
                            'id' => $history->id,
                            'status_id' => $history->status_id,
                            'status_name' => $history->status_name,
                            'created_at' => $history->created_at,
                        ];
                    }),
                ],
            ], 200);

        } catch (\Exception $e) {
            Log::error('❌ FETCH APPLICATION ERROR: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch application',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * ✅ CLAIM GRANT - Transition from 'approved' to 'claimed'
     */
    public function claimGrant($id)
    {
        try {
            Log::info('🎯 CLAIM GRANT STARTED - Application ID: ' . $id);

            $app = Application::findOrFail($id);
            Log::info('✅ Step 1: Application found');

            if ($app->user_id !== auth()->id()) {
                Log::error('❌ Step 2: Unauthorized');
                return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
            }
            Log::info('✅ Step 2: Ownership verified');

            $currentStatus = $app->status->status_name ?? null;
            if ($currentStatus !== 'approved') {
                Log::error('❌ Step 3: Not approved - Current status: ' . $currentStatus);
                return response()->json([
                    'success' => false,
                    'message' => 'Application must be approved to claim'
                ], 400);
            }
            Log::info('✅ Step 3: Status check passed (approved)');

            $claimedStatus = Status::where('status_name', 'claimed')->firstOrFail();
            Log::info('✅ Step 4: Claimed status found - ID: ' . $claimedStatus->id);

            $now = now();
            $app->status_id = $claimedStatus->id;
            $app->updated_at = $now;
            $app->save();
            Log::info('✅ Step 5: Application status updated to claimed');

            ApplicationStatusHistory::create([
                'application_id' => $id,
                'status_id' => $claimedStatus->id,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            Log::info('✅ Step 6: Status history created');

            Log::info('✅ CLAIM GRANT SUCCESS!');

            return response()->json([
                'success' => true,
                'message' => 'Grant claimed successfully!',
                'data' => [
                    'application_id' => $id,
                    'status' => $claimedStatus->status_name,
                    'timestamp' => $now->toIso8601String()
                ]
            ], 200);

        } catch (\Exception $e) {
            Log::error('❌ CLAIM GRANT ERROR: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * ✅ RESUBMIT APPLICATION DOCUMENTS
     */
    public function resubmit(Request $request, $id)
    {
        try {
            Log::info('🔍 RESUBMIT STARTED - ID: ' . $id);

            $app = Application::findOrFail($id);
            Log::info('✅ Step 1: App found');

            if ($app->user_id !== auth()->id()) {
                Log::error('❌ Step 2: Unauthorized');
                return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
            }
            Log::info('✅ Step 2: Ownership OK');

            $currentStatus = $app->status->status_name ?? null;
            if ($currentStatus !== 'on_hold') {
                Log::error('❌ Step 3: Not on hold - Current status: ' . $currentStatus);
                return response()->json(['success' => false, 'message' => 'Application is not on hold'], 400);
            }
            Log::info('✅ Step 3: Status check passed (on_hold)');

            $validated = $request->validate([
                'documents' => 'required|array',
                'documents.*' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10240',
            ]);
            Log::info('✅ Step 4: File validation passed');

            foreach ($app->documents as $doc) {
                try {
                    if (Storage::disk('public')->exists($doc->file_path)) {
                        Storage::disk('public')->delete($doc->file_path);
                    }
                } catch (\Exception $e) {
                    Log::warning('File delete warning: ' . $e->getMessage());
                }
                $doc->forceDelete();
            }
            Log::info('✅ Step 5: Old documents deleted');

            $newDocs = [];
            foreach ($request->file('documents') as $reqId => $file) {
                $filename = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('documents/applications/' . $id, $filename, 'public');

                $newDoc = new Document();
                $newDoc->documentable_type = Application::class;
                $newDoc->documentable_id = $id;
                $newDoc->document_type = 'resubmission';
                $newDoc->file_path = $path;
                $newDoc->file_name = $file->getClientOriginalName();
                $newDoc->file_type = $file->getClientMimeType();
                $newDoc->file_size = $file->getSize();
                $newDoc->requirement_id = $reqId;
                $newDoc->grant_requirement_id = $reqId;
                $newDoc->status_id = 3;
                $newDoc->save();
                
                $newDocs[] = $newDoc;
            }
            Log::info('✅ Step 6: New documents uploaded - Count: ' . count($newDocs));

            $processingStatus = Status::where('status_name', 'processing_application')->first();
            if (!$processingStatus) {
                Log::error('❌ Step 7: Processing status not found');
                return response()->json(['success' => false, 'message' => 'Processing status not found'], 500);
            }
            Log::info('✅ Step 7: Processing status found - ID: ' . $processingStatus->id);

            $now = now();

            $app->status_id = $processingStatus->id;
            $app->updated_at = $now;
            $app->save();
            Log::info('✅ Step 8: Application table updated');

            ApplicationStatusHistory::create([
                'application_id' => $id,
                'status_id' => $processingStatus->id,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            Log::info('✅ Step 9: Status history created at: ' . $now);

            Log::info('✅ RESUBMIT SUCCESS!');

            return response()->json([
                'success' => true,
                'message' => 'Documents resubmitted successfully!',
                'data' => [
                    'application_id' => $id,
                    'status' => $processingStatus->status_name,
                    'documents' => count($newDocs),
                    'timestamp' => $now->toIso8601String()
                ]
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('❌ Validation error: ' . json_encode($e->errors()));
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('❌ RESUBMIT ERROR: ' . $e->getMessage());
            Log::error('Line: ' . $e->getLine() . ' File: ' . $e->getFile());
            Log::error('Trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * ✅ SUBMIT CONTRIBUTION - NO CREDIT SCORE
     * Grant Application status → 'completed' | Contribution status → 'pending' (admin review)
     */
    public function contribute(Request $request, $id)
    {
        try {
            Log::info('🎯 CONTRIBUTION STARTED - Application ID: ' . $id);

            $app = Application::findOrFail($id);
            Log::info('✅ Step 1: Application found');

            if ($app->user_id !== auth()->id()) {
                Log::error('❌ Step 2: Unauthorized');
                return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
            }
            Log::info('✅ Step 2: Ownership verified');

            $currentStatus = $app->status->status_name ?? null;
            if ($currentStatus !== 'claimed') {
                Log::error('❌ Step 3: Not claimed - Current status: ' . $currentStatus);
                return response()->json([
                    'success' => false,
                    'message' => 'Grant must be claimed before contributing'
                ], 400);
            }
            Log::info('✅ Step 3: Status check passed (claimed)');

            $validated = $request->validate([
                'type' => 'required|string|max:50',
                'quantity' => 'required|integer|min:1',
                'quantity_unit' => 'required|string|max:20',
                'image' => 'required|image|mimes:jpg,jpeg,png|max:5120',
                'notes' => 'nullable|string|max:500',
            ]);
            Log::info('✅ Step 4: Validation passed');

            $imagePath = $request->file('image')->store('contributions', 'public');
            Log::info('✅ Step 5: Image uploaded - Path: ' . $imagePath);

            // ✅ STEP 6: Find 'pending' status for contribution (admin review)
            $pendingStatus = Status::where('status_name', 'pending')->first();
            if (!$pendingStatus) {
                Log::error('❌ Step 6: Pending status not found');
                return response()->json(['success' => false, 'message' => 'Pending status not found'], 500);
            }
            Log::info('✅ Step 6: Pending status found - ID: ' . $pendingStatus->id);

            // ✅ STEP 7: Create contribution with 'pending' status (admin review)
            $contribution = new Contribution();
            $contribution->application_id = $id;
            $contribution->user_id = auth()->id();
            $contribution->type = $validated['type'];
            $contribution->quantity = $validated['quantity'];
            $contribution->quantity_unit = $validated['quantity_unit'];
            $contribution->image_path = $imagePath;
            $contribution->notes = $validated['notes'] ?? null;
            $contribution->status_id = $pendingStatus->id; // ✅ Contribution pending for admin review
            $contribution->save();
            
            Log::info('✅ Step 7: Contribution created with pending status - ID: ' . $contribution->id);

            // ✅ STEP 8: Find 'completed' status for application (grant itself)
            $completedStatus = Status::where('status_name', 'completed')->first();
            if ($completedStatus) {
                $now = now();
                $app->status_id = $completedStatus->id; // ✅ Application is completed
                $app->updated_at = $now;
                $app->save();
                
                Log::info('✅ Step 8: Application status updated to completed');

                ApplicationStatusHistory::create([
                    'application_id' => $id,
                    'status_id' => $completedStatus->id,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
                Log::info('✅ Step 9: Application status history created');
            } else {
                Log::warning('⚠️ Step 8: Completed status not found');
            }

            return response()->json([
                'success' => true,
                'message' => 'Contribution submitted successfully! Awaiting admin review.',
                'data' => [
                    'contribution_id' => $contribution->id,
                    'type' => $contribution->type,
                    'quantity' => $contribution->quantity,
                    'quantity_unit' => $contribution->quantity_unit,
                    'image_path' => $imagePath,
                    'contribution_status' => 'pending', // ✅ For admin to check
                    'application_status' => 'completed', // ✅ Grant is completed
                    'timestamp' => $contribution->created_at->toIso8601String(),
                ]
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('❌ Validation error: ' . json_encode($e->errors()));
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('❌ CONTRIBUTION ERROR: ' . $e->getMessage());
            Log::error('Line: ' . $e->getLine() . ' File: ' . $e->getFile());
            
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * ✅ GET USER CONTRIBUTIONS - WITH FULL IMAGE URL
     */
    public function getContributions($id)
    {
        try {
            Log::info('📋 FETCHING CONTRIBUTIONS - Application ID: ' . $id);

            $app = Application::findOrFail($id);

            if ($app->user_id !== auth()->id()) {
                Log::error('❌ Unauthorized access attempt');
                return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
            }

            $contributions = Contribution::where('application_id', $id)
                ->with('status')
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($contribution) {
                    return [
                        'id' => $contribution->id,
                        'type' => $contribution->type,
                        'quantity' => $contribution->quantity,
                        'quantity_unit' => $contribution->quantity_unit ?? 'PHP',
                        'image_path' => url('storage/' . $contribution->image_path), // ✅ FULL URL!
                        'notes' => $contribution->notes,
                        'status' => $contribution->status->status_name ?? 'pending',
                        'created_at' => $contribution->created_at->toIso8601String(),
                    ];
                });

            Log::info('✅ Contributions fetched: ' . $contributions->count());

            return response()->json([
                'success' => true,
                'contributions' => $contributions
            ], 200);

        } catch (\Exception $e) {
            Log::error('❌ FETCH CONTRIBUTIONS ERROR: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * ✅ GET ALL USER CONTRIBUTIONS (WITHOUT APPLICATION ID FILTER)
     */
    public function getAllContributions()
    {
        try {
            Log::info('📋 FETCHING ALL CONTRIBUTIONS FOR USER: ' . auth()->id());

            $contributions = Contribution::where('user_id', auth()->id())
                ->with('status')
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($contribution) {
                    return [
                        'id' => $contribution->id,
                        'application_id' => $contribution->application_id,
                        'type' => $contribution->type,
                        'quantity' => $contribution->quantity,
                        'quantity_unit' => $contribution->quantity_unit ?? 'PHP',
                        'image_path' => url('storage/' . $contribution->image_path), // ✅ FULL URL!
                        'notes' => $contribution->notes,
                        'status' => $contribution->status->status_name ?? 'pending',
                        'created_at' => $contribution->created_at->toIso8601String(),
                    ];
                });

            Log::info('✅ All contributions fetched: ' . $contributions->count());

            return response()->json([
                'success' => true,
                'contributions' => $contributions
            ], 200);

        } catch (\Exception $e) {
            Log::error('❌ FETCH ALL CONTRIBUTIONS ERROR: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }
}