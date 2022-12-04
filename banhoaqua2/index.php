<?php
ob_start();
session_start();
include("ket_noi.php");
include("chuc_nang/ham/ham.php");
if (isset($_POST['thong_tin_khach_hang'])) {
	include("chuc_nang/gio_hang/thuc_hien_mua_hang.php");
}
if (isset($_POST['cap_nhat_gio_hang'])) {
	include("chuc_nang/gio_hang/cap_nhat_gio_hang.php");
	include("chuc_nang/gio_hang/xoa_san_pham_gio_hang.php");

	trang_truoc();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Shop hoa qua</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Fontawesome css -->
	<link rel="stylesheet" href="giao_dien\css\font-awesome.min.css">
	<!-- Ionicons css -->
	<link rel="stylesheet" href="giao_dien\css\ionicons.min.css">
	<!-- linearicons css -->
	<link rel="stylesheet" href="giao_dien\css\linearicons.css">
	<!-- Nice select css -->
	<link rel="stylesheet" href="giao_dien\css\nice-select.css">
	<!-- Jquery fancybox css -->
	<link rel="stylesheet" href="css\jquery.fancybox.css">
	<!-- Jquery ui price slider css -->
	<link rel="stylesheet" href="giao_dien\css\jquery-ui.min.css">
	<!-- Meanmenu css -->
	<link rel="stylesheet" href="giao_dien\css\meanmenu.min.css">
	<!-- Nivo slider css -->
	<link rel="stylesheet" href="css\nivo-slider.css">
	<!-- Owl carousel css -->
	<link rel="stylesheet" href="giao_dien\css\owl.carousel.min.css">
	<!-- Bootstrap css -->
	<link rel="stylesheet" href="giao_dien\css\bootstrap.min.css">
	<!-- Custom css -->
	<link rel="stylesheet" href="giao_dien\css\default.css">
	<!-- Main css -->
	<link rel="stylesheet" href="giao_dien\style1.css">
	<!-- Responsive css -->
	<link rel="stylesheet" href="giao_dien\css\responsive.css">

	<!-- Modernizer js -->
	<script src="giao_dien\js\vendor\modernizr-3.5.0.min.js"></script>
</head>

<body>


	<?php
	require_once("./Views/banner/banner.php")
	?>

	<?php
	require_once("./Views/header_footer/header.php");
	?>


	<?php
	require_once("./Views/dieu_huong.php")
	?>

	<?php
	require_once("./Views/header_footer/footer.php")
	?>


	<!-- jquery 3.2.1 -->
	<script src="giao_dien\js\vendor\jquery-3.2.1.min.js"></script>
	<!-- Countdown js -->
	<script src="giao_dien\js\jquery.countdown.min.js"></script>
	<!-- Mobile menu js -->
	<script src="giao_dien\js\jquery.meanmenu.min.js"></script>
	<!-- ScrollUp js -->
	<script src="giao_dien\js\jquery.scrollUp.js"></script>
	<!-- Nivo slider js -->
	<script src="giao_dien\js\jquery.nivo.slider.js"></script>
	<!-- Fancybox js -->
	<script src="giao_dien\js\jquery.fancybox.min.js"></script>
	<!-- Jquery nice select js -->
	<script src="giao_dien\js\jquery.nice-select.min.js"></script>
	<!-- Jquery ui price slider js -->
	<script src="giao_dien\js\jquery-ui.min.js"></script>
	<!-- Owl carousel -->
	<script src="giao_dien\js\owl.carousel.min.js"></script>
	<!-- Bootstrap popper js -->
	<script src="giao_dien\js\popper.min.js"></script>
	<!-- Bootstrap js -->
	<script src="giao_dien\js\bootstrap.min.js"></script>
	<!-- Plugin js -->
	<script src="giao_dien\js\plugins.js"></script>
	<!-- Main activaion js -->
	<script src="giao_dien\js\main.js"></script>
</body>

</html>