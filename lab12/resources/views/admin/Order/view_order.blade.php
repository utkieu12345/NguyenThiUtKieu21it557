@extends('admin_layout')
@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-clipboard-outline"></i>
            </span> Quản Lý Đơn Hàng
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="mdi mdi-clipboard-outline"></i>
                    <span><?php
                    $today = date('d/m/Y');
                    echo $today;
                    ?></span>
                </li>
            </ul>
        </nav>
    </div>


    <?php
    $mesage = Session::get('mesage');
    if ($mesage) {
        echo $mesage;
        Session::put('mesage', null);
    }
    ?>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div style="display: flex;justify-content: space-between">
                    <div class="card-title col-sm-9">Thông Tin Khách Hàng Đăng Nhập</div>
                    <div class="col-sm-3">
                    </div>
                </div>
                <table style="margin-top:20px " class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#ID Khách Hàng</th>
                            <th>Tên Khách Hàng</th>
                            <th>Số Điện Thoại</th>
                        </tr>
                    </thead>
                    <tbody>
                        <td>{{ $customer->customer_id }}</td>
                        <td>{{ $customer->customer_name }}</td>
                        <td>{{ $customer->customer_sdt }}</td>
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div style="display: flex;justify-content: space-between">
                    <div class="card-title col-sm-9">Thông Tin Người Đặt Hàng</div>
                    <div class="col-sm-3">
                    </div>
                </div>
                <table style="margin-top:20px " class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Tên Người Đặt Hàng</th>
                            <th>Số Điện Thoại</th>
                            <th>Địa Chỉ</th>
                            <th>Ghi Chú</th>
                        </tr>
                    </thead>
                    <tbody>
                        <td>{{ $shipping->shipping_name }}</td>
                        <td>{{ $shipping->shipping_phone }}</td>
                        <td>{{ $shipping->shipping_address }}</td>
                        <td>{{ $shipping->shipping_notes }}</td>
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div style="display: flex;justify-content: space-between">
                    <div class="card-title col-sm-9">Chi Tiết Đơn Hàng</div>
                    <div class="col-sm-3">
                        {{-- <form action="{{ URL::to('/all-product-sreachbyname') }}" method="get">
                        <div class="input-group">
                            <input  type="text" class="form-control" name="searchbyname" placeholder="Search">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-gradient-primary me-2">Tìm kiếm</button>
                            </span>
                        </div>
                    </form> --}}
                    </div>
                </div>
                <table style="margin-top:20px " class="table table-bordered">
                    <thead>
                        <tr>
                            @php
                                $i = 1;
                            @endphp
                            <th>STT</th>
                            <th>Tên Sản Phẩm</th>
                            <th>Số Lượng</th>
                            <th>Giá</th>
                            <th>Tổng Tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalall = 0;
                        @endphp
                        @foreach ($orderdetails as $key => $orderdetails)
                            <tr>

                                <td>{{ $i++ }}</td>
                                <td>{{ $orderdetails->product_name }} </td>
                                <td>{{ $orderdetails->product_sales_quantity }}</td>
                                <td>{{ number_format($orderdetails->product_price, 0, ',', '.') . ' VND' }}</td>
                                <td>{{ number_format($orderdetails->product_sales_quantity * $orderdetails->product_price, 0, ',', '.') . ' VND' }}
                                </td>
                            </tr>

                            @php
                                $fee_ship = $orderdetails->product_fee;
                                $totalall = $totalall + $orderdetails->product_sales_quantity * $orderdetails->product_price;
                            @endphp
                        @endforeach

                    </tbody>
                </table>
                <div style="margin-top:20px ">
                    <div>

                        <span>Phí Ship : {{ number_format($fee_ship, 0, ',', '.') . ' VND' }}</span>
                    </div>
                    <div>
                        <div>
                            @if ($coupon == null)
                                <span>Mã Giảm Giá : Không Có !</span>
                            @else
                                <span>Mã Giảm Giá : {{ $coupon->coupon_name_code }} </span>
                            @endif
                        </div>
                        @if ($coupon != null)
                            <div>
                                @if ($coupon->coupon_condition == 1)
                                    <?php
                                    $coupon_sale = ($totalall / 100) * $coupon->coupon_price_sale;
                                    ?>
                                    <span>Số Tiền Giảm : {{ number_format($coupon_sale, 0, ',', '.') . ' VND' }}</span>
                                @endif

                                @if ($coupon->coupon_condition == 2)
                                    <?php
                                    $coupon_sale = $totalall - $coupon->coupon_price_sale;
                                    ?>
                                    <span>Số Tiền Giảm : {{ number_format($coupon_sale, 0, ',', '.') . ' VND' }}</span>
                                @endif
                            </div>
                        @endif

                        @if ($coupon == null)
                            <div>
                                <?php
                                $coupon_sale = 0;
                                ?>
                            </div>
                        @endif
                    </div>
                    @if ($coupon != null)
                        <div>
                            <span>Tổng Tiền Chưa Giảm :
                            </span>{{ number_format($totalall + $fee_ship, 0, ',', '.') . ' VND' }}
                        </div>
                        <div>
                            <span>Tổng Tiền Đã Giảm :
                            </span>{{ number_format($totalall - $coupon_sale + $fee_ship, 0, ',', '.') . ' VND' }}
                        </div>
                    @else
                        <div>
                            <span>Tổng Tiền :
                            </span>{{ number_format($totalall - $coupon_sale + $fee_ship, 0, ',', '.') . ' VND' }}
                        </div>
                    @endif

                </div>

            </div>
        </div>
    </div>
    <div>
        <div class="template-demo">
            <a target="_blank" style="text-decoration: none" href="{{ URL::to('/print-order?checkout_code='.$orderdetails->order_code) }}">
                <button type="button" class="btn btn-gradient-info btn-icon-text"> Xuất Hóa Đơn PDF <i
                        class="mdi mdi-printer btn-icon-append"></i>
                </button>
            </a>
            <a style="text-decoration: none" href="{{ URL::to('/print-order') }}">
                <button type="button" class="btn btn-gradient-danger btn-icon-text">
                    <i class="mdi mdi-upload btn-icon-prepend"></i> Upload </button>
            </a>
            <a style="text-decoration: none" href="{{ URL::to('/print-order') }}">
                <button type="button" class="btn btn-gradient-warning btn-icon-text">
                    <i class="mdi mdi-reload btn-icon-prepend"></i> Reset </button>
            </a>

           
        </div>
    </div>
@endsection
