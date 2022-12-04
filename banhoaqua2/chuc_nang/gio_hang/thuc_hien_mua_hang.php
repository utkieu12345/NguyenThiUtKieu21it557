<?php

require_once("ket_noi.php");
if (isset($_SESSION['id_them_vao_giox'])) {
	if (isset($_SESSION['user_id'])) {
		$user_id = intval($_SESSION['user_id']);
		$tv = "SELECT * FROM members WHERE id= '$user_id'";
		$sql_query = mysqli_query($connect, $tv);

		$member = mysqli_fetch_array($sql_query);
		$ten_nguoi_mua =  $member['Name'];
		$dien_thoai = $member['dienthoai'];
		$dia_chi = $member['URLS'];
		$email = $member['email'];
		$noi_dung = "chưa duyệt";
	} else {
		$ten_nguoi_mua = trim($_POST['ten_nguoi_mua']);
		$email = trim($_POST['email']);
		$dien_thoai = trim($_POST['dien_thoai']);
		$dia_chi = trim(nl2br($_POST['dia_chi']));
		$noi_dung = "chưa duyệt";
	}

	if ($ten_nguoi_mua != "" and $dien_thoai != "" and $dia_chi != "") {
		$hang_duoc_mua = "";
		for ($i = 0; $i < count($_SESSION['id_them_vao_giox']); $i++) {
			$hang_duoc_mua = $hang_duoc_mua . $_SESSION['id_them_vao_giox'][$i] . "[|||]" . $_SESSION['sl_them_vao_giox'][$i] . "[|||||]";
		}
		$tv = "INSERT INTO hoa_don (
            id ,
            ten_nguoi_mua ,
            email ,
            dia_chi ,
            dien_thoai ,
            noi_dung ,
            hang_duoc_mua
            )
            VALUES (
            NULL ,
            '$ten_nguoi_mua',
            '$email',
            '$dia_chi',
            '$dien_thoai',
            '$noi_dung',
            '$hang_duoc_mua'
            );";
		mysqli_query($connect, $tv);
		unset($_SESSION['id_them_vao_giox']);
		unset($_SESSION['sl_them_vao_giox']);

		thong_bao_html_roi_chuyen_trang("Cảm ơn bạn đã mua hàng tại web site chúng tôi", "index.php");
	} else {
		thong_bao_html("Thao tác thực hiện bị sai");
		trang_truoc();
		exit();
	}
}
