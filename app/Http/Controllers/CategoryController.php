<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\FuncCall;

class CategoryController extends Controller
{
   public function index(){
      $this->AdminAuthCheck();
      return view('admin.add_category');
   }
   public function all_category(){
      $this->AdminAuthCheck();
       $all_category_info=DB::table('tbl_category')->get();
       return view('admin.all_category',compact('all_category_info'));
   }



   public function save_category(Request $request){
      $this->AdminAuthCheck();
      $data=array();
      $data['category_id']=$request->category_id;
      $data['category_name']=$request->category_name;
      $data['category_description']=$request->category_description;
      $data['publication_status']=$request->publication_status;
      
      DB::table('tbl_category')->insert($data);
      Session::put('message','Categroy added successfully!!');
      return Redirect::to('/add-category');
     //dd($data);
   }
   public function inactive_category($category_id){
      $this->AdminAuthCheck();
      DB::table('tbl_category')
      ->where('category_id',$category_id)
      ->update(['publication_status'=>0]);
      Session::put('message','Category inactivated successfully');
      return Redirect::to('/all-category');
   }
   public function active_category($category_id){
      $this->AdminAuthCheck();
      DB::table('tbl_category')
      ->where('category_id',$category_id)
      ->update(['publication_status'=>1]);
      Session::put('message','Category Activated Successfully');
      return Redirect::to('/all-category');
   }
   public function edit_category($category_id){
      $this->AdminAuthCheck();
      $category_info=DB::table('tbl_category')
      ->where('category_id',$category_id)
      ->first();
      return view('admin.edit_category',compact('category_info'));
      //return view('admin.edit_category');
   }
   public function update_category(Request $request, $category_id){
      $this->AdminAuthCheck();
    $data=array();
    $data['category_name']=$request->category_name;
    $data['category_description']=$request->category_description;
    DB::table('tbl_category')
    ->where('category_id',$category_id)
    ->update($data);
    Session::get('message','Category updated successfully!!');
    return Redirect::to('/all-category');
    //dd($data);
   }
   public function delete_category($category_id){
      $this->AdminAuthCheck();
    DB::table('tbl_category')
    ->where('category_id',$category_id)
    ->delete();
    Session::get('message','category Deleted Successfully!');
    return Redirect::to('/all-category');
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
