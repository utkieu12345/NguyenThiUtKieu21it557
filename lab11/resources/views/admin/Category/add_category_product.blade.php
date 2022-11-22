@extends('admin_layout')
@section('add_category_product')

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-book-variant"></i>
        </span> Quản Lý Thể Loại
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
            <h4 style="margin-top: -15px" class="card-title">Thêm Thể Loại</h4>
            <form class="forms-sample" action="{{ ('save-category-product') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="exampleInputName1">Tên Thể Loại</label>
                    <input type="text" name="category_product_name" class="form-control" id="exampleInputName1" placeholder="Name">
                </div>
                
                <div class="form-group">
                    <label for="exampleTextarea1">Mô Tả Thể Loại</label>
                    <textarea class="form-control" name="category_product_desc" id="exampleTextarea1" rows="4"></textarea>
                </div>

                <div class="form-group">
                    <label for="exampleTextarea1">Từ Khóa Hiển Thị (SEO)</label>
                    <textarea class="form-control" name="meta_keywords" id="exampleTextarea1" rows="4"></textarea>
                </div>
               
                <div class="form-group">
                    <label for="">Hiễn thị</label>
                    <select class="form-control" name="category_product_status">
                        <option value="0">Ẩn</option>
                        <option value="1">Hiện</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                <button class="btn btn-light">Cancel</button>
            </form>
        </div>
    </div>
</div>
@endsection
