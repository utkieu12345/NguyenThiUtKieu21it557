<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Untitled Document</title>
</head>

<body>
	<?php
	//session_start();
	echo '<title>dang nhap </title>';
	// Tải file mysql.php lên
	require_once("ket_noi.php");
	//include_once("ket_noi.php");	
	// Dùng hàm addslashes() để tránh SQL injection, dùng hàm md5() để mã hóa password
	$username = addslashes($_POST['username']);
	$password = md5(addslashes($_POST['password']));
	// Lấy thông tin của username đã nhập trong table members
	$sql_query = @mysqli_query($connect, "SELECT id, username, password FROM members WHERE username='{$username}'");
	$member = @mysqli_fetch_array($sql_query);
	// Nếu username này không tồn tại thì....
	if (@mysqli_num_rows($sql_query) <= 0) {
		print "Tên truy nhập không tồn tại. <a href='javascript:history.go(-1)'>Nhấp vào đây để quay trở lại</a>";

		exit;
	}
	// Nếu username này tồn tại thì tiếp tục kiểm tra mật khẩu
	if ($password != $member['password']) {
		print "Nhập sai mật khẩu. <a href='javascript:history.go(-1)'>Nhấp vào đây để quay trở lại</a>";
		exit;
	}
	// Khởi động phiên làm việc (session)
	$_SESSION['user_id'] = $member['id'];
	$_SESSION['user_adminx'] = $member['admin'];
	// Thông báo đăng nhập thành công
	print "Chào : {$member['username']} thành công. <a href='index.php'> Nhấp vào đây để vào trang chủ</a>";
	header('location: index.php');
	?>
</body>

</html>