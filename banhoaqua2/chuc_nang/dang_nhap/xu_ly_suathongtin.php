<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Untitled Document</title>
</head>

<body>
	<?php

	$user_id = intval($_SESSION['user_id']);
	$sql_query = @mysqli_query($connect, "SELECT * FROM members WHERE id='{$user_id}'");
	$member = @mysqli_fetch_array($sql_query);
	//----Noi dung thong bao sau khi sua
	$thanhcong = 'Sửa thành công <a href="index.php">Quay lại</a>';
	$kothanh = 'Sửa ko thành công';
	echo "<b>Đang Sửa tài khoản {$member['username']}</b>.<br>";
	$ten = addslashes($_POST['name']);
	$pass = md5(addslashes($_POST['pass']));
	$sn = addslashes($_POST['sn']);
	$url = addslashes($_POST['url']);
	$email = addslashes($_POST['email']);
	$dt = addslashes($_POST['dt']);
	$sql = "UPDATE members SET	email = '$email',URLS = '$url',	Name = '$ten',Birthday = '$sn',dienthoai='$dt' WHERE id = '$user_id'";
	if ($sua = mysqli_query($connect, $sql))
		echo $thanhcong;
	else
		echo $kothanh;

	if ($_POST['pass'] != "") {
		$sqlx = "UPDATE members SET password = '$pass' WHERE id = '$user_id' LIMIT 1";
		$suapass = mysqli_query($connect, $sqlx);
		if ($suapass)
			echo "(Đã đổi pass) ";
		else
			echo "(Chưa đổi pass) ";
	}

	?>
</body>

</html>