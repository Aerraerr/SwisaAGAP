<?php

namespace App\Http\Controllers\mobile;

use App\Models\Faqs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 

class MemberFaqsController extends Controller
{
    public function index()
    {
        $faqs = Faqs::where('type', 'General')->get();
        return response()->json($faqs);
    }
}
