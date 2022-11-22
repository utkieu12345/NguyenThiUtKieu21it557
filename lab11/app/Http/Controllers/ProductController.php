<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;

session_start();

class ProductController extends Controller
{
    public function add_product()
    {
        $dataCategory = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
        $dataBrand = DB::table('tbl_brand_product')->orderby('brand_id', 'desc')->get();
        // echo'<pre>';
        // print_r($dataBrand);
        // echo'</pre>';
        return view('admin.Product.add_product')->with('dataCategory', $dataCategory)->with('dataBrand', $dataBrand);

    }

    public function all_product()
    {
        $sort = 1;
        $all_product = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand_product', 'tbl_brand_product.brand_id', '=', 'tbl_product.brand_id')
            ->get(); /* Lấy toàn bộ dữ liệu trong bảng được nối */
        $manager_product = view('admin.Product.all_product')->with('all_product', $all_product)->with('sort', $sort);
        return view('admin_layout')->with('admin.Product.all_product', $manager_product);
    }
    public function save_product(Request $request)
    {
        /* Lưu Ý -> Tên Index Của Mảng Phải Trùng Với Tên Trường Trong Tab */
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['category_id'] = $request->product_category;
        $data['brand_id'] = $request->product_brand;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['product_price'] = $request->product_price;

        //$data['product_image'] = $request->product_image;
        $get_image = $request->file('product_image');
        if ($get_image) {
            $get_image_name = $get_image->getClientOriginalName(); /* Lấy Tên File */
            $image_name = current(explode('.', $get_image_name)); /* VD Tên File Là nhan.jpg thì hàm explode dựa vào dấm . để phân tách thành 2 chuổi là nhan và jpg , còn hàm current để chuổi đầu , hàm end thì lấy cuối */
            $new_image = $image_name . rand(0, 99) . '.' . $get_image->getClientOriginalExtension(); /* getClientOriginalExtension() hàm lấy phần mở rộng của ảnh */
            $get_image->move('public/uploads/product', $new_image);
            $data['product_image'] = $new_image;
        } else {
            $data['product_image'] = '';
        }

        $data['product_status'] = $request->product_status;
        DB::table('tbl_product')->insert($data); /* insert into dữ liệu trong bảng tbl_product */
        Session::put('mesage', 'Thêm thành công');
        return Redirect('all-product');
    }
    public function edit_product(Request $request)
    {
        $dataCategory = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
        $dataBrand = DB::table('tbl_brand_product')->orderby('brand_id', 'desc')->get();
        $dataOld = array();
        $dataOld = DB::table('tbl_product')->where('product_id', $request->product_id)->get();
        $managerdataOld_product = view('admin.Product.edit_product')->with('dataOld', $dataOld)->with('dataCategory', $dataCategory)->with('dataBrand', $dataBrand);
        //   print_r($dataOld);
        return view('admin_layout')->with('admin.Product.edit_product', $managerdataOld_product);
        return Redirect('edit-product');
    }
    public function update_product(Request $request)
    {
        /* Lưu Ý -> Tên Index Của Mảng Phải Trùng Với Tên Trường Trong Tab */
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['category_id'] = $request->product_category;
        $data['brand_id'] = $request->product_brand;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['product_price'] = $request->product_price;

        //$data['product_image'] = $request->product_image;
        $get_image = $request->file('product_image');
        if ($get_image) {
            $get_image_name = $get_image->getClientOriginalName(); /* Lấy Tên File */
            $image_name = current(explode('.', $get_image_name)); /* VD Tên File Là nhan.jpg thì hàm explode dựa vào dấm . để phân tách thành 2 chuổi là nhan và jpg , còn hàm current để chuổi đầu , hàm end thì lấy cuối */
            $new_image = $image_name . rand(0, 99) . '.' . $get_image->getClientOriginalExtension(); /* getClientOriginalExtension() hàm lấy phần mở rộng của ảnh */
            $get_image->move('public/uploads/product', $new_image);
            $data['product_image'] = $new_image;
        } else {
            // $data['product_image'] = '';
        }

       
        DB::table('tbl_product')->where('product_id', $request->product_id)->update($data); /* insert into dữ liệu trong bảng tbl_product */
        Session::put('mesage', 'Cập nhật thành công');
        return Redirect('all-product');
    }
    public function delete_product(Request $request)
    {
        DB::table('tbl_product')->where('product_id', $request->product_id)->delete(); /* delete dữ liệu trong bảng tbl_product */
        Session::put('mesage', 'Xóa thành công');
        return Redirect('all-product');
    }

