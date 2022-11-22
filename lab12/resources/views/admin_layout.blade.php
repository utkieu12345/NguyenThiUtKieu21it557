<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title> Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href=" {{ asset('public/backend/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/backend/assets/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('public/backend/assets/css/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('public/backend/assets/images/favicon.ico') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>

    <style>
        @font-face {
            font-family: nhanf;
            src: url({{ asset('public/backend/assets/fonts/Mt-Regular.otf') }});
            font-display: swap;
        }

        .chongloihuhu {}
    </style>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="{{ URL::to('/dashboard') }}"><img
                        src="{{ asset('public/backend/assets/images/logo.svg') }}" alt="logo" /></a>
                <a class="navbar-brand brand-logo-mini" href="index.html"><img
                        src="{{ asset('public/backend/assets/images/logo-mini.svg') }}" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-stretch">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-menu"></span>
                </button>
                <div class="search-field d-none d-md-block">
                    <form class="d-flex align-items-center h-100" action="#">
                        <div class="input-group">
                            <div class="input-group-prepend bg-transparent">
                                <i class="input-group-text border-0 mdi mdi-magnify"></i>
                            </div>
                            <input type="text" class="form-control bg-transparent border-0"
                                placeholder="Search projects">
                        </div>
                    </form>
                </div>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" id="profileDropdown" href="#"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="nav-profile-img">
                                <img src="{{ asset('public/backend/assets/images/faces/face1.jpg') }}" alt="image">
                                <span class="availability-status online"></span>
                            </div>
                            <div class="nav-profile-text">
                                <p class="mb-1 text-black">
                                    <?php
                                    $admin_name = Session::get('admin_name');
                                    if ($admin_name) {
                                        echo $admin_name;
                                    }
                                    ?></p>
                            </div>
                        </a>
                        <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="#">
                                <i class="mdi mdi-cached me-2 text-success"></i> Activity Log </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ URL::to('/logout') }}">
                                <i class="mdi mdi-logout me-2 text-primary"></i> Signout </a>
                        </div>
                    </li>

                    <li class="nav-item d-none d-lg-block full-screen-link">
                        <a class="nav-link">
                            <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                        </a>
                    </li>

                    <li class="nav-item nav-logout d-none d-lg-block">
                        <a class="nav-link" href="#">
                            <i class="mdi mdi-power"></i>
                        </a>
                    </li>
                    <li class="nav-item nav-settings d-none d-lg-block">
                        <a class="nav-link" href="#">
                            <i class="mdi mdi-format-line-spacing"></i>
                        </a>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">

                    <li class="nav-item nav-profile">
                        <a href="#" class="nav-link">
                            <div class="nav-profile-image">
                                <img src="{{ asset('public/backend/assets/images/faces/face1.jpg') }}" alt="profile">
                                <span class="login-status online"></span>
                                <!--change to offline or busy as needed-->
                            </div>
                            <div class="nav-profile-text d-flex flex-column">
                                <span class="font-weight-bold mb-2"><?php
                                $admin_name = Session::get('admin_name');
                                if ($admin_name) {
                                    echo $admin_name;
                                }
                                ?>
                                </span>
                                <span class="text-secondary text-small">Quản Lý Dự Án</span>
                            </div>
                            <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="{{ URL::to('/dashboard') }}">
                            <span class="menu-title">Dashboard</span>
                            <i class="mdi mdi-home menu-icon"></i>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic-slider"
                            aria-expanded="false" aria-controls="ui-basic">
                            <span class="menu-title">Quản Lý Slider</span>
                            <i class="menu-arrow"></i>
                            <i class="mdi mdi-book-variant menu-icon"></i>
                        </a>
                        <div class="collapse" id="ui-basic-slider">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link"
                                        href="{{ URL::to('/all-slider') }}">Danh Sách Slider</a></li>
                                <li class="nav-item"> <a class="nav-link"
                                        href="{{ URL::to('/add-slider') }}">Thêm Slider</a></li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic-category"
                            aria-expanded="false" aria-controls="ui-basic">
                            <span class="menu-title">Quản Lý Thể Loại</span>
                            <i class="menu-arrow"></i>
                            <i class="mdi mdi-book-variant menu-icon"></i>
                        </a>
                        <div class="collapse" id="ui-basic-category">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link"
                                        href="{{ URL::to('/all-category-product') }}">Danh Sách Thể Loại</a></li>
                                <li class="nav-item"> <a class="nav-link"
                                        href="{{ URL::to('/add-category-product') }}">Thêm Thể Loại</a></li>
                            </ul>
                        </div>
                    </li>



                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic-brand" aria-expanded="false"
                            aria-controls="ui-basic">
                            <span class="menu-title">Quản Lý Thương Hiệu</span>
                            <i class="menu-arrow"></i>
                            <i class="mdi mdi-certificate menu-icon"></i>
                        </a>
                        <div class="collapse" id="ui-basic-brand">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link"
                                        href="{{ URL::to('/all-brand-product') }}">Danh
                                        Sách Thương Hiệu</a></li>
                                <li class="nav-item"> <a class="nav-link"
                                        href="{{ URL::to('/add-brand-product') }}">Thêm Thương Hiệu</a></li>
                            </ul>
                        </div>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic-product" aria-expanded="false"
                            aria-controls="ui-basic">
                            <span class="menu-title">Quản Lý Sản Phẩm</span>
                            <i class="menu-arrow"></i>
                            <i class="mdi mdi-crosshairs-gps menu-icon"></i>
                        </a>
                        <div class="collapse" id="ui-basic-product">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="{{ URL::to('/all-product') }}">Danh
                                        Sách Sản Phẩm</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{ URL::to('/add-product') }}">Thêm
                                        Sản Phẩm</a></li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">

                        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic-coupon" aria-expanded="false"
                            aria-controls="ui-basic">
                            <span class="menu-title">Quản Lý Sự Kiện Ưu Đãi</span>
                            <i class="menu-arrow"></i>
                            <i class="mdi mdi-crosshairs-gps menu-icon"></i>
                        </a>
                        <div class="collapse" id="ui-basic-coupon">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    Quản Lí Mã Giả Giá 
                                </li>
                                <li class="nav-item"> <a class="nav-link" href="{{ URL::to('/list-coupon') }}">Danh
                                        Sách Mã Giảm Giá</a>
                                </li>
                                <li class="nav-item"> <a class="nav-link" href="{{ URL::to('/add-coupon') }}">Thêm Mã Giảm
                                        Giá</a>
                                </li>
                            </ul>
                        </div>

                    </li>

                    <li class="nav-item" style="margin-top:-10px ">
                        <a class="nav-link" data-bs-toggle="collapse" href="#ui-order" aria-expanded="false"
                            aria-controls="ui-basic">
                            <span class="menu-title">Quản Lý Đơn Hàng</span>
                            <i class="menu-arrow"></i>
                            <i style="font-size: 20px" class="mdi mdi-clipboard-outline"></i>
                        </a>
                        <div class="collapse" id="ui-order">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link"
                                        href="{{ URL::to('/order-manager') }}">Danh
                                        Sách Đơn Hàng</a></li>
                                {{-- <li class="nav-item"> <a class="nav-link"
                                        href="{{ URL::to('/add-product') }}">Thêm Sản Phẩm</a></li> --}}
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item" style="margin-top:-10px ">
                        <a class="nav-link" data-bs-toggle="collapse" href="#ui-delivery" aria-expanded="false"
                            aria-controls="ui-basic">
                            <span class="menu-title">Quản Lý Vận Chuyển</span>
                            <i class="menu-arrow"></i>
                            <i style="font-size: 20px" class="mdi mdi-clipboard-outline"></i>
                        </a>
                        <div class="collapse" id="ui-delivery">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link"
                                        href="{{ URL::to('/show-delivery') }}">Thiết Lập Phí Vận Chuyển</a></li>
                                {{-- <li class="nav-item"> <a class="nav-link"
                                        href="{{ URL::to('/add-product') }}">Thêm Sản Phẩm</a></li> --}}
                            </ul>
                        </div>
                    </li>


                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                    @yield('admin_content')
                    @yield('add_category_product')
                    @yield('edit_category_product')
                    @yield('all_category_product')

                    @yield('add_brand_product')
                    @yield('edit_brand_product')
                    @yield('all_brand_product')

                    @yield('add_product')
                    @yield('edit_product')
                    @yield('all_product')
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="container-fluid d-flex justify-content-between">
                        <span class="text-muted d-block text-center text-sm-start d-sm-inline-block">Đồ Án Cơ Sở
                            2</span>
                        <span class="float-none float-sm-end mt-1 mt-sm-0 text-end"> Nhân - Học Laravel</span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>

    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('public/backend/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('public/backend/assets/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('public/backend/assets/js/jquery.cookie.js') }}" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('public/backend/assets/js/off-canvas.js') }}"></script>
    <script src=" {{ asset('public/backend/assets/js/hoverable-collapse.js') }}"></script>
    <script src=" {{ asset('public/backend/assets/js/misc.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="  {{ asset('public/backend/assets/js/dashboard.js') }}"></script>
    <script src=" {{ asset('public/backend/assets/js/todolist.js') }}"></script>
    <!-- End custom js for this page -->
    {{-- js voice --}}
    <script src=" {{ asset('public/backend/assets/js/voice.js') }}"></script>

</body>

</html>
