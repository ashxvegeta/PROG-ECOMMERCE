<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller; // ✅ ADD THIS
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class FrontController extends Controller
{
    public function index(Request $request)
    {
        return view('front.index');
    }
}
