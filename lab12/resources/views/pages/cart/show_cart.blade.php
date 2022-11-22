@extends('layout')
@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{ URL::to('/') }}">Trang Chủ</a></li>
                    <li class="active">Giỏ Hàng</li>
                </ol>
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
                    //echo '<pre>';
                    $cart_content = Cart::content();
                    // print_r($cart_content);
                    // echo '</pre>';
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
                                <p>{{ number_format($cart->price ).' '.'VND'}}</p>
                            </td>
                            <td class="cart_quantity">
                                <form action="{{ URL::to('update-qty-cart')  }}" method="POST">
                                    {{ csrf_field() }}
                                <div class="cart_quantity_button">
                                    <input type="hidden" value="{{ $cart->rowId }}" name="rowid">
                                    <input style="width: 80px;" class="cart_quantity_input" type="number" name="quantity"
                                        value="{{ $cart->qty }}" min="1">
                                    <input class="cart_quantity_input"  type="submit" value="cập nhật ">
                                </div>
                            </form>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">{{number_format($cart->price *  $cart->qty ).' '.'VND' }}</p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" href="{{ URL::to('/delete-cart?rowId='. $cart->rowId) }}"><i class="fa fa-times"></i></a>
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!--/#cart_items-->

    <section id="do_action">
		<div class="container">
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Tổng Giỏ Hàng <span>{{Cart::priceTotal(0,',','.').' '.'VND' }}</span></li>
							<li>Thuế <span>{{Cart::tax(0,',','.').' '.'VND' }}</span></li>
							<li>Phí Vận Chuyển <span>Free</span></li>
							<li>Thành Tiền <span>{{Cart::total(0,',','.').' '.'VND' }}</span></li>
						</ul>
							{{-- <a class="btn btn-default update" href="">Update</a> --}}

							<?php
                                    $customer_id = Session::get('customer_id');
                                    if($customer_id == NULL){

                                ?>
                                <a class="btn btn-default check_out" href="{{ URL::to('/login-checkout') }}">Thanh Toán</a>
                                <?php
                                 }
                                    else {
                                        ?>
                               <a class="btn btn-default check_out" href="{{ URL::to('/check-out') }}">Thanh Toán</a>
                                <?php
                                    }
                                    ?>

							
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
@endsection
