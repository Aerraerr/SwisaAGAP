<?php

namespace App\Http\Controllers\mobile;

use App\Http\Controllers\Controller;
use App\Models\GrantType;
use Illuminate\Http\JsonResponse;

class GrantTypeController extends Controller
{
    /**
     * Get all grant types for filtering
     */
    public function index(): JsonResponse
    {
        try {
            // ✅ Reading from 'grant_type' column, returning as 'type_name'
            $grantTypes = GrantType::select('id', 'grant_type as type_name')
                ->orderBy('grant_type', 'asc')
                ->get();

            return response()->json($grantTypes, 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch grant types',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
