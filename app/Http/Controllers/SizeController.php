<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
  
    public function index(){
        $result['data'] =  Size::all();
       return view('admin/size',$result);
      }
  
      public function manage_size($id='')
      {   
          if($id>0){
          $arr = Size::where('id',$id)->get();
          $result['size']= $arr[0]->size;
          $result['status']= $arr[0]->status;
          $result['id']= $arr[0]->id;
          }else{
            $result['size']='';
            $result['status']='';
            $result['id']=0;
          }
          return view('admin/manage_size',$result); 
      }
  
      public function manage_size_process(Request $request){
        $request->validate([
          'size'=>'required|unique:sizes,size,'.$request->post('id'),
        ]);
        if($request->post('id')>0){
          $category = Size::find($request->post('id'));
          $msg="Size Updated successfully";
        }else{
          $category =  new Size();
          $msg="Size Inserted successfully";
        }
        $category->size =  $request->post('size');
        $category->status = 1;
        $category->save();
        $request->session()->flash('message', $msg);
        return redirect('admin/size');
      }
  
      public function delete(Request $request,$id){
         $model = Size::find($id);
         $model->delete();
         $request->session()->flash('message', 'Size deleted');
         return redirect('admin/size');	
      }
  
      public function status(Request $request,$status,$id){
        $model = Size::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash('message', 'Size status updated');
        return redirect('admin/size');	
     }
}
