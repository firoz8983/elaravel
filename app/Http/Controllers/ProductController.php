<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    public function index(){
        $this->AdminAuthCheck();
        return view('admin.add_product');
    }
    public function save_product(Request $request){
        $this->AdminAuthCheck();
        $data=array();
        $data['product_name']=$request->product_name;
        $data['category_id']=$request->category_id;
        $data['manufacture_id']=$request->manufacture_id;
        $data['product_short_description']=$request->product_short_description;
        $data['product_long_description']=$request->product_long_description;
        $data['product_price']=$request->product_price;
        $data['product_size']=$request->product_size;
        $data['product_color']=$request->product_color;
        $data['publication_status']=$request->publication_status;

        $image=$request->file('product_image');
        if($image){

            $image_name=hexdec(uniqid());
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='image/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            $data['product_image']=$image_url;
            DB::table('tbl_products')->insert($data);
            Session::put('message','Product added successfully');
            return Redirect::to('/add-product');
        }
        $data['product_image']='';
        DB::table('tbl_products')->insert($data);
        Session::put('message','product added successfully without image');
        return Redirect::to('/add-product');

    }
    public function all_product(){
        $this->AdminAuthCheck();
        $all_products=DB::table('tbl_products')
        ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
        ->join('manufacture','tbl_products.manufacture_id','=','manufacture.manufacture_id')
        ->select('tbl_products.*','tbl_category.category_name','manufacture.manufacture_name')
        ->get();
        //dd($all_products);
        return view('admin.all_products',compact('all_products'));
    }
    public function inactive_product($product_id){
        $this->AdminAuthCheck();
        DB::table('tbl_products')
        ->where('product_id',$product_id)
        ->update(['publication_status'=>0]);
        Session::put('message','product inactivated successfully');
        return Redirect::to('/all-product');
    }
    public function active_product($product_id){
        $this->AdminAuthCheck();
        DB::table('tbl_products')
        ->where('product_id',$product_id)
        ->update(['publication_status'=>1]);
        Session::put('message','product activated successfully');
        return Redirect::to('/all-product');
    }
    public function delete_product($product_id){
        $this->AdminAuthCheck();
        DB::table('tbl_products')
        ->where('product_id',$product_id)
        ->delete();
        Session::get('message','product Deleted Successfully!');
        return Redirect::to('/all-product');
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
