<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
session_start();

class HomeController extends Controller
{
    public function index(Request $request)
    {
        /* SEO */
        $meta_desc = 'ahihi';
        $meta_keywords = 'ahihi';
        $meta_title = 'ahihi';
        $url_canonical = $request->url();
        /* END SEO */
        $dataCategory = DB::table('tbl_category_product')
            ->where('category_status', '1')
            ->orderby('category_id', 'desc')->get();
        $dataBrand = DB::table('tbl_brand_product')
            ->where('brand_status', '1')
            ->orderby('brand_id', 'desc')->get();
        $allProduct = DB::table('tbl_product')
            ->where('product_status', '1')
            ->orderby('product_id', 'desc')
            ->limit(8)
            ->get();
        return view('pages.home')->with('category', $dataCategory)->with('brand', $dataBrand)->with('product', $allProduct)
        ->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)
        ->with('meta_title',$meta_title)
        ->with('url_canonical',$url_canonical)
        ; // cách 1
      //  return view('pages.home')->with(compact('dataCategory','dataBrand','allProduct')); // cách 2
    }

    public function search_product(Request $request)
    { 
       
        $key_search = '%'.$request->search_product.'%';

        $dataCategory = DB::table('tbl_category_product')
            ->where('category_status', '1')
            ->orderby('category_id', 'desc')->get();
        $dataBrand = DB::table('tbl_brand_product')
            ->where('brand_status', '1')
            ->orderby('brand_id', 'desc')->get();
          
        $result_Product = DB::table('tbl_product')
            ->where('product_name', 'like',$key_search)
            ->limit(4)
            ->get();
          
        return view('pages.home')->with('category', $dataCategory)->with('brand', $dataBrand)->with('product',  $result_Product);
    }
}
