@extends('admin_layout')
@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-book-variant"></i>
            </span> Quản Lý Vận Chuyển
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
                <h4 style="margin-top: -15px" class="card-title">Thiết Lập Phí Vận Chuyển</h4>
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

                    <div class="form-group">
                        <label for=""> Phí Vận Chuyển</label>
                        <input type="text" class="form-control fee_ship" name="fee_ship">
                    </div>

                    <button type="button" id="summit_feeship" class="btn btn-gradient-primary me-2">Thêm Phí Vận
                        Chuyển</button>
                    <button class="btn btn-light">Trở Lại</button>
                </form>
            </div>
        </div>
    </div>
    <div id="load_delivery">

    </div>

    <script>
        
        $(document).ready(function() {
            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });
           fetch_delivery();

           $(document).on('blur','.fee_change',function(){
                var feeship_id = $(this).data('id_fee');
                var feeship_value = $(this).text();
                var _token = $('input[name="_token"]').val(); 

                $.ajax({
                    url: '{{url('/update-dilivery') }}',
                    method: 'POST',
                    data: {
                        feeship_id: feeship_id,
                        feeship_value: feeship_value,
                        _token:_token,
                    },
                    success: function(data) {
                        fetch_delivery();
                    },
                    error: function() {
                        alert("Nhân Ơi Fix Bug Huhu :<");
                    },
                });
           });
           function fetch_delivery() {
                var _token = $('input[name="_token"]').val(); 
                $.ajax({
                    url: '{{ url('/select-feeship') }}',
                    method: 'POST',
                    data: {
                        _token: _token,      
                    },
                    success: function(data) {
                        $('#load_delivery').html(data);
                       
                    },
                    error: function() {
                        alert("Nhân Ơi Fix Bug Huhu :<");
                    },
                });
            }

            $('#summit_feeship').click(function() {
                var city = $('.city').val();
                var province = $('.province').val();
                var wards = $('.wards').val();
                var fee_ship = $('.fee_ship').val();
                var _token = $('input[name="_token"]').val(); 

                $.ajax({
                    url: '{{ url('/insert-dilivery') }}',
                    method: 'POST',
                    data: {
                        city: city,
                        province: province,
                        wards: wards,
                        fee_ship: fee_ship,
                        _token: _token,
                      
                    },
                    success: function(data) {
                        alert("Thêm Phí Vận Chuyển Thành Công !");
                        fetch_delivery();
                    },
                    error: function() {
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
                        $('#'+result).html(data);
                    },
                    error: function() {
                        alert("Nhân Ơi Fix Bug Huhu :<");
                    },
                });
            });



           


        })
    </script>
@endsection
