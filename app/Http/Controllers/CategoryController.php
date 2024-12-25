<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    //

    public function index(){
     return view('admin/category');
    }

    public function manage_category(){
        return view('admin/manage_category'); 
    }

    public function manage_category_process(Request $request){
      $request->validate([
        'category'=>'required',
        'category_slug'=>'required|unique:categories',
      ]);
      $category =  new Category();
      $category->category_name =  $request->post('category');
      $category->category_slug =  $request->post('category_slug');
      $category->save();
      $request->session()->flash('message', 'Category inserted');
      return redirect('admin/category');
    }
}
