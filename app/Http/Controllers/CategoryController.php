<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    //

    public function index(){
      $result['data'] =  Category::all();
     return view('admin/category',$result);
    }

    public function manage_category($id='')
    {   
        if($id>0){
        $arr = Category::where('id',$id)->get();
        $result['category_name']= $arr[0]->category_name;
        $result['category_slug']= $arr[0]->category_slug;
        $result['id']= $arr[0]->id;
        }else{
          $result['category_name']='';
          $result['category_slug']='';
          $result['id']=0;
        }
        return view('admin/manage_category',$result); 
    }

    public function manage_category_process(Request $request){
      $request->validate([
        'category'=>'required',
        'category_slug'=>'required|unique:categories,category_slug,'.$request->post('id'),
      ]);
      if($request->post('id')>0){
        $category = Category::find($request->post('id'));
        $msg="Category Updated successfully";
      }else{
        $category =  new Category();
        $msg="Category Inserted successfully";
      }
      $category->category_name =  $request->post('category');
      $category->category_slug =  $request->post('category_slug');
      $category->status = 1;
      $category->save();
      $request->session()->flash('message', $msg);
      return redirect('admin/category');
    }

    public function delete(Request $request,$id){
       $model = Category::find($id);
       $model->delete();
       $request->session()->flash('message', 'Category deleted');
       return redirect('admin/category');	
    }

    public function status(Request $request,$status,$id){
      $model = Category::find($id);
      $model->status = $status;
      $model->save();
      $request->session()->flash('message', 'Category status updated');
      return redirect('admin/category');	
   }
}
