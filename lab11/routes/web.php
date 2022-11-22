<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/* Font-end */
Route::get('/', 'App\Http\Controllers\HomeController@index');
Route::get('/trang-chu', 'App\Http\Controllers\HomeController@index');
Route::get('/danh-muc-san-pham', 'App\Http\Controllers\CategoryProduct@show_danh_muc_san_pham_home');
Route::get('/danh-muc-thuong-hieu', 'App\Http\Controllers\BrandProduct@show_thuong_hieu_san_pham_home');
Route::get('/chi-tiet-san-pham', 'App\Http\Controllers\ProductController@chi_tiet_san_pham');
Route::get('/search-product', 'App\Http\Controllers\HomeController@search_product');

/* Cart */
Route::post('/save-cart', 'App\Http\Controllers\CartController@save_cart');
Route::get('/show-cart', 'App\Http\Controllers\CartController@show_cart');
Route::get('/delete-cart', 'App\Http\Controllers\CartController@delete_cart');
Route::post('/update-qty-cart', 'App\Http\Controllers\CartController@update_qty_cart');

/* Cart Bằng Ajax */
Route::post('/add-cart-ajax', 'App\Http\Controllers\CartController@add_cart_ajax');
Route::get('/show-cart-ajax', 'App\Http\Controllers\CartController@show_cart_ajax');
Route::get('/changeqty-cart-ajax', 'App\Http\Controllers\CartController@changeqty_cart_ajax');
Route::get('/delete-cart-ajax', 'App\Http\Controllers\CartController@delete_cart_ajax');
Route::get('/delete-all-cart-ajax', 'App\Http\Controllers\CartController@delete_all_cart_ajax');


Route::get('/check-cart-coupon', 'App\Http\Controllers\CartController@check_cart_coupon');
Route::get('/unset-cart-coupon', 'App\Http\Controllers\CartController@unset_cart_coupon');
/* Check out */
Route::get('/check-out', 'App\Http\Controllers\CheckoutController@check_out');
Route::post('/save-checkout-customer', 'App\Http\Controllers\CheckoutController@save_checkout_customer'); /* Có Thể Xóa */
Route::get('/pay-ment', 'App\Http\Controllers\CheckoutController@pay_ment');
Route::post('/order-place', 'App\Http\Controllers\CheckoutController@order_place');

Route::post('/caculator-fee', 'App\Http\Controllers\CheckoutController@caculator_fee');
Route::get('/unset-cart-fee', 'App\Http\Controllers\CheckoutController@unset_cart_fee');
/* Check out Ajax */
Route::get('/check-out-ajax', 'App\Http\Controllers\CheckoutController@check_out_ajax');
Route::POST('/confirm-order', 'App\Http\Controllers\CheckoutController@confirm_order');

/* Login And Register */
Route::get('/login-checkout', 'App\Http\Controllers\LoginAndRegister@login');
Route::post('/login-customer', 'App\Http\Controllers\LoginAndRegister@login_customer');
Route::get('/register', 'App\Http\Controllers\LoginAndRegister@register');
Route::post('/create-customer', 'App\Http\Controllers\LoginAndRegister@create_customer');
Route::get('/successful-create-account', 'App\Http\Controllers\LoginAndRegister@successful_create_account');

Route::get('/logout-checkout', 'App\Http\Controllers\LoginAndRegister@logout');
Route::get('/recovery-pw', 'App\Http\Controllers\LoginAndRegister@recovery_pw');
Route::post('/find-account-recovery-pw', 'App\Http\Controllers\LoginAndRegister@find_account_recovery_pw');
Route::get('/MailToCustomer', 'App\Http\Controllers\LoginAndRegister@MailToCustomer');
Route::post('/verification-code', 'App\Http\Controllers\LoginAndRegister@verification_code');
Route::post('/confirm-password', 'App\Http\Controllers\LoginAndRegister@confirm_password');



/* Back-end */
Route::get('/admin', 'App\Http\Controllers\AdminController@index');
Route::get('/dashboard', 'App\Http\Controllers\AdminController@show_dashboard');
Route::get('/logout', 'App\Http\Controllers\AdminController@logout');
Route::post('/admin-dashboard', 'App\Http\Controllers\AdminController@dashboard');

/* Category Product */
Route::get('/add-category-product', 'App\Http\Controllers\CategoryProduct@add_category_product');
Route::get('/edit-category-product', 'App\Http\Controllers\CategoryProduct@edit_category_product');
Route::get('/update-category-product', 'App\Http\Controllers\CategoryProduct@update_category_product');
Route::get('/all-category-product', 'App\Http\Controllers\CategoryProduct@all_category_product');
Route::post('/save-category-product', 'App\Http\Controllers\CategoryProduct@save_category_product');
Route::get('/delete-category-product', 'App\Http\Controllers\CategoryProduct@delete_category_product');

