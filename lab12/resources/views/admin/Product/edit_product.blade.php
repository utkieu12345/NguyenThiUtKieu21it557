@extends('admin_layout')
@section('edit_product')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-crosshairs-gps"></i>
            </span> Quản Lý Sản Phẩm
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
                <h4 style="margin-top: -15px" class="card-title">Cập Nhật Sản Phẩm</h4>
                <form class="forms-sample" action="{{ 'update-product' }}" method="post" enctype="multipart/form-data">
                    @foreach ($dataOld as $key => $editvalue)
                        {{ csrf_field() }}
                        <input type="hidden" class="form-control" id="" name="product_id" placeholder="ID ẩn"
                            value="{{ $editvalue->product_id }}">
                        <div class="form-group">
                            <label for="">Tên Sản Phẩm</label>
                            <input type="text" class="form-control" id="" name="product_name"
                                placeholder="Điền vào tên danh mục" value="{{ $editvalue->product_name }}">
                        </div>
                        <div class="form-group">
                            <label for="">Danh Mục Sản Phẩm</label>
                            <select class="form-control" name="product_category">
                                @foreach ($dataCategory as $key => $dataCategory)
                                    @if ($dataCategory->category_id == $editvalue->category_id)
                                        <option selected value="{{ $dataCategory->category_id }}">
                                            {{ $dataCategory->category_name }}</option>
                                    @else
                                        <option value="{{ $dataCategory->category_id }}">
                                            {{ $dataCategory->category_name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Danh Mục Thương Hiệu</label>
                            <select class="form-control" name="product_brand">
                                @foreach ($dataBrand as $key => $dataBrand)
                                    @if ($dataBrand->brand_id == $editvalue->brand_id)
                                        <option selected value="{{ $dataBrand->brand_id }}">{{ $dataBrand->brand_name }}
                                        </option>
                                    @else
                                        <option value="{{ $dataBrand->brand_id }}">{{ $dataBrand->brand_name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleTextarea1">Mô Tả Sản Phẫm</label>
                            <textarea class="form-control" name="product_desc" id="exampleTextarea1" rows="4">{{ $editvalue->product_desc }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleTextarea1">Nội Dung Sản Phẩm</label>
                            <textarea class="form-control" name="product_content" id="exampleTextarea1" rows="4"> {{ $editvalue->product_content }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Giá Sản Phẩm</label>
                            <input type="number" class="form-control" name="product_price" id="" placeholder="Giá"
                                value="{{ $editvalue->product_price }}">
                        </div>
                        <div class="form-group">
                            <label>Ảnh Đại Diện</label>
                            <div>
                                <img style="object-fit: cover; margin: 30px 0px 30px 0px" width="120px" height="120px"
                                    src="/shopbanhanglaravel/public/uploads/product/{{ $editvalue->product_image }}"
                                    alt="">
                            </div>
                            <input id="product_images" type="file" name="product_image" class="file-upload-default">
                            <div class="input-group col-xs-12">
                              <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                              <span class="input-group-append">
                                <label for="product_images" class="file-upload-browse btn btn-gradient-primary" type="button">Upload</label>
                              </span>
                            </div>
                        </div>
                        {{-- <div class="form-group">
                            <label for="">Hiễn thị</label>
                            <select class="form-control" name="product_status">
                                @if ($editvalue->product_status == 0)
                                    <option selected value="0">Ẩn</option>
                                    <option value="1">Hiện</option>
                                @else
                                    <option selected value="1">Hiện</option>
                                    <option value="0">Ẩn</option>
                                @endif
                            </select>
                        </div> --}}
                    @endforeach
                    <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>
@endsection
