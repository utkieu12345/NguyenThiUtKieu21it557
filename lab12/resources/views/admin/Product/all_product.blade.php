@extends('admin_layout')
@section('all_product')
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
                    <div class="card-title col-sm-9">Bảng Danh Sách Sản Phẩm</div>
                    <div class="col-sm-3">
                        <form style="display: flex" action="{{ URL::to('/all-product-sreachbyname') }}" method="get"
                            id="search-form">
                            {{-- <div class="input-group">
                                <input name="searchbyname" type="text" placeholder="Search Google..." autocomplete="off" autofocus>
                                <input  type="text" class="form-control" name="searchbyname" placeholder="Search">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-gradient-primary me-2">Tìm kiếm</button>
                                </span>
                            </div> --}}
                            <input name="searchbyname" class="form-control" type="text" placeholder="Tìm Kiếm"
                                autocomplete="off" autofocus>
                        </form>
                    </div>
                </div>
                <table style="margin-top:20px " class="table table-bordered">
                    <thead>
                        <tr>
                            <th> #ID </th>
                            <th>Tên Sản Phẩm</th>
                            <th>Tên Thể Loại</th>
                            <th>Tên Thương Hiệu </th>
                            <th> Mô Tả </th>
                            <th> Nội Dung </th>
                            <th>Giá</th>
                            <th>Ảnh Đại Diện</th>
                            <th> Hiễn Thị </th>
                            <th> Thao Tác </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($all_product as $key => $products)
                            <tr>
                                <td>{{ $products->product_id }}</label>
                                </td>
                                <td>{{ $products->product_name }}</td>
                                <td>{{ $products->category_name }}</td>
                                <td>{{ $products->brand_name }}</td>
                                <td>{{ $products->product_desc }}</td>
                                <td>{{ $products->product_content }}</td>
                                <td>{{ number_format($products->product_price) }}</td>
                                <td><img style="object-fit: cover" width="40px" height="20px"
                                        src="/shopbanhanglaravel/public/uploads/product/{{ $products->product_image }}"
                                        alt=""></td>
                                <td>
                                    @if ($products->product_status == 1)
                                        <a href="{{ URL::to('/unactive-product?product_id=' . $products->product_id) }}">
                                            <i style="color: rgb(52, 211, 52); font-size: 30px"
                                                class="mdi mdi-toggle-switch"></i>
                                        </a>
                                    @else
                                        <a href="{{ URL::to('/active-product?product_id=' . $products->product_id) }}">
                                            <i style="color: rgb(196, 203, 196);font-size: 30px"
                                                class="mdi mdi-toggle-switch-off"></i>
                                        </a>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ URL::to('/edit-product?product_id=' . $products->product_id) }}">
                                        <i style="font-size: 20px" class="mdi mdi-lead-pencil"></i>
                                    </a>
                                    <a onclick="return confirm('Bạn muốn xóa danh mục này không?')"
                                        href="{{ URL::to('/delete-product?product_id=' . $products->product_id) }}"
                                        style="margin-left: 14px">
                                        <i style="font-size: 22px" class="mdi mdi-delete-sweep text-danger "></i>
                                    </a>
                                    @if ($sort == 1)
                                        <a style="margin-left: 14px;color: darkorange"
                                            href="{{ URL::to('/all-product-sort_az') }}">
                                            <i class="fa-solid fa-arrow-down-a-z"></i>
                                        </a>
                                    @endif
                                    @if ($sort == 0)
                                        <a style="margin-left: 14px;color: darkorange"
                                            href="{{ URL::to('/all-product-sort_za') }}">
                                            <i class="fa-solid fa-arrow-down-z-a"></i>
                                        </a>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
    <div>
        <div class="template-demo">
            <form action="{{ URL::to('import-csv') }}" method="POST" enctype="multipart/form-data">
                <input type="file" name="file" accept=".xlsx">
                <button type="button" class="btn btn-gradient-danger btn-icon-text">
                    <i class="mdi mdi-upload btn-icon-prepend"></i> Nhập File Excel </button>
            </form>

            <form action="{{ URL::to('export-csv') }}" method="POST" enctype="multipart/form-data">
                <input type="submit" value="Xuất File Excel" class="btn btn-gradient-warning btn-icon-text">
            </form>
        </div>
    </div>
@endsection
