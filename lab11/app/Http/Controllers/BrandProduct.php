<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;

session_start();

class BrandProduct extends Controller
{
    public function add_brand_product()
    {
        return view('admin.Brand.add_brand_product');
    }

    public function all_brand_product()
    {

        $all_brand_product = DB::table('tbl_brand_product')->get(); /* Lấy toàn bộ dữ liệu trong bảng tbl_brand_product */
        $manager_brand_product = view('admin.Brand.all_brand_product')->with('all_brand_product',$all_brand_product);
        return view('admin_layout')->with('admin.Brand.all_brand_product',$manager_brand_product);
    }
    public function save_brand_product(Request $request)
    {
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        $data['brand_status'] = $request->brand_product_status;
        DB::table('tbl_brand_product')->insert($data); /* insert into dữ liệu trong bảng tbl_brand_product */
        Session::put('mesage', 'Thêm thành công');
        return Redirect('all-brand-product');
    }
    public function edit_brand_product(Request $request)
    {
        $dataOld = array();
        $dataOld = DB::table('tbl_brand_product')->where('brand_id',$request->brand_id)->get();
        $managerdataOld_brand_product = view('admin.Brand.edit_brand_product')->with('dataOld', $dataOld);
        // print_r($dataOld);
        return view('admin_layout')->with('admin.Brand.edit_brand_product', $managerdataOld_brand_product);
        return Redirect('edit-brand-product');
    }
    public function update_brand_product(Request $request)
    {
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        DB::table('tbl_brand_product')->where('brand_id',$request->brand_product_id)->update($data); /* insert into dữ liệu trong bảng tbl_brand_product */
        Session::put('mesage', 'Cập nhật thành công');
        return Redirect('all-brand-product');
    }
    public function delete_brand_product(Request $request)
    {
        DB::table('tbl_brand_product')->where('brand_id',$request->brand_id)->delete(); /* insert into dữ liệu trong bảng tbl_brand_product */
        Session::put('mesage', 'Xóa thành công');
        return Redirect('all-brand-product');
    }

    public function active_brand_product(Request $request)
    {
      DB::table('tbl_brand_product')->where('brand_id',$request->brand_id)->update(['brand_status' => 1]);
        Session::put('mesage', 'Kích hoạt trạng thái thành công');
       return Redirect('all-brand-product');
    }
    public function unactive_brand_product(Request $request)
    {
        DB::table('tbl_brand_product')->where('brand_id',$request->brand_id)->update(['brand_status' => 0]);
        Session::put('mesage', 'Đã vô hiệu hóa');
        return Redirect('all-brand-product');
    }

    //font-end
    public function show_thuong_hieu_san_pham_home(Request $request){
        $dataCategory = DB::table('tbl_category_product')
            ->where('category_status', '1')
            ->orderby('category_id', 'desc')->get();
        $dataBrand = DB::table('tbl_brand_product')
            ->where('brand_status', '1')
            ->orderby('brand_id', 'desc')->get();
        $brand_by_id = DB::table('tbl_product')->join('tbl_brand_product','tbl_product.brand_id','=','tbl_brand_product.brand_id')
        ->where('tbl_product.brand_id',$request->brand_id)->get();
        $brand_name = DB::table('tbl_brand_product')->where('brand_id',$request->brand_id)->first();
        return view('pages.brand.show_brand')->with('category', $dataCategory)->with('brand', $dataBrand)->with('brand_by_id', $brand_by_id)->with('brand_name',$brand_name);
    }
}
