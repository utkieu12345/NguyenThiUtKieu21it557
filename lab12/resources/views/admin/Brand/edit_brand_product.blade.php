@extends('admin_layout')
@section('edit_brand_product')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-certificate"></i>
        </span> Quản Lý Thương Hiệu
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
            <h4 style="margin-top: -15px" class="card-title">Cập Nhật Thương Hiệu</h4>
            <form class="forms-sample" action="{{ ('update-brand-product') }}" method="get" enctype="multipart/form-data">
                @foreach ($dataOld as $key => $editvalue)
                {{ csrf_field() }}
                <input type="hidden" class="form-control" id="" name="brand_product_id" placeholder="ID_hidden" value="{{$editvalue->brand_id}}">
                <div class="form-group">
                    <label for="exampleInputName1">Tên Thương Hiệu</label>
                    <input type="text" name="brand_product_name" class="form-control" id="exampleInputName1" placeholder="Name" value="{{ $editvalue->brand_name }}">
                </div>
                
                <div class="form-group">
                    <label for="exampleTextarea1">Mô Tả Thương Hiệu</label>
                    <textarea class="form-control" name="brand_product_desc" id="exampleTextarea1" rows="4">{{ $editvalue->brand_desc }}</textarea>
                </div>
                @endforeach
                <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                <button class="btn btn-light">Cancel</button>
            </form>
        </div>
    </div>
</div>
@endsection
