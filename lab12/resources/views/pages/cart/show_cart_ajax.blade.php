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
            <?php
               $mesage = Session::get('mesage');
               if ($mesage) {
                   echo $mesage;
                   Session::put('mesage', null);
               }
               ?>
            <thead>
               <tr class="cart_menu">
                  <td class="image">Hình Ảnh Sản Phẩm</td>
                  <td class="description">Tên Sản Phẩm</td>
                  <td class="price">Giá</td>
                  <td class="quantity">Số Lượng</td>
                  <td class="total">Tổng Tiền</td>
                  <td></td>
               </tr>
            </thead>
            <tbody>
               @php
               $total = 0;
               @endphp
               @if (Session::get('cart') != null)
               @foreach (Session::get('cart') as $key => $value)
               <td class="cart_product">
                  <a href=""><img style="object-fit: cover" width="70px" height=""
                     src="{{ URL::to('/public/uploads/product/' . $value['cart_product_image']) }}"
                     alt=""></a>
               </td>
               <td class="cart_description">
                  <h4><a href=""> </a></h4>
                  <p>{{ $value['cart_product_name'] }}</p>
               </td>
               <td class="cart_price">
                  <p>{{ number_format($value['cart_product_price'], 0, ',', '.') }}</p>
               </td>
               <td class="cart_quantity">
                  <div class="cart_quantity_button">
                     <input data-session_id="{{ $value['session_id'] }}" style="width: 80px;"
                        class="cart_quantity_ajax" type="number" name=""
                        value="{{ $value['cart_product_qty'] }}" min="1">
                  </div>
               </td>
               <td class="cart_total">
                  <p class="cart_total_price">
                     {{ number_format($value['cart_product_price'] * $value['cart_product_qty'], 0, ',', '.') }}
                  </p>
               </td>
               @php
               $total += $value['cart_product_price'] * $value['cart_product_qty'];
               @endphp
               <td class="cart_delete">
                  <button class="cart_quantity_delete" data-session_id="{{ $value['session_id'] }}"><i
                     class="fa fa-times"></i></button>
               </td>
               </tr>
               @endforeach
               @else
               <tr>
                  <td style="text-align: center" colspan="5">Làm ơn thêm sản phẩm</td>
               </tr>
               @endif
            </tbody>
            @if(Session::get('cart') != null)
            <tr>
               <td>
                  <form action="{{ URL::to('/check-cart-coupon') }}" method="GET">
                     <input type="text" name="coupon_name_code" placeholder="Nhập vào mã giảm giá">
                     <button style="margin-top:-3px; margin-left:-2px  " class="btn btn-default check_out"> Xác
                     Nhận</button>
                  </form>
               </td>
            </tr>
            <tr>
               <td> <button id="delete-all-cart-ajax" class="btn btn-default check_out"><i class="fa fa-times"></i>
                  Xóa Tất Cả</button>
               </td>
               @if ( Session::get('coupon') != null)
               <td>
                  <a href="{{ URL::to('unset-cart-coupon') }}">
                  <button id="delete-all-cart-ajax" class="btn btn-default check_out"><i class="fa fa-times"></i>
                  Xóa Mã Giảm Giá</button>
                  </a>
               </td>
               @endif
            </tr>
            @endif
         </table>
         <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(".cart_quantity_ajax").change(function() {
                var id = $(this).data('session_id');
                var qty = $(this).val();
            
                $.ajax({
                    url: '{{ url('/changeqty-cart-ajax') }}',
                    method: 'GET',
                    data: {
                        id: id,
                        qty: qty,
                    },
                    success: function(data) {
                        window.location.href = "{{ url('/show-cart-ajax') }}";
            
                    },
                    error: function(data) {
                        alert("Nhân Ơi Fix Bug Huhu :<");
                    },
                });
            });
            
            $(".cart_quantity_delete").click(function() {
                var id = $(this).data('session_id');
                $.ajax({
                    url: '{{ url('/delete-cart-ajax') }}',
                    method: 'GET',
                    data: {
                        id: id,
                    },
                    success: function(data) {
            
                        window.location.href = "{{ url('/show-cart-ajax') }}";
            
                    },
                    error: function(data) {
                        alert("Nhân Ơi Fix Bug Huhu :<");
                    },
                });
            });
            
            $("#delete-all-cart-ajax").click(function() {
            
                $.ajax({
                    url: '{{ url('/delete-all-cart-ajax') }}',
                    method: 'GET',
                    data: {
            
                    },
                    success: function(data) {
            
                        window.location.href = "{{ url('/show-cart-ajax') }}";
            
                    },
                    error: function(data) {
                        alert("Nhân Ơi Fix Bug Huhu :<");
                    },
                });
            });
         </script>
      </div>
   </div>
</section>
<!--/#cart_items-->
<section id="do_action">
   <div class="container">
      <div class="col-sm-6">
         @if (Session::get('cart') != null)
         <div class="total_area">
            <?php
               $coupon =  Session::get('coupon');
               if( $coupon != NULL){
                   if ($coupon['coupon_condition'] == 1) {
                   $coupon_price_sale = $coupon['coupon_price_sale'];
                   $reduce_price =  ($total / 100) *   $coupon_price_sale;
               }
               if ($coupon['coupon_condition'] == 2) {
                   $coupon_price_sale = $coupon['coupon_price_sale'];
                   $reduce_price = $coupon_price_sale;
               }
               $money =  $total -  $reduce_price ;
               }else{
                   $money =  $total;
               }
               
               ?>
            <ul>
               <li>Tổng Giỏ Hàng <span> {{ number_format($total, 0, ',', '.') }} </span></li>
               <li>Thuế <span> </span></li>
               @if ($coupon != null)
               <li>Mã Giảm Giá <span> {{ $coupon['coupon_name_code'] }}</span></li>
               <li>Giảm  <span> {{ number_format($reduce_price, 0, ',', '.') }}</span></li>
               @endif
               <li>Phí Vận Chuyển <span>Free</span></li>
               <li>Thành Tiền <span>{{ number_format($money, 0, ',', '.') }} </span></li>
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
            <a class="btn btn-default check_out" href="{{ URL::to('/check-out-ajax') }}">Thanh Toán</a>
            <?php
               }
               ?>
         </div>
         @endif
      </div>
   </div>
   </div>
</section>
<!--/#do_action-->
@endsection