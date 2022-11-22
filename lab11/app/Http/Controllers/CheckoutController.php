<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Feeship;
use App\Models\Order;
use App\Models\Shipping;
use App\Models\OrderDetails;
use Cart;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;

session_start();
class CheckoutController extends Controller
{

    public function check_out()
    {
        $result_customer = DB::table('tbl_customers')->where('customer_id', Session::get('customer_id'))->first();

        $dataCategory = DB::table('tbl_category_product')
            ->where('category_status', '1')
            ->orderby('category_id', 'desc')->get();
        $dataBrand = DB::table('tbl_brand_product')
            ->where('brand_status', '1')
            ->orderby('brand_id', 'desc')->get();
        return view('pages.checkout.checkout')->with('category', $dataCategory)->with('brand', $dataBrand)->with('customer', $result_customer);
    }

    public function save_checkout_customer(Request $request)
    {
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_address'] = $request->shipping_address;
        $data['shipping_notes'] = $request->shipping_notes;

        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);
        session()->put('shipping_id', $shipping_id);
        return redirect('/pay-ment');
    }

    public function pay_ment()
    {
        $dataCategory = DB::table('tbl_category_product')
            ->where('category_status', '1')
            ->orderby('category_id', 'desc')->get();
        $dataBrand = DB::table('tbl_brand_product')
            ->where('brand_status', '1')
            ->orderby('brand_id', 'desc')->get();
        return view('pages.checkout.payment')->with('category', $dataCategory)->with('brand', $dataBrand);
    }
    public function order_place(Request $request)
    {
        // Thêm dữ liệu vào bảng payment
        $data_payment['payment_method'] = $request->payment_options_name;
        $data_payment['payment_status'] = 'Đang chờ xữ lý';
        $payment_id = DB::table('tbl_payment')->insertGetId($data_payment);

        // Thêm dữ liệu vào bảng order
        $data_order['customer_id'] = Session::get('customer_id');
        $data_order['shipping_id'] = Session::get('shipping_id');
        $data_order['payment_id'] = $payment_id;
        $data_order['order_total'] = Cart::total();
        $data_order['order_status'] = 'Đang chờ xữ lý';
        $order_id = DB::table('tbl_order')->insertGetId($data_order);

        // Thêm dữ liệu vào bảng order_details
        $contenCart = Cart::content();
        foreach ($contenCart as $key => $val_conten) {
            $data_order_details['order_id'] = $order_id;
            $data_order_details['product_id'] = $val_conten->id;
            $data_order_details['product_name'] = $val_conten->name;
            $data_order_details['product_price'] = $val_conten->price;
            $data_order_details['product_sales_quantity'] = $val_conten->qty;
            DB::table('tbl_order_details')->insert($data_order_details);
        }
        if ($request->payment_options_name == 1) {
            echo "Thanh Toán Bằng Thẻ ATM";
        } else if ($request->payment_options_name == 2) {
            echo "Thanh Toán Bằng Thẻ Ghi Nợ";
        } else {
            Cart::destroy();
            $dataCategory = DB::table('tbl_category_product')
                ->where('category_status', '1')
                ->orderby('category_id', 'desc')->get();
            $dataBrand = DB::table('tbl_brand_product')
                ->where('brand_status', '1')
                ->orderby('brand_id', 'desc')->get();
            return view('pages.checkout.hashcash')->with('category', $dataCategory)->with('brand', $dataBrand);
        }
    }
    /* Ajax*/
    public function check_out_ajax()
    {
        $result_customer = DB::table('tbl_customers')->where('customer_id', Session::get('customer_id'))->first();
        $cities = City::orderby('matp', 'ASC')->get();
        $dataCategory = DB::table('tbl_category_product')
            ->where('category_status', '1')
            ->orderby('category_id', 'desc')->get();
        $dataBrand = DB::table('tbl_brand_product')
            ->where('brand_status', '1')
            ->orderby('brand_id', 'desc')->get();
        return view('pages.checkout.checkout_ajax')->with('category', $dataCategory)->with('brand', $dataBrand)->with('customer', $result_customer)->with('cities', $cities);
    }
    public function caculator_fee(Request $request)
    {
        $data = $request->all();
        if ($data != null) {
            $feeship = Feeship::where('fee_matp', $data['id_city'])->where('fee_maqh', $data['id_province'])->where('fee_maxp', $data['id_wards'])->first();
            if ($feeship != null) {
                session()->put('fee', $feeship['fee_feeship']);
                session()->save();
            } else {
                session()->put('fee', 30000); /* Cài FeeShip Mặc Định 30K */
                session()->save();
            }
        }
    }

    public function unset_cart_fee()
    {
        session()->forget('fee');
        //    return redirect('/check-out-ajax');
        return redirect()->back();
    }

    public function confirm_order(Request $request)
    {
        $data = $request->all();
        /* Lưu Dữ Liệu Vào Bảng Shipping */
        $shipping = new Shipping();
        $shipping->shipping_name = $data['shipping_name'];
        $shipping->shipping_email = $data['shipping_email'];
        $shipping->shipping_phone = $data['shipping_phone'];
        $shipping->shipping_address = $data['shipping_address'];
        $shipping->shipping_notes = $data['shipping_notes'];
        $shipping->shipping_menthod = $data['payment_select'];
        $shipping->save();

        $shipping_id  = DB::getPdo('tbl_shipping')->lastInsertId(); /*Lấy ID trường dữ liệu insert in data lần cuối */
        $check_out_code = 'OC'.rand(0001,9999);
        /* Lưu Dữ Liệu Vào Bảng Order */
        $order = new Order();
        $order->customer_id = session()->get('customer_id');
        $order->shipping_id = $shipping_id;
        $order->order_status = 1;
        $order->order_code = $check_out_code;
        $order ->save();

        if(session()->get('cart'))
        {
        /* Lưu Dữ Liệu Vào Bảng OrderDetails */
        foreach(session()->get('cart') as $key => $cart){
        $orderdetails = new OrderDetails();
        $orderdetails->order_code =  $check_out_code;
        $orderdetails->product_id = $cart['cart_product_id'];
        $orderdetails->product_name = $cart['cart_product_name'];
        $orderdetails->product_price = $cart['cart_product_price'];
        $orderdetails->product_sales_quantity = $cart['cart_product_qty'];
        $orderdetails->product_coupon = $data['order_coupon'];
        $orderdetails->product_fee = $data['order_fee'];
        $orderdetails ->save();
        }
        }

      session()->forget('coupon');
      session()->forget('fee');
      session()->forget('cart');

    }

    /* Back-End */
    // public function order_manager()
    // {
    //     $all_order = DB::table('tbl_order')
    //         ->join('tbl_customers', 'tbl_customers.customer_id', '=', 'tbl_order.customer_id')
    //         ->select('tbl_order.*', 'tbl_customers.customer_name') /* Bảng order thì lấy tất cả dữ liệu , còn bảng customer lấy mỗi customer_name */
    //         ->orderby('tbl_order.order_id', 'desc')
    //         ->get(); /* Lấy toàn bộ dữ liệu trong bảng được nối */

    //     $manager_order = view('admin.Order.order_manager')->with('all_order', $all_order);
    //     return view('admin_layout')->with('admin.Order.order_manager', $manager_order);
    // }

    // public function view_order(Request $request)
    // {
    //     $order_by_id = DB::table('tbl_order')
    //         ->join('tbl_customers', 'tbl_customers.customer_id', '=', 'tbl_order.customer_id')
    //         ->join('tbl_shipping', 'tbl_shipping.shipping_id', '=', 'tbl_order.shipping_id')
    //         ->join('tbl_order_details', 'tbl_order_details.order_id', '=', 'tbl_order.order_id')
    //         ->select('tbl_order.*', 'tbl_customers.*', 'tbl_shipping.*', 'tbl_order_details.*') /* Bảng order thì lấy tất cả dữ liệu , còn bảng customer lấy mỗi customer_name */
    //         ->orderby('tbl_order.order_id', 'desc')
    //         ->where('tbl_order.order_id', $request->order_id)
    //         ->first(); /* Lấy toàn bộ dữ liệu trong bảng được nối */
    //     // echo '<pre>';
    //     // print_r($all_order);
    //     // echo '</pre>';
    //     $manager_order = view('admin.Order.view_order')->with('order', $order_by_id);
    //     return view('admin_layout')->with('admin.Order.view_order', $manager_order);
    // }
    // public function delete_order(Request $request)
    // {

    // }
}
