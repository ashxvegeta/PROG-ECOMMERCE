<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        //login k baad wapis se loginp jayge to dasboadrd p redirect kr dega
        //ye url agar hit kragege diret tb - http://127.0.0.1:8000/admin
        if($request->session()->has('ADMIN_LOGIN')){
          return redirect('admin/dashboard');
        }else{ 
            //aur login nahi hai to login k page p khol dega
            //ye url hit karange to - http://127.0.0.1:8000/admin/dashboard login page p wapis bj dega
          return view('admin.login');
        }
        return view('admin.login');
    }

    public function auth(Request $request)
    { 
        $email = $request->post('email');
        $password = $request->post('password');
        $result = Admin::where(['email' => $email])->first();
        if(!empty($result)){
          if(Hash::check($password,$result->password)){
            $request->session()->put('ADMIN_LOGIN', true);
            $request->session()->put('ADMIN_ID', $result->id);
            return redirect('admin/dashboard');
          }else{
            $request->session()->flash('error', 'Please enter correct Password');   
            return redirect('admin');
          } 
        }else{
         $request->session()->flash('error', 'Please enter valid login details');   
         return redirect('admin');
        }    
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // public function updatePassword()
    // {
    //     $r = Admin::find(1);
    //     $r->password = Hash::make('12345');
    //     $r->save();

    // }
}