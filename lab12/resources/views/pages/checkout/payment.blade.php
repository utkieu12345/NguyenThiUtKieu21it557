@extends('layout')
@section('content')
    <section id="cart_items">
        <div class="container">

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{ URL::to('/') }}">Trang Chủ</a></li>
                    <li class="active">Thanh Toán Giỏ Hàng</li>
                </ol>
            </div>

            <div class="review-payment">
                <h2>Xem Lại Giỏ Hàng</h2>
            </div>

            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                        <tr class="cart_menu">
                            <td class="image">Hình Ảnh Sản Phẩm</td>
                            <td class="description">Mô Tả</td>
                            <td class="price">Giá</td>
                            <td class="quantity">Số Lượng</td>
                            <td class="total">Tổng Tiền</td>
                            <td></td>
                        </tr>
                    </thead>
                    <?php
                    $cart_content = Cart::content();
                    ?>
                    <tbody>
                        @foreach ($cart_content as $key => $cart)
                            <td class="cart_product">
                                <a href=""><img style="object-fit: cover" width="70px" height=""
                                        src="{{ URL::to('public/uploads/product/' . $cart->options->image) }}"
                                        alt=""></a>
                            </td>
                            <td class="cart_description">
                                <h4><a href="">{{ $cart->name }}</a></h4>
                                <p>ID: {{ $cart->id }}</p>
                            </td>
                            <td class="cart_price">
                                <p>{{ number_format($cart->price) . ' ' . 'VND' }}</p>
                            </td>
                            <td class="cart_quantity">
                                <form action="{{ URL::to('update-qty-cart') }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="cart_quantity_button">
                                        <input type="hidden" value="{{ $cart->rowId }}" name="rowid">
                                        <input style="width: 80px;" class="cart_quantity_input" type="number"
                                            name="quantity" value="{{ $cart->qty }}" min="1">
                                        <input class="cart_quantity_input" type="submit" value="cập nhật ">
                                    </div>
                                </form>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">{{ number_format($cart->price * $cart->qty) . ' ' . 'VND' }}</p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete"
                                    href="{{ URL::to('/delete-cart?rowId=' . $cart->rowId) }}"><i
                                        class="fa fa-times"></i></a>
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <h4 style="padding-bottom:50px ">Chọn hình thức thanh toán</h4>
            <div class="payment-options">
                <form action="{{ URL::to('/order-place') }}" method="POST">
                    {{ csrf_field() }}
                    <span>
                        <label><input type="radio"  name="payment_options_name" value="1"> Thẻ ATM</label>
                    </span>
                    <span>
                        <label><input type="radio" name="payment_options_name" value="2"> Thẻ Ghi Nợ</label>
                    </span>
                    <span>
                        <label><input type="radio" name="payment_options_name" value="3"> Tiền Mặt</label>
                    </span>
                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" value="Đặt Hàng">
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
