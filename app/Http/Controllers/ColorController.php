<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index(){
        $result['data'] =  Color::all();
       return view('admin/color',$result);
      }
  
      public function manage_color($id='')
      {   
          if($id>0){
          $arr = Color::where('id',$id)->get();
          $result['color']= $arr[0]->color;
          $result['status']= $arr[0]->status;
          $result['id']= $arr[0]->id;
          }else{
            $result['color']='';
            $result['status']='';
            $result['id']=0;
          }
          return view('admin/manage_color',$result); 
      }
  
      public function manage_color_process(Request $request){
        $request->validate([
          'color'=>'required|unique:colors,color,'.$request->post('id'),
        ]);
        if($request->post('id')>0){
          $category = Color::find($request->post('id'));
          $msg="Color Updated successfully";
        }else{
          $category =  new Color();
          $msg="Color Inserted successfully";
        }
        $category->color =  $request->post('color');
        $category->status = 1;
        $category->save();
        $request->session()->flash('message', $msg);
        return redirect('admin/color');
      }
  
      public function delete(Request $request,$id){
         $model = Color::find($id);
         $model->delete();
         $request->session()->flash('message', 'Color deleted');
         return redirect('admin/color');	
      }
  
      public function status(Request $request,$status,$id){
        $model = Color::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash('message', 'Color status updated');
        return redirect('admin/color');	
     }
}
