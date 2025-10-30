<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class DocumentController extends Controller
{
    /**
     * Upload a document for an application
     */
    public function upload(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'application_id' => 'required|integer|exists:applications,id',
                'grant_requirement_id' => 'required|integer|exists:grant_requirements,id',
                'document' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240', // 10MB max
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Check if application belongs to user
            $application = Application::where('id', $request->application_id)
                ->where('user_id', auth()->id())
                ->first();

            if (!$application) {
                return response()->json([
                    'success' => false,
                    'message' => 'Application not found or unauthorized'
                ], 404);
            }

            // Store file
            $file = $request->file('document');
            $filename = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('documents', $filename, 'public');

            // Save to database using polymorphic relationship
            $document = Document::create([
                'grant_requirement_id' => $request->grant_requirement_id,
                'status_id' => 3, // Pending verification
                'file_path' => $path,
                'file_name' => $file->getClientOriginalName(),
                'documentable_id' => $request->application_id,
                'documentable_type' => Application::class,
            ]);

            // Load relationships
            $document->load(['grantRequirement', 'status']);

            return response()->json([
                'success' => true,
                'message' => 'Document uploaded successfully',
                'data' => $document
            ], 201);

        } catch (\Exception $e) {
            Log::error('Document upload error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to upload document: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get all documents for an application
     */
    public function index($applicationId): JsonResponse
    {
        try {
            // Check if application belongs to user
            $application = Application::where('id', $applicationId)
                ->where('user_id', auth()->id())
                ->first();

            if (!$application) {
                return response()->json([
                    'success' => false,
                    'message' => 'Application not found or unauthorized'
                ], 404);
            }

            // Get documents using polymorphic relationship
            $documents = Document::with(['grantRequirement.requirement', 'status'])
                ->where('documentable_type', Application::class)
                ->where('documentable_id', $applicationId)
                ->get();

            return response()->json([
                'success' => true,
                'data' => $documents
            ]);

        } catch (\Exception $e) {
            Log::error('Fetch documents error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch documents'
            ], 500);
        }
    }

    /**
     * View a document (get URL)
     */
    public function show($id): JsonResponse
    {
        try {
            $document = Document::with(['grantRequirement', 'status', 'documentable'])
                ->where('id', $id)
                ->first();

            if (!$document) {
                return response()->json([
                    'success' => false,
                    'message' => 'Document not found'
                ], 404);
            }

            // Check if user owns this document (for Application documents)
            if ($document->documentable_type === Application::class) {
                if ($document->documentable->user_id !== auth()->id()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Unauthorized access'
                    ], 403);
                }
            }

            // Check if file exists
            if (!Storage::disk('public')->exists($document->file_path)) {
                return response()->json([
                    'success' => false,
                    'message' => 'File not found on server'
                ], 404);
            }

            // Return file URL
            $url = Storage::disk('public')->url($document->file_path);

            return response()->json([
                'success' => true,
                'data' => [
                    'document' => $document,
                    'url' => $url,
                    'full_url' => url($url),
                    'file_type' => pathinfo($document->file_path, PATHINFO_EXTENSION)
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('View document error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to view document'
            ], 500);
        }
    }

    /**
     * Download a document
     */
    public function download($id)
    {
        try {
            $document = Document::with(['documentable'])
                ->where('id', $id)
                ->first();

            if (!$document) {
                return response()->json([
                    'success' => false,
                    'message' => 'Document not found'
                ], 404);
            }

            // Check if user owns this document (for Application documents)
            if ($document->documentable_type === Application::class) {
                if ($document->documentable->user_id !== auth()->id()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Unauthorized access'
                    ], 403);
                }
            }

            // Check if file exists
            if (!Storage::disk('public')->exists($document->file_path)) {
                return response()->json([
                    'success' => false,
                    'message' => 'File not found on server'
                ], 404);
            }

            return Storage::disk('public')->download(
                $document->file_path,
                $document->file_name
            );

        } catch (\Exception $e) {
            Log::error('Download document error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to download document'
            ], 500);
        }
    }

    /**
     * Delete a document
     */
    public function destroy($id): JsonResponse
    {
        try {
            $document = Document::with(['documentable'])
                ->where('id', $id)
                ->first();

            if (!$document) {
                return response()->json([
                    'success' => false,
                    'message' => 'Document not found'
                ], 404);
            }

            // Check if user owns this document (for Application documents)
            if ($document->documentable_type === Application::class) {
                if ($document->documentable->user_id !== auth()->id()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Unauthorized access'
                    ], 403);
                }
            }

            // Delete file from storage
            if (Storage::disk('public')->exists($document->file_path)) {
                Storage::disk('public')->delete($document->file_path);
            }

            // Delete from database
            $document->delete();

            return response()->json([
                'success' => true,
                'message' => 'Document deleted successfully'
            ]);

        } catch (\Exception $e) {
            Log::error('Delete document error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete document'
            ], 500);
        }
    }
}
