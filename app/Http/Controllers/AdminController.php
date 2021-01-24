<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
Use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
     public function index(){
     
      return view('admin_login');
     }
     
     
     public function dashboard(Request $request)
     {
        $this->AdminAuthCheck();
        $admin_email=$request->admin_email;
        $admin_password=md5($request->admin_password);
        $result=DB::table('tbl_admin')
                    ->where('admin_email',$admin_email)
                    ->where('admin_password',$admin_password)
                    ->first();
                   
                   if ($result){
                     Session::put('admin_name',$result->admin_name);
                     Session::put('admin_id',$result->admin_id);
                      return Redirect::to('/dashboard');
                   }
                   else{
                      Session::PUT('messege','Email or Password Invalid');
                      return Redirect::to('/admin');
                   }

     }

     public function AdminAuthCheck(){
      $admin_id=Session::get('admin_id');
      if($admin_id){
         return;
      }
      else{
         return Redirect::to('/admin')->send();
      }
   }
}
