<?php
if (isset($_GET['thamso'])) {
    $tham_so = $_GET['thamso'];
} else {
    $tham_so = "";
}
switch ($tham_so) {
    case "xuat_san_pham":
        include("chuc_nang/san_pham/xuat.php");
        break;
    case "chi_tiet_san_pham":
        include("chuc_nang/san_pham/chi_tiet_san_pham.php");
        break;
    case "quick_view":
        include("chuc_nang/san_pham/quick_view.php");
        break;
    case "xuat_san_pham_2":
        include("chuc_nang/san_pham/xuat_toan_bo_san_pham.php");
        break;
    case "xuat_mot_tin":
        include("chuc_nang/xuat_mot_tin.php");
        break;
    case "tim_kiem":
        include("chuc_nang/tim_kiem/xuat_san_pham_tim_kiem.php");
        break;
    case "gio_hang":
        include("chuc_nang/gio_hang/gio_hang.php");
        break;
    case "dang_nhap":
        include("chuc_nang/dang_nhap/login.php");
        break;
    case "do":
        include("chuc_nang/dang_nhap/xu_ly_login.php");
        break;
    case "thoat":
        include("chuc_nang/dang_nhap/thoat.php");
        break;
    case "dang_ky":
        include("chuc_nang/dang_nhap/register.php");
        break;
    case "xldangky":
        include("chuc_nang/dang_nhap/xu_ly_register.php");
        break;
    case "suathongtin_dn":
        include("chuc_nang/dang_nhap/suathongtin_dn.php");
        break;
    case "sua_user":
        include("chuc_nang/dang_nhap/xu_ly_suathongtin.php");
        break;
    default:
        include("chuc_nang/slideshow/slideshow.php");
        include("chuc_nang/san_pham/moi.php");
        include("chuc_nang/san_pham/noi_bat.php");
        include("chuc_nang/san_pham/san_pham_trang_chu.php");
}
