<?php

namespace App\Http\Controllers\mobile;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Document;
use App\Models\Contribution;
use App\Models\ApplicationStatusHistory;
use App\Models\Status;
use App\Models\GrantClaim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ApplicationController extends Controller
{
    /**
     * ✅ GET ALL USER APPLICATIONS (GRANTS + MEMBERSHIP)
     */
    public function getMyApplications()
    {
        try {
            $userId = auth()->id();
            Log::info('📋 FETCHING ALL APPLICATIONS FOR USER: ' . $userId);

            $applications = Application::with([
                'grant.grantType',
                'status',
                'statusHistories.status'
            ])
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($app) {
                // ✅ Handle MEMBERSHIP applications (no grant)
                if ($app->application_type === 'Membership' || $app->grant_id === null) {
                    return [
                        'id' => $app->id,
                        'user_id' => $app->user_id,
                        'grant_id' => null,
                        'status_id' => $app->status_id,
                        'purpose' => $app->purpose ?? 'Membership Application',
                        'created_at' => $app->created_at?->toIso8601String(),
                        'updated_at' => $app->updated_at?->toIso8601String(),
                        'grant' => [
                            'id' => 0,
                            'grant_name' => 'SWISA Membership',
                            'description' => 'Become a member of SWISA to access grants and benefits',
                            'total_quantity' => null,
                            'grant_type' => [
                                'id' => 999,
                                'type_name' => 'Membership',
                            ],
                        ],
                        'status' => [
                            'id' => $app->status->id,
                            'status_name' => $app->status->status_name,
                        ],
                        'status_histories' => $app->statusHistories->map(function ($history) {
                            return [
                                'status_name' => $history->status->status_name ?? null,
                                'created_at' => $history->created_at?->toIso8601String(),
                            ];
                        }),
                        'type' => 'membership',
                    ];
                }

                // ✅ Handle GRANT applications
                return [
                    'id' => $app->id,
                    'user_id' => $app->user_id,
                    'grant_id' => $app->grant_id,
                    'status_id' => $app->status_id,
                    'purpose' => $app->purpose,
                    'created_at' => $app->created_at?->toIso8601String(),
                    'updated_at' => $app->updated_at?->toIso8601String(),
                    'grant' => [
                        'id' => $app->grant->id,
                        'grant_name' => $app->grant->title ?? $app->grant->grant_name,
                        'description' => $app->grant->description,
                        'total_quantity' => $app->grant->total_quantity ?? $app->grant->applicant_limit,
                        'grant_type' => [
                            'id' => $app->grant->grantType->id,
                            'type_name' => $app->grant->grantType->grant_type ?? $app->grant->grantType->type_name,
                        ],
                    ],
                    'status' => [
                        'id' => $app->status->id,
                        'status_name' => $app->status->status_name,
                    ],
                    'status_histories' => $app->statusHistories->map(function ($history) {
                        return [
                            'status_name' => $history->status->status_name ?? null,
                            'created_at' => $history->created_at?->toIso8601String(),
                        ];
                    }),
                    'type' => 'grant',
                ];
            });

            Log::info('✅ Total applications fetched: ' . $applications->count());

            return response()->json($applications, 200);

        } catch (\Exception $e) {
            Log::error('❌ FETCH MY APPLICATIONS ERROR: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch applications',
                'error' => $e->getMessage()
            ], 500);
        }
    }

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
                    
                    'grant' => $application->grant ? [
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
                    ] : null,
                    
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
     * ✅ GET GRANT APPLICATION DETAILS FOR CLAIMING (with QR code and reference number)
     */
    public function getGrantApplicationDetails($id)
    {
        try {
            Log::info('🎯 FETCHING GRANT CLAIM DETAILS - Application ID: ' . $id);

            $application = Application::with([
                'grant.grantType',
                'status',
            ])
            ->where('id', $id)
            ->where('user_id', auth()->id())
            ->first();

            if (!$application) {
                Log::warning('❌ Application not found: ' . $id);
                return response()->json([
                    'success' => false,
                    'message' => 'Grant application not found or not claimable.'
                ], 404);
            }

            Log::info('✅ Application found - Status: ' . $application->status->status_name);

            $currentStatus = $application->status->status_name ?? '';
            if ($currentStatus !== 'approved') {
                Log::warning('❌ Application not approved - Status: ' . $currentStatus);
                return response()->json([
                    'success' => false,
                    'message' => 'This application is not approved yet. Current status: ' . $currentStatus
                ], 400);
            }

            $referenceNumber = 'SWISA-' . $application->created_at->format('Y') . '-' . str_pad($id, 5, '0', STR_PAD_LEFT);
            $qrData = json_encode([
                'type' => 'grant_claim',
                'application_id' => $application->id,
                'reference' => $referenceNumber,
                'user_id' => $application->user_id,
                'grant_id' => $application->grant_id,
                'grant_name' => $application->grant->title ?? $application->grant->grant_name,
                'timestamp' => now()->toIso8601String(),
            ]);
            $validUntil = now()->addDays(30);

            // Save to grant_claims table (insert or update)
            $grantClaim = GrantClaim::where('application_id', $application->id)->first();

            if (!$grantClaim) {
                $grantClaim = GrantClaim::create([
                    'application_id'   => $application->id,
                    'user_id'          => $application->user_id,
                    'reference_number' => $referenceNumber,
                    'qr_code'          => $qrData,
                    'claim_status'     => 'claimable',
                    'valid_until'      => $validUntil,
                    'claimed_at'       => null,
                ]);
                Log::info('✅ GrantClaim INSERTED: ' . $grantClaim->id);
            } else {
                $grantClaim->update([
                    'reference_number' => $referenceNumber,
                    'qr_code'          => $qrData,
                    'valid_until'      => $validUntil,
                ]);
                Log::info('✅ GrantClaim UPDATED: ' . $grantClaim->id);
            }

            Log::info('✅ Claim details generated successfully');
            Log::info('   Reference: ' . $referenceNumber);
            Log::info('   Valid until: ' . $validUntil->toDateString());

            return response()->json([
                'success' => true,
                'application' => [
                    'id' => $application->id,
                    'reference_number' => $referenceNumber,
                    'qr_code' => $qrData,
                    'valid_until' => $validUntil->toIso8601String(),
                    'grant' => [
                        'id' => $application->grant->id,
                        'name' => $application->grant->title ?? $application->grant->grant_name,
                        'description' => $application->grant->description,
                        'grant_type' => [
                            'id' => $application->grant->grantType->id,
                            'name' => $application->grant->grantType->grant_type ?? $application->grant->grantType->type_name,
                        ],
                    ],
                    'status' => $application->status->status_name,
                    'created_at' => $application->created_at->toIso8601String(),
                ],
            ], 200);

        } catch (\Exception $e) {
            Log::error('❌ GET GRANT CLAIM DETAILS ERROR: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'success' => false,
                'message' => 'Error fetching grant claim details: ' . $e->getMessage(),
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
     * ✅ SUBMIT CONTRIBUTION
     * Application becomes "completed" immediately when contribution is submitted
     * Contribution status is "pending" until admin approves it
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

            // Get pending status for contribution
            $pendingStatus = Status::where('status_name', 'pending')->first();
            if (!$pendingStatus) {
                Log::error('❌ Step 6: Pending status not found');
                return response()->json(['success' => false, 'message' => 'Pending status not found'], 500);
            }
            Log::info('✅ Step 6: Pending status found - ID: ' . $pendingStatus->id);

            // Create contribution with pending status
            $contribution = new Contribution();
            $contribution->application_id = $id;
            $contribution->user_id = auth()->id();
            $contribution->type = $validated['type'];
            $contribution->quantity = $validated['quantity'];
            $contribution->quantity_unit = $validated['quantity_unit'];
            $contribution->image_path = $imagePath;
            $contribution->notes = $validated['notes'] ?? null;
            $contribution->status_id = $pendingStatus->id; // Contribution is pending
            $contribution->save();
            
            Log::info('✅ Step 7: Contribution created with pending status - ID: ' . $contribution->id);

            // ✅ UPDATE APPLICATION STATUS TO COMPLETED IMMEDIATELY
            $completedStatus = Status::where('status_name', 'completed')->first();
            if ($completedStatus) {
                $now = now();
                $app->status_id = $completedStatus->id;
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

            Log::info('✅ CONTRIBUTION SUBMITTED - Application marked as completed');

            
    // Activity log
    DB::table('activity_history')->insert([
    'user_id'    => auth()->id(),
    'type'       => 'Contribution',
    'message'    => 'Submitted a contribution ('.$contribution->type.' - '.$contribution->quantity.' '.$contribution->quantity_unit.').',
    'created_at' => now(),
    'updated_at' => now(),
    ]);

            return response()->json([
                'success' => true,
                'message' => 'Contribution submitted successfully!',
                'data' => [
                    'contribution_id' => $contribution->id,
                    'type' => $contribution->type,
                    'quantity' => $contribution->quantity,
                    'quantity_unit' => $contribution->quantity_unit,
                    'image_path' => $imagePath,
                    'contribution_status' => 'pending', // Contribution status
                    'application_status' => 'completed', // ⭐ Application is now completed
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
     * ❌ REMOVED - Contributions are no longer shown in View Status screen
     * This method is no longer needed
     */
    // public function getContributions($id) { ... }

    /**
     * ✅ GET ALL CONTRIBUTIONS WITH STATUS (FOR CONTRIBUTION HISTORY)
     * Returns ALL contributions (pending + approved) with status column
     */
    public function getAllContributions()
    {
        try {
            Log::info('📋 FETCHING ALL CONTRIBUTIONS WITH STATUS - User: ' . auth()->id());

            // ✅ Return ALL contributions with their status
            $contributions = Contribution::where('user_id', auth()->id())
                ->with(['status', 'application.grant'])
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($contribution) {
                    return [
                        'id' => $contribution->id,
                        'application_id' => $contribution->application_id,
                        'type' => $contribution->type,
                        'quantity' => $contribution->quantity,
                        'quantity_unit' => $contribution->quantity_unit ?? 'PHP',
                        'image_path' => url('storage/' . $contribution->image_path),
                        'notes' => $contribution->notes,
                        'status' => $contribution->status->status_name ?? 'unknown', // ⭐ Status shown
                        'created_at' => $contribution->created_at->toIso8601String(),
                        'application' => [
                            'id' => $contribution->application->id ?? null,
                            'grant_name' => $contribution->application->grant->grant_name ?? 'N/A',
                        ],
                    ];
                });

            Log::info('✅ Contributions fetched: ' . $contributions->count());

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