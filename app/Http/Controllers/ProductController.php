<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(){
        $result['data'] =  Product::all();
       return view('admin/product',$result);
      }
  
      public function manage_product($id='')
      {   
        if($id > 0){
            $arr = Product::where('id', $id)->get();
            $result['category_id'] = $arr[0]->category_id;
            $result['name'] = $arr[0]->name;
            $result['image'] = $arr[0]->image;
            $result['slug'] = $arr[0]->slug;
            $result['brand'] = $arr[0]->brand;
            $result['model'] = $arr[0]->model;
            $result['short_desc'] = $arr[0]->short_desc;
            $result['desc'] = $arr[0]->desc;
            $result['keywords'] = $arr[0]->keywords;
            $result['technical_specification'] = $arr[0]->technical_specification;
            $result['uses'] = $arr[0]->uses;
            $result['warranty'] = $arr[0]->warranty;
            $result['status'] = $arr[0]->status;
            $result['id'] = $arr[0]->id;
        } else {
            $result['category_id'] = '';
            $result['name'] = '';
            $result['image'] = '';
            $result['slug'] = '';
            $result['brand'] = '';
            $result['model'] = '';
            $result['short_desc'] = '';
            $result['desc'] = '';
            $result['keywords'] = '';
            $result['technical_specification'] = '';
            $result['uses'] = '';
            $result['warranty'] = '';
            $result['status'] = '';
            $result['id'] = 0;
        }
        $result['category'] = DB::table('categories')->where('status',1)->get();
        $result['sizes'] = DB::table('sizes')->where('status',1)->get();
        $result['colors'] = DB::table('colors')->where('status',1)->get();
        return view('admin/manage_product',$result); 
      }
  
      public function manage_product_process(Request $request){

        if($request->post('id')>0){
         $image_validation =  "mimes:jpeg,jpg,png";
        }else{
         $image_validation =  "required|mimes:jpeg,jpg,png";
        }

        $request->validate([
            'name' => 'required',
            'image' =>  $image_validation,
            'slug' => 'required|unique:products,slug,' . $request->post('id'),
        ]);
        if ($request->post('id') > 0) {
            $product = Product::find($request->post('id'));
            $msg = "Product Updated successfully";
        } else {
            $product = new Product();
            $msg = "Product Inserted successfully";
        }
        if($request->hasfile('image')) {
            
           $image = $request->file('image');
           $ext = $image->extension(); 
           $image_name = time().'.'.$ext;
           $image->storeAs('/public/media',$image_name);
           $product->image = $image_name;
        }
    
        $product->category_id = $request->post('category_id');
        $product->name = $request->post('name');
        $product->slug = $request->post('slug');
        $product->brand = $request->post('brand');
        $product->model = $request->post('model');
        $product->short_desc = $request->post('short_desc');
        $product->desc = $request->post('desc');
        $product->keywords = $request->post('keywords');
        $product->technical_specification = $request->post('technical_specification');
        $product->uses = $request->post('uses');
        $product->warranty = $request->post('warranty');
        $product->status = 1;
        $product->save();
        $request->session()->flash('message', $msg);
        return redirect('admin/product');
    }
  
      public function delete(Request $request,$id){
         $model = Product::find($id);
         $model->delete();
         $request->session()->flash('message', 'Product deleted');
         return redirect('admin/product');	
      }
  
      public function status(Request $request,$status,$id){
        $model = Product::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash('message', 'Product status updated');
        return redirect('admin/product');	
     }
}
