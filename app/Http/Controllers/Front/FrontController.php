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
            
            foreach($result['home_category_product'][$list->id] as $list1){
                        $result['home_product_attr'][$list1->id] = 
                        DB::table('products_attr')
                        ->leftjoin('sizes','sizes.id','=','products_attr.size_id')
                        ->leftjoin('colors','colors.id','=','products_attr.color_id')
                        ->where('products_attr.products_id',$list1->id)
                        ->get(); 
            }
        }

        $result['home_brand'] = DB::table('brands')
        ->where(['is_home' => 1])
        ->where(['status' => 1])
        ->get();


        // for gettting  featured data
        $result['home_featured_product'][$list->id] = 
        DB::table('products')
        ->where(['status'=>1])
        ->where(['is_featured'=>1])
        ->get();
        
        foreach($result['home_featured_product'][$list->id] as $list1){
                    $result['home_featured_product_attr'][$list1->id] = 
                    DB::table('products_attr')
                    ->leftjoin('sizes','sizes.id','=','products_attr.size_id')
                    ->leftjoin('colors','colors.id','=','products_attr.color_id')
                    ->where('products_attr.products_id',$list1->id)
                    ->get();

                   
        }

        // for gettting  tranding data
        $result['home_tranding_product'][$list->id] = 
        DB::table('products')
        ->where(['status'=>1])
        ->where(['is_tranding'=>1])
        ->get();
        
        foreach($result['home_tranding_product'][$list->id] as $list1){
                    $result['home_tranding_product_attr'][$list1->id] = 
                    DB::table('products_attr')
                    ->leftjoin('sizes','sizes.id','=','products_attr.size_id')
                    ->leftjoin('colors','colors.id','=','products_attr.color_id')
                    ->where('products_attr.products_id',$list1->id)
                    ->get();

                   
        }
   
        //  gettin dicounted products
        $result['home_discounted_product'][$list->id] = 
        DB::table('products')
        ->where(['status'=>1])
        ->where(['is_discounted'=>1])
        ->get();
        
        foreach($result['home_discounted_product'][$list->id] as $list1){
                    $result['home_discounted_product_attr'][$list1->id] = 
                    DB::table('products_attr')
                    ->leftjoin('sizes','sizes.id','=','products_attr.size_id')
                    ->leftjoin('colors','colors.id','=','products_attr.color_id')
                    ->where('products_attr.products_id',$list1->id)
                    ->get();

                   
        }
        return view('front.index',$result);
    }
}