    public function active_product(Request $request)
    {
        DB::table('tbl_product')->where('product_id', $request->product_id)->update(['product_status' => 1]);
        Session::put('mesage', 'Kích hoạt trạng thái thành công');
        return Redirect('all-product');
    }
    public function unactive_product(Request $request)
    {
        DB::table('tbl_product')->where('product_id', $request->product_id)->update(['product_status' => 0]);
        Session::put('mesage', 'Đã vô hiệu hóa');
        return Redirect('all-product');
    }
    public function all_product_sort_az()
    {
        $sort = 0;
        $all_product = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand_product', 'tbl_brand_product.brand_id', '=', 'tbl_product.brand_id')
            ->orderby('product_name', 'asc')
            ->get(); /* Lấy toàn bộ dữ liệu trong bảng được nối */
        $manager_product = view('admin.all_product')->with('all_product', $all_product)->with('sort', $sort);
        return view('admin_layout')->with('admin.Product.all_product', $manager_product);
    }
    public function all_product_sort_za()
    {
        $sort = 1;
        $all_product = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand_product', 'tbl_brand_product.brand_id', '=', 'tbl_product.brand_id')
            ->orderby('product_name', 'desc')
            ->get(); /* Lấy toàn bộ dữ liệu trong bảng được nối */
        $manager_product = view('admin.all_product')->with('all_product', $all_product)->with('sort', $sort);
        return view('admin_layout')->with('admin.Product.all_product', $manager_product);
    }
    public function all_product_sreachbyname(Request $request)
    {
        $searchbyname_format = '%'.$request->searchbyname.'%';
        $sort = 0;
        $all_product = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand_product', 'tbl_brand_product.brand_id', '=', 'tbl_product.brand_id')
            ->where('product_name','like',$searchbyname_format)
            ->get(); /* Lấy toàn bộ dữ liệu trong bảng được nối */
        $manager_product = view('admin.Product.all_product')->with('all_product', $all_product)->with('sort', $sort);
        return view('admin_layout')->with('admin.Product.all_product', $manager_product);
    }

    public function import_csv(){

    }

    public function export_csv(){
        
    }
    // font-end
    public function chi_tiet_san_pham(Request $request)
    {
        $dataCategory = DB::table('tbl_category_product')
            ->where('category_status', '1')
            ->orderby('category_id', 'desc')->get();
        $dataBrand = DB::table('tbl_brand_product')
            ->where('brand_status', '1')
            ->orderby('brand_id', 'desc')->get();
        $detailsProduct = DB::table('tbl_product')
        ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
        ->join('tbl_brand_product', 'tbl_brand_product.brand_id', '=', 'tbl_product.brand_id')
        ->where('tbl_product.product_id',$request->product_id)->where('tbl_product.product_status','1')->first();
         //print_r($detailsProduct);
        // echo $detailsProduct->product_id;
        // Lấy mã thể loại của sản phẩm chi tiết
        $category_id = $detailsProduct->category_id;
        // $related_Product Lấy ra toàn bộ sản phẩm có cùng thể loại với sản phẩm chi tiết 
        $related_Product = DB::table('tbl_product')
        ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
        ->join('tbl_brand_product', 'tbl_brand_product.brand_id', '=', 'tbl_product.brand_id')
        ->where('tbl_category_product.category_id',$category_id)
        ->whereNotIn('tbl_product.product_id',[$request->product_id]) /* Phải là mảng nên có ngoặc vuông */
        ->where('tbl_category_product.category_status','1')
        ->get();
       // print_r($related_Product);
        return view('pages.product.show_details')->with('category', $dataCategory)->with('brand', $dataBrand)
        ->with('detailsProduct', $detailsProduct)->with('related_Product', $related_Product);
    }
}
