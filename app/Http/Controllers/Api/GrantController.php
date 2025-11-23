<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Grant;
use Illuminate\Http\JsonResponse;

class GrantController extends Controller
{
    public function index(): JsonResponse
    {
        $grants = Grant::with(['grantType', 'grantRequirements.requirement'])
            ->withCount('applications')
            ->get();

        return response()->json($grants);
    }
}
