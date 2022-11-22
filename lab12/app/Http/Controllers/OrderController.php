<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Customers;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Shipping;
use Illuminate\Http\Request;
use PDF;

session_start();

class OrderController extends Controller
{
    public function manager_order()
    {
        $order = Order::orderby('created_at', 'DESC')->get();
        return view('admin.Order.order_manager')->with(compact('order'));
    }
    public function view_order(Request $request)
    {
        $order_code = $request->order_code;

        $order = Order::where('order_code', $order_code)->first();

        $customer_id = $order['customer_id'];
        $shipping_id = $order['shipping_id'];

        $customer = Customers::where('customer_id', $customer_id)->first();
        $shipping = Shipping::where('shipping_id', $shipping_id)->first();
        $orderdetails = OrderDetails::where('order_code', $order_code)->with('Product')->get();

        foreach ($orderdetails as $key => $v_orderdetails) {
            $coupon_code = $v_orderdetails->product_coupon;
        }
        $coupon = Coupon::where('coupon_name_code', $coupon_code)->first();

        return view('admin.Order.view_order')->with(compact('orderdetails', 'customer', 'shipping', 'coupon'));
    }
    public function print_order(Request $request)
    {
        
        $data = [
            'title' => 'Welcome to LaravelTuts.com',
            'date' => date('m/d/Y'),
            'code' => $request->checkout_code,
        ]; 
       
        $pdf = PDF::loadView('pages.checkout.bill_PDF', $data);
        
        return $pdf->stream();
        // return $pdf->download('laraveltuts.pdf');
    }

}
