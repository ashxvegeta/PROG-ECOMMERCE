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
            $result['productsAttrArr'] = DB::table('products_attr')->where('products_id',$id)->get();
            $result['productsImagesArr'] = DB::table('product_images')->where('products_id',$id)->get();
            $productsImagesArr =  DB::table('product_images')->where('products_id',$id)->get();
            // print_r($productsImagesArr);
            // die('dd');
            if(!isset($productsImagesArr[0])){
                $result['productsImagesArr'][0]['id']=' ';
                $result['productsImagesArr'][0]['images']=' ';  
            }else{
                $result['productsImagesArr'] = $productsImagesArr;
            }
          
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
            $result['id']=0;
            $result['productsAttrArr'][0]['id']='';
            $result['productsAttrArr'][0]['products_id']='';
            $result['productsAttrArr'][0]['sku' ]=' ';
            $result['productsAttrArr'][0]['attr_image']=' ';
            $result['productsAttrArr'][0]['mrp']=' ';
            $result['productsAttrArr'][0]['price']='';
            $result['productsAttrArr'][0]['qty']=' ';
            $result['productsAttrArr'][0]['size_id']='';
            $result['productsAttrArr'][0]['color_id']=' ';
            $result['productsImagesArr'][0]['id']=' ';
            $result['productsImagesArr'][0]['images']=' ';
        }
        // echo "<pre>";
        // print_r($result);
        // die('dd');
        $result['category'] = DB::table('categories')->where('status',1)->get();
        $result['sizes'] = DB::table('sizes')->where('status',1)->get();
        $result['colors'] = DB::table('colors')->where('status',1)->get();
        return view('admin/manage_product',$result); 
      }
  
      public function manage_product_process(Request $request){
        // echo "<pre>";
        // print_r ($request->post());
        // die('ddd');
        if($request->post('id')>0){
         $image_validation =  "mimes:jpeg,jpg,png";
        }else{
         $image_validation =  "required|mimes:jpeg,jpg,png";
        }

        $request->validate([
            'name' => 'required',
            'image' =>  $image_validation,
            'slug' => 'required|unique:products,slug,' . $request->post('id'),
            'attr_image.*' => 'mimes:jpeg,jpg,png',
            'images.*' => 'mimes:jpeg,jpg,png',

        ]);
        $paidArr=$request->post('paid');
        $skuArr=$request->post('sku');
        $mrpArr=$request->post('mrp');
        $priceArr=$request->post('price');
        $qtyArr=$request->post('qty');
        $size_idArr=$request->post('size_id');
        $color_idArr=$request->post('color_id');
        foreach($skuArr as $key=>$val){
           $check = DB::table('products_attr')->
            where('sku','=',$skuArr[$key])->
            where('id','!=',$paidArr[$key])->
            get();   
            if(isset($check[0]->id)){
                $request->session()->flash('sku_error', $skuArr[$key].' sku already exists');
                return redirect()->back();
            }
        }

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
        //product attr start 
        $pid = $product->id;
        
        foreach($skuArr as $key=>$val){
        $productAttrarr['products_id'] = $pid;  
        $productAttrarr['sku'] = $skuArr[$key];
        // $productAttrarr['attr_image'] = 1;
        $productAttrarr['mrp'] = $mrpArr[$key];
        $productAttrarr['price'] = $priceArr[$key];
        $productAttrarr['qty'] = $qtyArr[$key];
        if($size_idArr[$key]==''){
            $productAttrarr['size_id'] = 0;
        }else{
            $productAttrarr['size_id'] = $size_idArr[$key];

        }
        if($color_idArr[$key]==''){
            $productAttrarr['color_id'] = 0;
        }else{
            $productAttrarr['color_id'] = $color_idArr[$key];

        }
        if ($request->hasfile("attr_image.$key")) {
            $rand = rand(1111111111,9999999999);
            $attr_image = $request->file("attr_image.$key");
            $ext = $attr_image->extension();
            $image_name = $rand . '.' . $ext;
            $request->file("attr_image.$key")->storeAs('/public/media',$image_name);
            $productAttrarr['attr_image'] = $image_name;
        }else{
            $productAttrarr['attr_image'] = '';
        }
        if($paidArr[$key]!=''){
            DB::table('products_attr')->where('id',$paidArr[$key])->update($productAttrarr);
        }else{
            DB::table('products_attr')->insert($productAttrarr);
        }
        }    
        // product images start

        $piidArr=$request->post('piid');
        foreach($piidArr as $key=>$val){
            $productImagesArr['products_id'] = $pid;  
            if ($request->hasfile("images.$key")) {
                $rand = rand(1111111111,9999999999);
                $images = $request->file("images.$key");
                $ext = $images->extension();
                $image_name = $rand . '.' . $ext;
                $request->file("images.$key")->storeAs('/public/media',$image_name);
                $productImagesArr['images'] = $image_name;
            }
            if($piidArr[$key]!=''){
                DB::table('product_images')->where('id',$piidArr[$key])->update($productImagesArr);
            }else{
                $productImagesArr['products_id'] = $pid;
                DB::table('product_images')->insert($productImagesArr);
            }
        }

        // product images end


        $request->session()->flash('message', $msg);
        return redirect('admin/product');
    }
  
      public function delete(Request $request,$id){
         $model = Product::find($id);
         $model->delete();
         $request->session()->flash('message', 'Product deleted');
         return redirect('admin/product');	
      }

      public function product_attr_delete(Request $request,$paid,$pid){
        DB::table('products_attr')->where('id',$paid)->delete();
        return redirect('admin/product/manage_product/'.$pid);	
     }

     public function product_images_delete(Request $request,$paid,$pid){
        DB::table('product_images')->where('id',$paid)->delete();
        return redirect('admin/product/manage_product/'.$pid);	
     }

     
  
      public function status(Request $request,$status,$id){
        $model = Product::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash('message', 'Product status updated');
        return redirect('admin/product');	
     }
}
