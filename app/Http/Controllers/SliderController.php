<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index(){
        return view('admin.add_slider');
    }
    public function save_slider(Request $request){
        $data=array();
        $data['publication_status']=$request->publication_status;
        $image=$request->file('slider_image');
        

            $image_name=hexdec(uniqid());
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='slider/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            $data['slider_image']=$image_url;
            DB::table('tbl_slider')->insert($data);
            Session::put('message','slider added successfully');
            return Redirect::to('/add-slider');
    }
    public function all_slider(){
        $all_slider=DB::table('tbl_slider')->get();
       return view('admin.all_slider',compact('all_slider'));
    }
    public function inactive_slider($slider_id){
        DB::table('tbl_slider')
        ->where('slider_id',$slider_id)
        ->update(['publication_status'=>0]);
        Session::put('message','slider inactivated successfully');
        return Redirect::to('/all-slider');
    }
    public function active_slider($slider_id){
       // $this->AdminAuthCheck();
        DB::table('tbl_slider')
        ->where('slider_id',$slider_id)
        ->update(['publication_status'=>1]);
        Session::put('message','slider Activated Successfully');
        return Redirect::to('/all-slider');
     }
     public function delete_slider($slider_id){
        //$this->AdminAuthCheck();
      DB::table('tbl_slider')
      ->where('slider_id',$slider_id)
      ->delete();
      Session::get('message','slider Deleted Successfully!');
      return Redirect::to('/all-slider');
     }
}
