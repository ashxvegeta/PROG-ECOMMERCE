<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{


    public function index(){
        $result['data'] =  Brand::all();
       return view('admin/brand',$result);
      }
  
      public function manage_brand($id='')
      {   
          if($id>0){
          $arr = Brand::where('id',$id)->get();
          $result['name']= $arr[0]->name;
          $result['image']= $arr[0]->image;
          $result['status']= $arr[0]->status;
          $result['id']= $arr[0]->id;
          }else{
            $result['name']='';
            $result['image']='';
            $result['status']='';
            $result['id']=0;
          }
          return view('admin/manage_brand',$result); 
      }
  
      public function manage_brand_process(Request $request){
   
           $request->validate([
               'name' => 'unique:brands,name,' . $request->post('id'),
               'image' =>  'mimes:jpeg,jpg,png',
   
           ]);

        if($request->post('id')>0){
          $category = Brand::find($request->post('id'));
          $msg="Brand Updated successfully";
        }else{
          $category =  new Brand();
          $msg="Brand Inserted successfully";
        }

        if($request->hasfile('image')) {

        
            
            $image = $request->file('image');
            $ext = $image->extension(); 
            $image_name = time().'.'.$ext;
            $image->storeAs('/public/media/brand',$image_name);
            $category->image = $image_name;
         }

        $category->name =  $request->post('name');
        $category->status = 1;
        $category->save();
        $request->session()->flash('message', $msg);
        return redirect('admin/brand');
      }
  
      public function delete(Request $request,$id){
         $model = Brand::find($id);
         $model->delete();
         $request->session()->flash('message', 'Brand deleted');
         return redirect('admin/brand');	
      }
  
      public function status(Request $request,$status,$id){
        $model = Brand::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash('message', 'Brand status updated');
        return redirect('admin/brand');	
     }


}
