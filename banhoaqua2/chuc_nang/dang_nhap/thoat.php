<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Untitled Document</title>
</head>

<body>
	<?php
	session_start();
	echo '<title>Huong Dan tao trang dang ki/Dang Nhap</title>';
	if (session_destroy()) {
		echo "Thoát thành công!";
		header('location: index.php');
	} else
		echo "KO thể thoát dc, có lỗi trong việc hủy session";

	echo '<br><a href="index.php">Bấm vào đây để quay lại trang chủ<br></a>';

	?>
</body>

</html>