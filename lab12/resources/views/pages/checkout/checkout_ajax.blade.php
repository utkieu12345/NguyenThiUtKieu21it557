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
            <div class="shopper-informations">
                <div class="row">
                    <form>
                        {{ csrf_field() }}
                        <div class="col-sm-12 clearfix">
                            <div class="bill-to">
                                <p>Điền thông tin nhận hàng</p>
                                <div class="form-one">
                                    <div class="form-group">
                                        <input class="form-control shipping_name" name="shipping_name" type="text"
                                            placeholder="Họ và Tên" value="{{ $customer->customer_name }}">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control shipping_email" name="shipping_email" type="text"
                                            placeholder="Email" value="{{ $customer->customer_email }}">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control shipping_phone" name="shipping_phone" type="text"
                                            placeholder="Số Điện Thoại" value="{{ $customer->customer_sdt }}">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control shipping_address" name="shipping_address" type="text"
                                            placeholder="Địa Chỉ">
                                    </div>
                                    <div class="form-group">
                                        @if (session::get('fee'))
                                            <input class="order_fee" type="hidden" name="order_fee"
                                                value="{{ session::get('fee') }}">
                                        @else
                                            <input class="order_fee" type="hidden" name="order_fee" value="30000">
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        @if (session::get('coupon'))
                                            <?php
                                            $coupon = session::get('coupon');
                                            ?>
                                            <input class="order_coupon" type="hidden" name="order_coupon"
                                                value="{{ $coupon['coupon_name_code'] }}">
                                        @else
                                            <input class="order_coupon" type="hidden" name="order_coupon" value="Không Có">
                                        @endif
                                    </div>


                                    <div class="form-group">
                                        <p>Ghi chú đơn hàng</p>
                                        <textarea class="shipping_notes" name="shipping_notes" placeholder="Ghi chú đơn hàng của bạn" rows="6"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Hình Thức Thanh Toán</label>
                                        <select class="form-control payment_select" name="" id="">
                                            <option value="0">Thanh Toán Bằng Tiền Mặt</option>
                                            <option value="1">Thanh Toán Bằng ATM</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button id="submit_order" class="btn btn-primary" type="button">Đặt Hàng
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body col-sm-6">
                            <form>
                                @csrf
                                <div class="form-group">
                                    <label for="">Chọn Tỉnh Thành Phố</label>
                                    <select class="form-control choose  city" name="city" id="city">
                                        <option value="">---Chọn Tỉnh Thành Phố---</option>
                                        @foreach ($cities as $key => $city)
                                            <option value="{{ $city->matp }}">{{ $city->name_city }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Chọn Quận Huyện</label>
                                    <select class="form-control choose  province" name="province" id="province">
                                        <option value="">---Chọn Quận Huyện---</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Chọn Xã Phường Thị Trấn</label>
                                    <select class="form-control wards" name="wards" id="wards">
                                        <option value="">---Chọn Xã Phường---</option>
                                    </select>
                                </div>
                                <button type="button" id="caculate_order"
                                    class="btn btn-gradient-primary me-2 caculate_delivery">Tính Vận
                                    Chuyển</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="review-payment">
                <h2>Xem Lại Giỏ Hàng</h2>
            </div>
            <div class="table-responsive cart_info">
                <table class=" col-sm-6 table table-condensed">
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
                    @if (Session::get('cart') != null)
                        <tr>
                            <td>
                                <form action="{{ URL::to('/check-cart-coupon') }}" method="GET">
                                    <input type="text" name="coupon_name_code" placeholder="Nhập vào mã giảm giá">
                                    <button style="margin-top:-3px; margin-left:-2px  " class="btn btn-default check_out">
                                        Xác
                                        Nhận</button>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td> <button id="delete-all-cart-ajax" class="btn btn-default check_out"><i
                                        class="fa fa-times"></i>
                                    Xóa Tất Cả</button>
                            </td>
                            @if (Session::get('coupon') != null)
                                <td>
                                    <a href="{{ URL::to('unset-cart-coupon') }}">
                                        <button id="delete-all-cart-ajax" class="btn btn-default check_out"><i
                                                class="fa fa-times"></i>
                                            Xóa Mã Giảm Giá</button>
                                    </a>
                                </td>
                            @endif
                            @if (Session::get('fee') != null)
                                <td>
                                    <a href="{{ URL::to('unset-cart-fee') }}">
                                        <button id="delete-all-cart-ajax" class="btn btn-default check_out"><i
                                                class="fa fa-times"></i>
                                            Đặt Lại Nơi Vận Chuyển</button>
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

                    $('.choose').change(function() {
                        var action = $(this).attr('id'); /* Lấy Thuộc Tính Của ID */
                        var ma_id = $(this).val();
                        var _token = $('input[name="_token"]').val();
                        var result = '';

                        if (action == 'city') {
                            result = 'province';
                        } else {
                            result = 'wards';
                        }
                        $.ajax({
                            url: '{{ url('/select-dilivery') }}',
                            method: 'POST',
                            data: {
                                action: action,
                                ma_id: ma_id,
                                _token: _token,

                            },
                            success: function(data) {
                                $('#' + result).html(data);
                            },
                            error: function() {
                                alert("Nhân Ơi Fix Bug Huhu :<");
                            },
                        });
                    });


                    $('.caculate_delivery').click(function() {
                        var id_city = $('.city').val();
                        var id_province = $('.province').val();
                        var id_wards = $('.wards').val();
                        var _token = $('input[name="_token"]').val();

                        if (id_city == '' || id_province == '' || id_wards == '') {
                            alert("Làm Ơn Chọn Để Tính Phí Vận Chuyển !");
                        } else {

                            $.ajax({
                                url: '{{ url('/caculator-fee') }}',
                                method: 'POST',
                                data: {
                                    id_city: id_city,
                                    id_province: id_province,
                                    id_wards: id_wards,
                                    _token: _token,

                                },
                                success: function(data) {
                                    location.reload();
                                },
                                error: function() {
                                    alert("Nhân Ơi Fix Bug Huhu :<");
                                },
                            });

                        }
                    });











                    $('#submit_order').click(function() {

                        swal({
                                title: "Xác Nhận Đơn Hàng?",
                                text: "Bạn Có Chắc Chắn Muốn Đặt Hàng!",
                                type: "warning",
                                showCancelButton: true,
                                confirmButtonClass: "btn-success",
                                confirmButtonText: "Vâng, Đặt Hàng!",
                                cancelButtonText: "Không!",
                                closeOnConfirm: false,
                                closeOnCancel: false,
                            },
                            function(isConfirm) {
                                if (isConfirm) {

                                    var shipping_name = $('.shipping_name').val();
                                    var shipping_email = $('.shipping_email').val();
                                    var shipping_phone = $('.shipping_phone').val();
                                    var shipping_address = $('.shipping_address').val();
                                    var order_fee = $('.order_fee').val();
                                    var order_coupon = $('.order_coupon').val();
                                    var shipping_notes = $('.shipping_notes').val();
                                    var payment_select = $('.payment_select').val();
                                    var _token = $('input[name="_token"]').val();

                                    $.ajax({
                                        url: '{{ url('/confirm-order') }}',
                                        method: 'POST',
                                        data: {
                                            shipping_name: shipping_name,
                                            shipping_email: shipping_email,
                                            shipping_phone: shipping_phone,
                                            shipping_address: shipping_address,
                                            order_fee: order_fee,
                                            order_coupon: order_coupon,
                                            shipping_notes: shipping_notes,
                                            payment_select: payment_select,

                                            _token: _token
                                        },
                                        success: function(data) {
                                            swal("Đã Đặt Hàng!", "Cảm Ơn Quý Khách Đã Đặt Hàng.", "success");
                                        },
                                        error: function() {
                                            alert("Nhân Ơi Fix Bug Huhu :<");
                                        },
                                    });

                                    window.setTimeout(function() {
                                        location.reload();
                                    }, 2500);

                                } else {
                                    swal("Đơn Hàng Chưa Được Gửi !", "Làm Ơn Hoàn Tất Đơn Hàng !", "error");
                                }
                            });



                    });
                </script>
            </div>
        </div>
        </div>
    </section>
    <!--/#cart_items-->
    <section style="margin-left: 465px" id="do_action">
        <div class="container">
            <div class="col-sm-6">
                @if (Session::get('cart') != null)
                    <div class="total_area">
                        <?php
                        $fee = session()->get('fee');
                        $coupon = Session::get('coupon');
                        if ($coupon != null) {
                            if ($coupon['coupon_condition'] == 1) {
                                $coupon_price_sale = $coupon['coupon_price_sale'];
                                $reduce_price = ($total / 100) * $coupon_price_sale;
                            }
                            if ($coupon['coupon_condition'] == 2) {
                                $coupon_price_sale = $coupon['coupon_price_sale'];
                                $reduce_price = $coupon_price_sale;
                            }
                            $money = $total - $reduce_price;
                        } else {
                            $money = $total;
                        }
                        
                        if ($fee != null) {
                            $money = $money + $fee;
                        }
                        
                        ?>
                        <ul>
                            <li>Tổng Giỏ Hàng <span> {{ number_format($total, 0, ',', '.') }} </span></li>
                            <li>Thuế <span> </span></li>
                            @if ($coupon != null)
                                <li>Mã Giảm Giá <span> {{ $coupon['coupon_name_code'] }}</span></li>
                                <li>Giảm <span> {{ number_format($reduce_price, 0, ',', '.') }}</span></li>
                            @endif
                            <?php
                            if (session()->get('fee') != null) {
                                echo ' <li>Phí Vận Chuyển <span>';
                                echo number_format($fee, 0, ',', '.');
                                echo '  </span></li>';
                            }
                            ?>
                            <li>Thành Tiền <span>{{ number_format($money, 0, ',', '.') }} </span></li>
                        </ul>
                        {{-- <a class="btn btn-default update" href="">Update</a> --}}
                    </div>
                @endif
            </div>
        </div>
        </div>
    </section>
@endsection
