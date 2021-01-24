<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ManufactureController extends Controller
{
    public function index(){
        $this->AdminAuthCheck();
        return view('admin.add_manufacture');
    }
    public function save_manufacture(Request $request){
        $this->AdminAuthCheck();
        $data=array();
      $data['manufacture_id']=$request->manufacture_id;
      $data['manufacture_name']=$request->manufacture_name;
      $data['manufacture_description']=$request->manufacture_description;
      $data['manufacture_status']=$request->manufacture_status;
      
      DB::table('manufacture')->insert($data);
     Session::put('message','manufacture added successfully!!');
      return Redirect::to('/add-category');
     //dd($data);
    }
    public function all_manufacture(){
        $this->AdminAuthCheck();
        $all_manufacture_info=DB::table('manufacture')->get();
        return view('admin.all_manufacture',compact('all_manufacture_info'));
    }
    public function inactive_manufacture($manufacture_id){
        $this->AdminAuthCheck();
        DB::table('manufacture')
        ->where('manufacture_id',$manufacture_id)
        ->update(['manufacture_status'=>0]);
        Session::put('message','Manufacture inactivated successfully');
        return Redirect::to('/all-manufacture');
     }
     public function active_manufacture($manufacture_id){
        $this->AdminAuthCheck();
        DB::table('manufacture')
        ->where('manufacture_id',$manufacture_id)
        ->update(['manufacture_status'=>1]);
        Session::put('message','manufacture Activated Successfully');
        return Redirect::to('/all-manufacture');
     }
     public function edit_manufacture($manufacture_id){
        $this->AdminAuthCheck();
        $manufacture_info=DB::table('manufacture')
        ->where('manufacture_id',$manufacture_id)
        ->first();
        return view('admin.edit_manufacture',compact('manufacture_info'));
        //return view('admin.edit_category');
     }
     public function update_manufacture(Request $request, $manufacture_id){
        $this->AdminAuthCheck();
        $data=array();
        $data['manufacture_name']=$request->manufacture_name;
        $data['manufacture_description']=$request->manufacture_description;
        DB::table('manufacture')
        ->where('manufacture_id',$manufacture_id)
        ->update($data);
        Session::get('message','manufacture updated successfully!!');
        //return Redirect::to('/all-manufacture');
        dd($data);
       }
       public function delete_manufacture($manufacture_id){
        $this->AdminAuthCheck();
        DB::table('manufacture')
        ->where('manufacture_id',$manufacture_id)
        ->delete();
        Session::get('message','manufacture Deleted Successfully!');
        return Redirect::to('/all-manufacture');
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
