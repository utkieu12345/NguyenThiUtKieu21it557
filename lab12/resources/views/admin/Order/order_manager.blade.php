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
                    <div class="card-title col-sm-9">Bảng Danh Sách Đơn Hàng</div>
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
                            <th>STT</th>
                            <th> #ID Đơn Hàng </th>
                            <th>Trạng Thái</th>
                            <th>Ngày Tạo Đơn</th>
                            <th> Thao Tác </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                          $i = 1;  
                        @endphp
                        @foreach ($order as $key => $value_order)
                            <tr>
                                <td>{{ $i++ }} </td>
                                <td>{{ $value_order->order_code }} </td>
                                <td>
                                    @if($value_order->order_status == 1)
                                        Đơn Hàng Mới 
                                    
                                    @else
                                        Đã Xữ Lý
                                    @endif
                                </td>
                                <td>{{ $value_order->created_at }}</td>
                                <td>
                                    <a href="{{ URL::to('/view-order?order_code=' . $value_order->order_code) }}">
                                        <i style="font-size: 20px" class="mdi mdi-eye"></i>
                                    </a>
                                    <a onclick="return confirm('Bạn muốn xóa danh mục này không?')"
                                        href="{{ URL::to('/delete-order?order_id=' . $value_order->order_code) }}"
                                        style="margin-left: 14px">
                                        <i style="font-size: 22px" class="mdi mdi-delete-sweep text-danger "></i>
                                    </a>
                                    {{-- @if ($sort == 1)
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
                                @endif --}}

                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection
