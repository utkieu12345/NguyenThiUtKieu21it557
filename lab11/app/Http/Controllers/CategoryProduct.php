<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;

session_start();
class CategoryProduct extends Controller
{
    public function add_category_product()
    {
        return view('admin.Category.add_category_product');
    }

    public function all_category_product()
    {

        $all_category_product = DB::table('tbl_category_product')->get(); /* Lấy toàn bộ dữ liệu trong bảng tbl_category_product */
        $manager_category_product = view('admin.Category.all_category_product')->with('all_category_product', $all_category_product);
        return view('admin_layout')->with('admin.Category.all_category_product', $manager_category_product);
    }
    public function save_category_product(Request $request)
    {
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['meta_keywords'] = $request->meta_keywords;
        $data['category_status'] = $request->category_product_status;
        DB::table('tbl_category_product')->insert($data); /* insert into dữ liệu trong bảng tbl_category_product */
        Session::put('mesage', 'Thêm thành công');
        return Redirect('all-category-product');
    }
    public function edit_category_product(Request $request)
    {
        $dataOld = array();
        $dataOld = DB::table('tbl_category_product')->where('category_id', $request->category_id)->get();
        $managerdataOld_category_product = view('admin.edit_category_product')->with('dataOld', $dataOld);
        // print_r($dataOld);
        return view('admin_layout')->with('admin.edit_category_product', $managerdataOld_category_product);
        return Redirect('edit-category-product');
    }
    public function update_category_product(Request $request)
    {
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['meta_keywords'] = $request->meta_keywords;
        DB::table('tbl_category_product')->where('category_id', $request->category_product_id)->update($data); /* insert into dữ liệu trong bảng tbl_category_product */
        Session::put('mesage', 'Cập nhật thành công');
        return Redirect('all-category-product');
    }
    public function delete_category_product(Request $request)
    {
        DB::table('tbl_category_product')->where('category_id', $request->category_id)->delete(); /* insert into dữ liệu trong bảng tbl_category_product */
        Session::put('mesage', 'Xóa thành công');
        return Redirect('all-category-product');
    }

    public function active_category_product(Request $request)
    {
        DB::table('tbl_category_product')->where('category_id', $request->category_id)->update(['category_status' => 1]);
        Session::put('mesage', 'Kích hoạt trạng thái thành công');
        return Redirect('all-category-product');
    }
    public function unactive_category_product(Request $request)
    {
        DB::table('tbl_category_product')->where('category_id', $request->category_id)->update(['category_status' => 0]);
        Session::put('mesage', 'Đã vô hiệu hóa');
        return Redirect('all-category-product');
    }

    //Font-end
    public function show_danh_muc_san_pham_home(Request $request){

        $dataCategory = DB::table('tbl_category_product')
            ->where('category_status', '1')
            ->orderby('category_id', 'desc')->get();
        $dataBrand = DB::table('tbl_brand_product')
            ->where('brand_status', '1')
            ->orderby('brand_id', 'desc')->get();
        $category_by_id = DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')
        ->where('tbl_product.category_id',$request->categoty_id)->get();
        $category_name = DB::table('tbl_category_product')->where('category_id',$request->categoty_id)->first();

        foreach( $category_by_id as $key => $v_category){
         /* SEO */
         $meta_desc = $v_category->category_desc;
         $meta_keywords = $v_category->meta_keywords;
         $meta_title =  $v_category->category_name;
         $url_canonical = $request->url();
         /* END SEO */
        }
      
      
        return view('pages.category.show_category')->with('category', $dataCategory)->with('brand', $dataBrand)->with('category_by_id',$category_by_id)->with('category_name',$category_name) 
        ->with('meta_desc',$meta_desc)
        ->with('meta_keywords',$meta_keywords)
        ->with('meta_title',$meta_title)
        ->with('url_canonical',$url_canonical);
    }
  
}
