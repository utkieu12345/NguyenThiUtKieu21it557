<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- SEO -->
    {{-- <meta name="description" content="{{ $meta_desc }}">
    <meta name="keywords" content="{{ $meta_keywords }}">
    <meta name="robots" content="INDEX,FOLLOW">
    <link rel="canonical" href="{{ $url_canonical }}">
    <meta name="author" content=""> 
    <link rel="icon" type="image/x-icon" href="https://www.thol.com.vn/pub/media/favicon/stores/5/favicon.png" />
    <link rel="shortcut icon" type="image/x-icon"
        href="https://www.thol.com.vn/pub/media/favicon/stores/5/favicon.png" /> --}}
    <!-- END SEO -->

    <!-- Facebook Meta Tags -->
    {{-- <meta property="og:url" content="{{ $url_canonical }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="http://localhost/shopbanhanglaravel">
    <meta property="og:title" content="{{ $meta_title }}">
    <meta property="og:description" content="{{ $meta_desc }}">
    <meta property="og:image" content="{{ "Link Ảnh" }}"> --}}

    <!-- Twitter Meta Tags -->
    {{-- <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site_name" content="http://localhost/shopbanhanglaravel">
    <meta name="twitter:title" content="Test website">
    <meta name="twitter:description" content="This is the website description. Nice eh?">
    <meta name="twitter:image" content="https://lorempixel.com/400/200/"> --}}

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    {{-- <title>{{ $meta_title }}</title> --}}
    <title>Web</title>
    <link href="{{ asset('public/fontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/fontend/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/fontend/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('public/fontend/css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('public/fontend/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('public/fontend/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('public/fontend/css/responsive.css') }}" rel="stylesheet">
   
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->

    <link rel="shortcut icon" href="{{ 'public/fontend/images/favicon.ico' }}">

    <link rel="apple-touch-icon-precomposed" sizes="144x144"
        href="{{ 'public/fontend/images/apple-touch-icon-144-precomposed.png' }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
        href="{{ 'public/fontend/images/apple-touch-icon-144-precomposed.png' }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
        href="{{ 'public/fontend/images/apple-touch-icon-72-precomposed.png' }}">
    <link rel="apple-touch-icon-precomposed" href="{{ 'public/fontend/images/apple-touch-icon-57-precomposed.png' }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link href="{{ asset('public/sweetalert/sweetalert.css') }}" rel="stylesheet">
    <script src="{{ asset('public/sweetalert/sweetalert.js') }}"></script>
    
</head>
<!--/head-->