Route::get('/active-category-product', 'App\Http\Controllers\CategoryProduct@active_category_product');
Route::get('/unactive-category-product', 'App\Http\Controllers\CategoryProduct@unactive_category_product');

/* Brand Product */
Route::get('/add-brand-product', 'App\Http\Controllers\BrandProduct@add_brand_product');
Route::get('/edit-brand-product', 'App\Http\Controllers\BrandProduct@edit_brand_product');
Route::get('/update-brand-product', 'App\Http\Controllers\BrandProduct@update_brand_product');
Route::get('/all-brand-product', 'App\Http\Controllers\BrandProduct@all_brand_product');
Route::post('/save-brand-product', 'App\Http\Controllers\BrandProduct@save_brand_product');
Route::get('/delete-brand-product', 'App\Http\Controllers\BrandProduct@delete_brand_product');

Route::get('/active-brand-product', 'App\Http\Controllers\BrandProduct@active_brand_product');
Route::get('/unactive-brand-product', 'App\Http\Controllers\BrandProduct@unactive_brand_product');

/* Product */ 
Route::get('/add-product', 'App\Http\Controllers\ProductController@add_product');
Route::get('/edit-product', 'App\Http\Controllers\ProductController@edit_product');
Route::post('/update-product', 'App\Http\Controllers\ProductController@update_product');
Route::get('/all-product', 'App\Http\Controllers\ProductController@all_product');
Route::post('/save-product', 'App\Http\Controllers\ProductController@save_product');
Route::get('/delete-product', 'App\Http\Controllers\ProductController@delete_product');

Route::get('/active-product', 'App\Http\Controllers\ProductController@active_product');
Route::get('/unactive-product', 'App\Http\Controllers\ProductController@unactive_product');
Route::get('/all-product-sreachbyname', 'App\Http\Controllers\ProductController@all_product_sreachbyname');
Route::get('/all-product-sort_az', 'App\Http\Controllers\ProductController@all_product_sort_az');
Route::get('/all-product-sort_za', 'App\Http\Controllers\ProductController@all_product_sort_za');

/* Nhập - Xuất File Excel */
Route::post('/import-csv', 'App\Http\Controllers\ProductController@import_csv');
Route::post('/export-csv', 'App\Http\Controllers\ProductController@export_csv');

/* Order Manager */
Route::get('/order-manager', 'App\Http\Controllers\OrderController@manager_order');
Route::get('/view-order', 'App\Http\Controllers\OrderController@view_order');
Route::get('/delete-order', 'App\Http\Controllers\OrderController@delete_order');
Route::get('/print-order', 'App\Http\Controllers\OrderController@print_order');
Route::get('/generatePDF', 'App\Http\Controllers\OrderController@generatePDF');
/* Coupon */
Route::get('/add-coupon', 'App\Http\Controllers\CouponController@add_coupon');
Route::get('/edit-coupon', 'App\Http\Controllers\CouponController@edit_coupon');
Route::post('/update-coupon', 'App\Http\Controllers\CouponController@update_coupon');
Route::get('/list-coupon', 'App\Http\Controllers\CouponController@list_coupon');
Route::post('/save-coupon', 'App\Http\Controllers\CouponController@save_coupon');
Route::get('/delete-coupon', 'App\Http\Controllers\CouponController@delete_coupon');

/* Send Mail */
Route::get('/send-mail', 'App\Http\Controllers\MailController@send_mail');

/* Delivery - Vận Chuyển */
Route::get('/show-delivery', 'App\Http\Controllers\DeliveryController@show_delivery');
Route::POST('/select-dilivery', 'App\Http\Controllers\DeliveryController@select_dilivery');
Route::POST('/insert-dilivery', 'App\Http\Controllers\DeliveryController@insert_dilivery');
Route::post('/select-feeship', 'App\Http\Controllers\DeliveryController@select_feeship');
Route::POST('/update-dilivery', 'App\Http\Controllers\DeliveryController@update_dilivery');


/* Slider */
Route::get('/add-slider', 'App\Http\Controllers\SliderController@add_slider');
Route::post('/save-slider', 'App\Http\Controllers\SliderController@save_slider');
Route::get('/all-slider', 'App\Http\Controllers\SliderController@all_slider');
Route::get('/edit-slider', 'App\Http\Controllers\SliderController@edit_slider');
Route::post('/update-slider', 'App\Http\Controllers\SliderController@update_slider');
Route::get('/delete-slider', 'App\Http\Controllers\SliderController@delete_slider');
Route::get('/active-slider', 'App\Http\Controllers\SliderController@active_slider');
Route::get('/unactive-slider', 'App\Http\Controllers\SliderController@unactive_slider');

