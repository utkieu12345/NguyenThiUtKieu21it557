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

Route::get('/', 'HomeController@index');

Route::get('/trang-chu', 'HomeController@index');

Route::get('/admin', 'AdminController@index');

Route::get('/dashboard', 'AdminController@show_dashboard');

Route::get('/product', function () {
    return view('pages.home');
});
Route::get('/product', function () {
    return view('pages.product');
});
Route::get('/news', function () {
    return view('pages.news');
});
Route::get('/contact', function () {
    return view('pages.contact');
});

Route::post('/admin-dashboard', 'AdminController@dashboard');
Route::get('/logout', 'AdminController@logout');

//Category Product
Route::get('/add-category-product', 'CategoryProduct@add_category_product');
Route::get('/all-category-product', 'CategoryProduct@all_category_product');
Route::post('/save-category-product', 'CategoryProduct@save_category_product');

// Sản phẩm theo danh mục, thương hiệu


Route::get('/danh-muc-san-pham/{slug_category_product}', 'CategoryProduct@show_category_home');
Route::get('/thuong-hieu-san-pham/{brand_slug}', 'BrandProduct@show_brand_home');
// chi tiet san pham
Route::get('/chi-tiet-san-pham/{product_id}', 'ProductController@details_product');

//them gio hang
Route::post('/save-cart', 'CartController@save_cart');
Route::get('/show-cart', 'CartController@show_cart');

//thanh toán
Route::get('/login-checkout', 'CheckoutController@login_checkout');
//thêm khách hàng
Route::post('/add-customer', 'CheckoutController@add_customer');

//login
Route::post('/login-customer', 'CheckoutController@login_customer');
//
Route::get('/manage-order','CheckoutController@manage_order');
//
Route::get('/view-order/{orderId}','CheckoutController@view_order');