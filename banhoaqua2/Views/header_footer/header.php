<?php

$tv = "select * from menu_doc order by id";
$tv_1 = mysqli_query($connect, $tv);
?>
<header>
    <!-- Header Top Start Here -->
    <div class="header-top-area">
        <div class="container">
            <!-- Header Top Start -->
            <div class="header-top">
                <ul>
                    <li><a href="#">Miễn Phí ship cho đơn hàng 150k</a></li>
                    <li><a href="checkout.html">Thanh toán</a></li>
                </ul>
                <!-- tài khoản -->
                <?php
                require_once("./chuc_nang/dang_nhap/nhapxuat.php")
                ?>

                <!-- tài khoản -->
            </div>
            <!-- Header Top End -->
        </div>
        <!-- Container End -->
    </div>
    <!-- Header Top End Here -->
    <!-- Header Middle Start Here -->
    <div class="header-middle ptb-15">
        <div class="container">
            <div class="row align-items-center no-gutters">
                <div class="col-lg-3 col-md-12">
                    <div class="logo mb-all-30">
                        <a href="index.php"><img src="hinh_anh/logo.png" alt="logo-image" style="height: 80px; width:250px"></a>
                    </div>
                </div>

                <!-- Categorie Search Box Start Here -->
                <?php
                require_once("./chuc_nang/tim_kiem/vung_tim_kiem.php")
                ?>

                <!-- Categorie Search Box End Here -->
                <!-- Cart Box Start Here -->
                <div class="col-lg-4 col-md-12">
                    <div class="cart-box mt-all-30">
                        <ul class="d-flex justify-content-lg-end justify-content-center align-items-center">
                            <li><a href="?thamso=gio_hang"><i class="lnr lnr-cart"></i><span class="my-cart"><span class="total-pro">❤</span><span>cart</span></span></a>
                            </li>
                            <li><a href="?thamso=dang_nhap"><i class="lnr lnr-user"></i><span class="my-cart"><span> <strong>Đăng Nhập</strong></span></span></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Cart Box End Here -->
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </div>
    <!-- categoty -->
    <div class="header-bottom  header-sticky">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-3 col-lg-4 col-md-6 vertical-menu d-none d-lg-block">
                    <span class="categorie-title">Danh mục</span>

                </div>
                <div class="col-xl-9 col-lg-8 col-md-12 ">
                    <nav class="d-none d-lg-block">
                        <ul class="header-bottom-list d-flex">
                            <li class="active"><a href="index.php">trang chủ</a>
                                <!-- Home Version Dropdown Start -->

                                <!-- Home Version Dropdown End -->
                            </li>
                            <li>
                                <a href="?thamso=xuat_san_pham_2">cửa hàng</a>
                                <!-- Home Version Dropdown Start -->

                                <!-- Home Version Dropdown End -->
                            </li>
                            </li>
                            <li><a href="#">giới thiệu</a></li>
                            <li><a href="#">liên hệ</a></li>

                        </ul>
                    </nav>
                    <div class="mobile-menu d-block d-lg-none">

                    </div>
                </div>
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </div>
    <!-- Mobile Vertical Menu Start Here -->
    <div class="container d-block d-lg-none">
        <div class="vertical-menu mt-30">
            <span class="categorie-title mobile-categorei-menu">Danh mục</span>
            <nav>
                <div id="cate-mobile-toggle" class="category-menu sidebar-menu sidbar-style mobile-categorei-menu-list menu-hidden ">
                    <?php
                    while ($tv_2 = mysqli_fetch_array($tv_1)) {
                        $link = "?thamso=xuat_san_pham&id=" . $tv_2['id'];
                    ?>
                        <ul>
                            <li><a href="<?= $link ?>"><?= $tv_2['ten'] ?></a> </li>
                        </ul>
                    <?php } ?>
                </div>
                <!-- category-menu-end -->
            </nav>
        </div>
    </div>

</header>

<div class="main-page-banner  off-white-bg home-3">
    <div class="container">
        <div class="row">
            <!-- Vertical Menu Start Here -->
            <div class="col-xl-3 col-lg-4 d-none d-lg-block">
                <div class="vertical-menu mb-all-30">
                    <nav>
                        <ul class="vertical-menu-list">
                            <?php
                            $tv = "select * from menu_doc order by id";
                            $tv_1 = mysqli_query($connect, $tv);
                            ?>
                            <?php
                            while ($tv_2 = mysqli_fetch_array($tv_1)) {
                                $link = "?thamso=xuat_san_pham&id=" . $tv_2['id'];
                            ?>
                                <li><a href="<?= $link ?>"><span></span><?= $tv_2['ten'] ?></a>
                                </li>
                            <?php } ?>
                            <!-- More Categoies End -->
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- Vertical Menu End Here -->
            <!-- Slider Area Start Here -->

            <!-- Slider Area End Here -->
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</div>