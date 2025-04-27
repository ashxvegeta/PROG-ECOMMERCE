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

        foreach($result['home_category'] as $list){
            $result['home_category_product'][$list->id] = 
            DB::table('products')
            ->where(['status'=>1])
            ->where(['category_id'=>$list->id])
            ->get();
        }
        
        foreach($result['home_category_product'] as $list){
            $result['home_product_attr'][$list->id] = 
            DB::table('products_attr')
            ->leftjoin('sizes','sizes.id','=','products_attr.size_id')
            ->leftjoin('colors','colors.id','=','products_attr.color_id')
            ->where('products_attr.product_id',$list->id)
            ->where(['status'=>1])
            // ->where(['category_id'=>$list->id])
            ->get(); 

        }
        echo "<pre>";
            print_r($result);
            die();
       


        return view('front.index',$result);
    }
}
