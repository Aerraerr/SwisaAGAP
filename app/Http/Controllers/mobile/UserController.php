<?php

namespace App\Http\Controllers\mobie;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // GET /api/mobile/user (auth:sanctum)
    public function profile(Request $request)
    {
        $user = $request->user()->load('user_info', 'role');
        return response()->json(['user' => $user], 200);
    }
}
