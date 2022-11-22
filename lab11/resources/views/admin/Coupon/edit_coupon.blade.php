@extends('admin_layout')
@section('content')

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-certificate"></i>
        </span> Quản Lý Mã Giảm Giá
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <i class="mdi mdi-timetable"></i>
                <span><?php
                $today = date('d/m/Y');
                echo $today;
                ?></span>
            </li>
        </ul>
    </nav>
</div>
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 style="margin-top: -15px" class="card-title">Thêm Mã Giảm Giá</h4>
            <form class="forms-sample" action="{{ ('update-coupon') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="coupon_id" value="{{ $coupon_old->coupon_id }}">
                <div class="form-group">
                    <label for="exampleInputName1">Tên Mã Giảm Giá</label>
                    <input type="text" name="coupon_name" value="{{ $coupon_old->coupon_name }}" class="form-control" id="" placeholder="Nhập Tên Mã Giảm Giá">
                </div>
                
                <div class="form-group">
                    <label for="exampleInputName1">Mã Giảm Giá</label>
                    <input type="text" name="coupon_name_code" value="{{ $coupon_old->coupon_name_code }} "class="form-control" id="" placeholder="Nhập Mã Giảm Giá">
                </div>

                <div class="form-group">
                    <label for="exampleInputName1">Số Lượng Mã</label>
                    <input type="text" name="coupon_qty_code" value="{{ $coupon_old->coupon_qty_code }}" class="form-control" id="" placeholder="Nhập Số Lượng Mã">
                </div>
               
                <div class="form-group">
                    <label for="">Tính Năng Của Mã</label>
                    <select class="form-control" name="coupon_condition">
                       @if($coupon_old->coupon_condition == 1 )
                       <option active value="1">Giảm Giá Theo %</option>
                       <option value="2">Giảm Giá Theo Số Tiền</option>
                       @endif
                       @if($coupon_old->coupon_condition == 2 )
                       <option active value="2">Giảm Giá Theo Số Tiền</option>
                       <option  value="1">Giảm Giá Theo %</option>
                       @endif
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputName1">Số Tiền Hoặc Số % Giảm Giá</label>
                    <input type="text"  name="coupon_price_sale"  value="{{ $coupon_old->coupon_price_sale }} " class="form-control" id="" placeholder="Nhập Số Tiền Hoặc Số % Giảm Giá">
                </div>
                <button type="submit" class="btn btn-gradient-primary me-2">Cập Nhật</button>
                <button class="btn btn-light">Cancel</button>
            </form>
        </div>
    </div>
</div>
@endsection
