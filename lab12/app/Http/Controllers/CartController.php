<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Cart;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;

session_start();
class CartController extends Controller
{
    public function save_cart(Request $request)
    {

        $product_id = $request->product_id;
        $qty = $request->qty;
        $product_info = DB::table('tbl_product')->where('product_id', $product_id)->first();

        $data['id'] = $product_id;
        $data['qty'] = $qty;
        $data['name'] = $product_info->product_name;
        $data['price'] = $product_info->product_price;
        $data['weight'] = 0;
        $data['options']['image'] = $product_info->product_image;
        // Cart::setTax($rowId, 21); Đặt thuế theo rowID
        Cart::setGlobalTax(5); // Đặt thuế toàn cục
        Cart::add($data);
        // Redirect::to('/show-cart');
        //Cart::destroy();
        return redirect('/show-cart');

    }
    public function show_cart()
    {
        $dataCategory = DB::table('tbl_category_product')
            ->where('category_status', '1')
            ->orderby('category_id', 'desc')->get();
        $dataBrand = DB::table('tbl_brand_product')
            ->where('brand_status', '1')
            ->orderby('brand_id', 'desc')->get();

        return view('pages.cart.show_cart')->with('category', $dataCategory)->with('brand', $dataBrand);

    }

    public function delete_cart(Request $request)
    {
        Cart::update($request->rowId, 0); //
        return redirect('/show-cart');

    }
    public function update_qty_cart(Request $request)
    {
        Cart::update($request->rowid, ['qty' => $request->quantity]); // Will update the name
        return redirect('/show-cart');

    }

/* Ajax */
    public function add_cart_ajax(Request $request)
    {
        /* Dòng chảy dữ liệu */
        /*
        - Nhận Toàn Bộ Dữ Liệu Từ Request Đưa Vào Mảng Data
        - Tạo Session_ID và Mỗi Cart Sẽ Chứa 1 Session_ID riêng
        - Đầu Tiên Lấy Toàn Bộ Dữ Liệu Card Ở Session Cart
        - Tồn Tại Cart Thì Kiểm Tra Dữ Liệu Cart(ID Product) Đưa Xem Có Trùng Với Cart Cũ(ID Product) Không
        - Trùng Thì Không Thêm Dữ Liệu Vào Session Cart
        - Không Trùng Thì Thêm Dô
        -Trường Hợp Chưa Có Cart Thì Khởi Tạo Cart[] Rồi Thêm Vào
         */
        $data = $request->all();
        $session_id = substr(md5(microtime()), rand(0, 26), 5);
        $cart = Session::get('cart');
        if ($cart == true) {
            $is_avaiable = 0;
            foreach ($cart as $key => $value) {
                if ($value['cart_product_id'] == $data['cart_product_id']) {
                    $is_avaiable++;
                }
            }
            if ($is_avaiable == 0) {
                $cart[] = array(
                    'session_id' => $session_id,
                    'cart_product_name' => $data['cart_product_name'],
                    'cart_product_id' => $data['cart_product_id'],
                    'cart_product_image' => $data['cart_product_image'],
                    'cart_product_qty' => $data['cart_product_qty'],
                    'cart_product_price' => $data['cart_product_price'],
                );
                session()->put('cart', $cart);
            }
        } else {
            $cart[] = array(
                'session_id' => $session_id,
                'cart_product_name' => $data['cart_product_name'],
                'cart_product_id' => $data['cart_product_id'],
                'cart_product_image' => $data['cart_product_image'],
                'cart_product_qty' => $data['cart_product_qty'],
                'cart_product_price' => $data['cart_product_price'],
            );
        }
        session()->put('cart', $cart);
        Session::save();
    }
    public function show_cart_ajax()
    {  
        $dataCategory = DB::table('tbl_category_product')
            ->where('category_status', '1')
            ->orderby('category_id', 'desc')->get();
        $dataBrand = DB::table('tbl_brand_product')
            ->where('brand_status', '1')
            ->orderby('brand_id', 'desc')->get();
        
        return view('pages.cart.show_cart_ajax')->with('category', $dataCategory)->with('brand', $dataBrand);
    }
    public function changeqty_cart_ajax(Request $request) /* Gửi GET thì được POST thì không >< */
    {
        $data = $request->all();
        $cart = session()->get('cart');
        if ($cart == true) {
            foreach ($cart as $key => $value) {
                if ($value['session_id'] == $data['id']) {
                    $cart[$key]['cart_product_qty'] = $data['qty'];
                }
            }
            session()->put('cart', $cart);
        }
    }

    public function delete_cart_ajax(Request $request)
    {
        $id = $request->id;
        $cart = session()->get('cart');
        if ($cart == true) {
            foreach ($cart as $key => $value) {
                if ($value['session_id'] == $id) {
                    unset($cart[$key]);
                }
            }
        }
        session()->put('cart', $cart);
    }

    public function delete_all_cart_ajax()
    {
        $cart = session()->get('cart');
        if ($cart == true) {
            session()->forget('cart');
            session()->forget('coupon');
        }
    }

    public function check_cart_coupon(Request $request)
    {
        // $coupon_name_code = $request->coupon_name_code;
        // $coupon = Coupon::where('coupon_name_code', $coupon_name_code)->first();
        // if ($coupon) {
        //     $coupon_count = $coupon->count();
        //     if ($coupon_count > 0) {
        //         $coupon_session = Session::get('coupon');
        //     }
        //     $coupon_session = Session::get('coupon');
        //     if ($coupon_session == true) {
        //         $is_check = 0;
        //         if ($is_check == 0) {
        //             $cou[] = array(
        //                 'coupon_name_code' => $coupon->coupon_name_code,
        //                 'coupon_qty_code' => $coupon->coupon_qty_code,
        //                 'coupon_price_sale' => $coupon->coupon_price_sale,
        //             );
        //             Session::put('coupon', $cou);
        //         }

        //     } else {
        //         $cou[] = array(
        //             'coupon_name_code' => $coupon->coupon_name_code,
        //             'coupon_qty_code' => $coupon->coupon_qty_code,
        //             'coupon_price_sale' => $coupon->coupon_price_sale,
        //         );
        //         Session::put('coupon', $cou);
        //     }
            // Session::save();
            // echo '<pre>';
            // print_r(session()->all());
            // echo '</pre>';
        //     // return redirect('/show-cart-ajax')->with('mesage','Thêm Mã Giảm Giá Thành Công');
        // } else {
        //     return redirect('/show-cart-ajax')->with('mesage', 'Mã Giảm Giá Không Tồn Tại !');
        // }

        $coupon_name_code = $request->coupon_name_code;
        $coupon = Coupon::where('coupon_name_code', $coupon_name_code)->first();
        if ($coupon) {
            $cou = array(
                'coupon_name_code' => $coupon->coupon_name_code,
                'coupon_qty_code' => $coupon->coupon_qty_code,
                'coupon_price_sale' => $coupon->coupon_price_sale,
                'coupon_condition' => $coupon->coupon_condition,
            );
            Session::put('coupon', $cou);
            Session::save();
            Session::save();
            // echo '<pre>';
            // print_r(session()->all());
            // echo '</pre>';
            return redirect('/show-cart-ajax')->with('mesage','Thêm Mã Giảm Giá Thành Công');
        }
        else {
                session()->forget('coupon');
                return redirect('/show-cart-ajax')->with('mesage', 'Mã Giảm Giá Không Tồn Tại !');
            }
    }

    public function unset_cart_coupon(){
        session()->forget('coupon');
        return redirect('/show-cart-ajax')->with('mesage', 'Xóa Mã Giảm Giá Thành Công !');
    }

}
