<?php

namespace App\Http\Controllers\mobile;

use App\Http\Controllers\Controller;
use App\Models\Sector;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    /**
     * Get all sectors
     */
    public function index()
    {
        try {
            $sectors = Sector::select('id', 'sector_name')
                ->orderBy('sector_name')
                ->get();
            
            return response()->json([
                'success' => true,
                'sectors' => $sectors
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch sectors',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}