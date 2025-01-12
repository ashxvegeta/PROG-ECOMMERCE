<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index(){
        $result['data'] =  Coupon::all();
       return view('admin/coupon',$result);
      }
  
      public function manage_coupon($id='')
      {   
          if($id>0){
          $arr = Coupon::where('id',$id)->get();
          $result['title']= $arr[0]->title;
          $result['code']= $arr[0]->code;
          $result['value']= $arr[0]->value;
          $result['id']= $arr[0]->id;
          }else{
            $result['title']='';
            $result['code']='';
            $result['value']='';
            $result['id']= 0;

          }
          return view('admin/manage_coupon',$result); 
      }
  
      public function manage_coupon_process(Request $request){
        $request->validate([
          'title'=>'required',
          'code'=>'required|unique:coupons,code,'.$request->post('id'),
          'value'=>'required',
        ]);
        if($request->post('id')>0){
          $category = Coupon::find($request->post('id'));
          $msg="Coupon Updated successfully";
        }else{
          $category =  new Coupon();
          $msg="Coupon Inserted successfully";
        }
        $category->title =  $request->post('title');
        $category->code =  $request->post('code');
        $category->value =  $request->post('value');
        $category->status = 1;
        $category->save();
        $request->session()->flash('message', $msg);
        return redirect('admin/coupon');
      }
  
      public function delete(Request $request,$id){
         $model = Coupon::find($id);
         $model->delete();
         $request->session()->flash('message', 'Coupon deleted');
         return redirect('admin/coupon');	
      }

      public function status(Request $request,$status,$id){
        $model = Coupon::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash('message', 'Coupon status updated');
        return redirect('admin/coupon');	
      }


}
