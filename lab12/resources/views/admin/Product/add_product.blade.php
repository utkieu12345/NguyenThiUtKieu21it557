@extends('admin_layout')
@section('add_product')
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
                <h4 style="margin-top: -15px" class="card-title">Thêm Sản Phẩm</h4>
                <form class="forms-sample" action="{{ 'save-product' }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="exampleInputName1">Tên Sản Phẩm</label>
                        <input type="text" name="product_name" class="form-control" id="exampleInputName1"
                            placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label for="">Danh Mục Sản Phẩm</label>
                        <select class="form-control m-bot15" name="product_category">
                            @foreach ($dataCategory as $key => $dataCategory)
                                <option value="{{ $dataCategory->category_id }}">{{ $dataCategory->category_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Danh Mục Thương Hiệu</label>
                       
                        <select class="form-control m-bot15" name="product_brand">
                            @foreach ($dataBrand as $key => $dataBrand)
                                <option value="{{ $dataBrand->brand_id }}">{{ $dataBrand->brand_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleTextarea1">Mô Tả Sản Phẫm</label>
                        <textarea rows="8" class="form-control" name="product_desc" id="editor"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="exampleTextarea1">Nội Dung Sản Phẩm</label>
                        <textarea class="form-control" name="product_content" id="editor1" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Giá Sản Phẩm</label>
                        <input type="number" class="form-control" name="product_price" id="" placeholder="Giá">
                    </div>
                    <div class="form-group">
                        <label>File upload</label>
                        <input id="product_image" type="file" name="product_image" class="file-upload-default">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                            <span class="input-group-append">
                                <label for="product_image" class="file-upload-browse btn btn-gradient-primary"
                                    type="button">Upload</label>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Hiễn thị</label>
                        <select class="form-control" name="product_status">
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
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#editor1'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
