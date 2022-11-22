@extends('admin_layout')
@section('all_brand_product')
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
                    <div class="card-title col-sm-9">Bảng Danh Sách Thương Hiệu</div>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <input  type="text" class="form-control" placeholder="Search">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-gradient-primary me-2">Tìm kiếm</button>
                            </span>
                        </div>
                    </div>
                </div>
                <table style="margin-top:20px " class="table table-bordered">
                    <thead>
                        <tr>
                            <th> #ID </th>
                            <th> Tên Thương Hiệu </th>
                            <th> Mô Tả </th>
                            <th> Hiễn Thị </th>
                            <th> Ngày Thêm </th>
                            <th> Thao Tác </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($all_brand_product as $key => $cate_pro)
                            <tr>
                                <td>{{ $cate_pro->brand_id }}</td>
                                <td>{{ $cate_pro->brand_name }}</td>
                                <td>{{ $cate_pro->brand_desc }}</td>
                                <td>
                                    @if ($cate_pro->brand_status == 1)
                                        <a href="{{ URL::to('/unactive-brand-product?brand_id=' . $cate_pro->brand_id) }}">
                                            <i style="color: rgb(52, 211, 52); font-size: 30px"
                                            class="mdi mdi-toggle-switch"></i>
                                        </a>
                                    @else
                                        <a href="{{ URL::to('/active-brand-product?brand_id=' . $cate_pro->brand_id) }}">
                                            <i style="color: rgb(196, 203, 196);font-size: 30px"
                                            class="mdi mdi-toggle-switch-off"></i>
                                        </a>
                                    @endif
                                </td>
                                <td>{{ $cate_pro->created_at }}</td>

                                <td>
                                    <a href="{{ URL::to('/edit-brand-product?brand_id=' . $cate_pro->brand_id) }}">
                                        <i style="font-size: 20px" class="mdi mdi-lead-pencil"></i>
                                    </a>
                                    <a onclick="return confirm('Bạn muốn xóa danh mục này không?')"
                                        href="{{ URL::to('/delete-brand-product?brand_id=' . $cate_pro->brand_id) }}"
                                        style="margin-left: 14px">
                                        <i style="font-size: 22px" class="mdi mdi-delete-sweep text-danger "></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
