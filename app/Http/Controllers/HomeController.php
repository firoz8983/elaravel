<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        
        $all_published_product=DB::table('tbl_products')
        ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
        ->join('manufacture','tbl_products.manufacture_id','=','manufacture.manufacture_id')
        ->select('tbl_products.*','tbl_category.category_name','manufacture.manufacture_name')
        ->limit(6)
        ->get();
        //dd($all_products);
        return view('pages.home_content',compact('all_published_product'));
      //  return view('pages.home_content');
    }

    public function showproductbycategory($category_id){
      $product_by_category=DB::table('tbl_products')
        ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
        
        ->select('tbl_products.*','tbl_category.category_name')
        ->where('tbl_category.category_id',$category_id)
        ->where('tbl_products.publication_status',1)
        ->limit(18)
        ->get();
        //dd($all_products);
        return view('pages.products_by_category',compact('product_by_category'));
    }
    public function showproductbymanufacture($manufacture_id){
      $product_by_manufacture=DB::table('tbl_products')
      ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
      ->join('manufacture','tbl_products.manufacture_id','=','manufacture.manufacture_id')
      ->select('tbl_products.*','manufacture.manufacture_name')
      ->where('manufacture.manufacture_id',$manufacture_id)
      ->where('tbl_products.publication_status',1)
      ->limit(6)
      ->get();
        //dd($all_products);
        return view('pages.products_by_manufacture',compact('product_by_manufacture'));
    }
     
    public function product_details_by_id($product_id){
      $product_by_details=DB::table('tbl_products')
      ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
      ->join('manufacture','tbl_products.manufacture_id','=','manufacture.manufacture_id')
      ->select('tbl_products.*','tbl_category.category_name','manufacture.manufacture_name')
      ->where('tbl_products.product_id',$product_id)
      ->where('tbl_products.publication_status',1)
      ->limit(18)
      ->first();
      //dd($all_products);
      return view('pages.products_details',compact('product_by_details'));
    }

}