<body>
    <header id="header">
        <!--header-->
        <div class="header_top">
            <!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">

                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/header_top-->

        <div class="header-middle">
            <!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">

                            <a href="{{ URL::to('/') }}"><img src="{{ 'public/fontend/images/logo.png' }}"
                                    alt="" /></a>
                        </div>
                        
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">

                                <li><a href="#"><i class="fa fa-star"></i> Yêu Thích</a></li>
                                <?php
                                    $customer_id = Session::get('customer_id');
                                    if($customer_id == NULL){

                                ?>
                                <li><a href="{{ URL::to('/login-checkout') }}"><i class="fa fa-user"></i> Tài
                                        Khoản</a>
                                </li>
                                <li><a href="{{ URL::to('/login-checkout') }}"><i class="fa fa-lock"></i> Đăng
                                        Nhập</a>
                                </li>
                                <?php
                                 }
                                    else {
                                        ?>

                                <li><a href="{{ URL::to('/show-cart-ajax') }}"><i class="fa fa-shopping-cart"></i> Giỏ
                                        Hàng</a></li>
                                <li><a href="#"><i class="fa fa-user"></i>
                                        {{ Session::get('customer_name') }}</a></li>
                                <li><a href="{{ URL::to('/logout-checkout') }}"><i class="fa fa-lock"></i> Đăng
                                        Xuất</a></li>
                                <?php
                                    }
                                    ?>

                                <?php
                                    $customer_id = Session::get('customer_id');
                                    $shipping_id = Session::get('shipping_id');
                                    if(($customer_id) == NULL ){

                                ?>
                                <li><a href="{{ URL::to('/login-checkout') }}"><i class="fa fa-crosshairs"></i> Thanh
                                        Toán</a></li>
                                <?php
                                 }
                                    else if(($shipping_id) == NULL) {
                                        ?>
                                <li><a href="{{ URL::to('/check-out') }}"><i class="fa fa-crosshairs"></i> Thanh
                                        Toán</a></li>
                                <?php
                                    } else if(($shipping_id) != NULL && ($shipping_id) != NULL )
                                    {
                                    ?>
                                <li><a href="{{ URL::to('/pay-ment') }}"><i class="fa fa-crosshairs"></i> Thanh
                                        Toán</a></li>
                                <?php
                                    }
                                    ?>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/header-middle-->

        <div class="header-bottom">
            <!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{ URL::to('/trang-chu') }}" class="active">Trang Chủ</a></li>
                                <li class="dropdown"><a href="#">Sản Phẫm<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="shop.html">Products</a></li>

                                    </ul>
                                </li>
                                <li class="dropdown"><a href="#">Tin Tức<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="blog.html">Blog List</a></li>
                                    </ul>
                                </li>
                                <li><a href="">Giỏ Hàng</a></li>
                                <li><a href="">Liên Hệ</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <form action="{{ URL::to('/search-product') }}" method="GET">
                            {{ csrf_field() }}
                            <div style="display: flex" class="search_box pull-right">
                                <input class="form-control" name="search_product" type="text"
                                    placeholder="Search" />
                                <input type="submit" class="btn btn-info"value="Tìm">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/header-bottom-->
    </header>
    <!--/header-->

    <section id="slider">
        <!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#slider-carousel" data-slide-to="1"></li>
                            <li data-target="#slider-carousel" data-slide-to="2"></li>
                        </ol>

                        <div class="carousel-inner">
                            @php
                            $i = 0;
                           @endphp
                            @foreach ($slider as $slide)
                               @if ($i == 0)
                               <div class="item active">
                                <div class="col-sm-6">

                                </div>
                                <div class="col-sm-6">
                                    <img width="100%" style="object-fit: cover"
                                        src="/shopbanhanglaravel/public/uploads/slider/{{ $slide->slider_image }}"
                                        class="girl img-responsive" alt="" />
                                    {{-- <img src="/shopbanhanglaravel/public/uploads/slider/{{ $slide->slider_image }}" class="pricing"
                                    alt="" /> --}}
                                </div>
                                @php
                                $i++;
                               @endphp
                            
                            </div>
                               @else   
                              
                               <div class="item">
                                <div class="col-sm-6">

                                </div>
                                <div class="col-sm-6">
                                    <img width="100%" height="100%" style="object-fit: cover"
                                        src="/shopbanhanglaravel/public/uploads/slider/{{ $slide->slider_image }}"
                                        class="girl img-responsive" alt="" />
                                    {{-- <img src="/shopbanhanglaravel/public/uploads/slider/{{ $slide->slider_image }}" class="pricing"
                                    alt="" /> --}}
                                </div>
                            </div>
                               @endif
                            @endforeach

                        </div>

                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--/slider-->

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Danh Mục Sản Phẩm</h2>
                        <div class="panel-group category-products" id="accordian">
                            <!--category-productsr-->
                            @foreach ($category as $key => $category)
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"><a
                                                href="{{ URL::to('danh-muc-san-pham?categoty_id=' . $category->category_id) }}">{{ $category->category_name }}</a>
                                        </h4>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <!--/category-products-->

                        <div class="brands_products">
                            <!--brands_products-->
                            <h2>Thương Hiện Sản Phẩm</h2>
                            <div class="brands-name">
                                @foreach ($brand as $key => $brand)
                                    <ul class="nav nav-pills nav-stacked">
                                        <li><a
                                                href="{{ URL::to('danh-muc-thuong-hieu?brand_id=' . $brand->brand_id) }}">
                                                {{ $brand->brand_name }}</a></li>
                                    </ul>
                                @endforeach
                            </div>
                        </div>
                        <!--/brands_products-->
                        {{-- <div class="price-range">
                            <!--price-range-->
                            <h2>Price Range</h2>
                            <div class="well text-center">
                                <input type="text" class="span2" value="" data-slider-min="0"
                                    data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]"
                                    id="sl2"><br />
                                <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
                            </div>
                        </div>
                        <!--/price-range-->

                        <div class="shipping text-center">
                            <!--shipping-->
                            <img src="images/home/shipping.jpg" alt="" />
                        </div>
                        <!--/shipping--> --}}

                    </div>
                </div>

                <div class="col-sm-9 padding-right">
                    {{-- nội dung trong home.blade.php đặt trong section content và được triệu gọi ở đây --}}
                    @yield('content')
                    @yield('content_category')
                    @yield('content_brand')
                    @yield('content_detailsproduct')


                </div>
            </div>
        </div>
    </section>

    <footer id="footer">
        <!--Footer-->
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="companyinfo">
                            <h2><span>e</span>-shopper</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">

                                        <img src="{{ 'public/fontend/images/iframe1.png' }}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{ 'public/fontend/images/iframe2.png' }}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{ 'public/fontend/images/iframe3.png' }}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{ 'public/fontend/images/iframe4.png' }}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="address">

                            <img src="{{ 'public/fontend/images/map.png' }}" alt="" />
                            <p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-widget">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Service</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Online Help</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Order Status</a></li>
                                <li><a href="#">Change Location</a></li>
                                <li><a href="#">FAQ’s</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Quock Shop</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">T-Shirt</a></li>
                                <li><a href="#">Mens</a></li>
                                <li><a href="#">Womens</a></li>
                                <li><a href="#">Gift Cards</a></li>
                                <li><a href="#">Shoes</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Policies</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Terms of Use</a></li>
                                <li><a href="#">Privecy Policy</a></li>
                                <li><a href="#">Refund Policy</a></li>
                                <li><a href="#">Billing System</a></li>
                                <li><a href="#">Ticket System</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>About Shopper</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Company Information</a></li>
                                <li><a href="#">Careers</a></li>
                                <li><a href="#">Store Location</a></li>
                                <li><a href="#">Affillate Program</a></li>
                                <li><a href="#">Copyright</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3 col-sm-offset-1">
                        <div class="single-widget">
                            <h2>About Shopper</h2>
                            <form action="#" class="searchform">
                                <input type="text" placeholder="Your email address" />
                                <button type="submit" class="btn btn-default"><i
                                        class="fa fa-arrow-circle-o-right"></i></button>
                                <p>Get the most recent updates from <br />our site and be updated your self...</p>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
                </div>
            </div>
        </div>

    </footer>
    <!--/Footer-->



    <script src="{{ asset('public/fontend/js/jquery.js') }}"></script>
    <script src="{{ asset('public/fontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/fontend/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('public/fontend/js/price-range.js') }}"></script>
    <script src="{{ asset('public/fontend/js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('public/fontend/js/main.js') }}"></script>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v14.0"
        nonce="ACx8AN0b"></script>
   
 
  
</body>

</html>
