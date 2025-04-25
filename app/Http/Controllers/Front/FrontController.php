<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller; // ✅ ADD THIS
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    public function index(Request $request)
    { 
        $result['home_category'] = DB::table('categories')
        ->where(['status' => 1])
        ->get();
        return view('front.index',$result);
    }
}
