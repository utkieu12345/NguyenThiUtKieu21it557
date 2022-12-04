<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Untitled Document</title>
</head>

<body>
	<?php
	echo '<title>Sua thong tin ca nhan </title>';
	echo '<a href="index.php">Bấm vào đây để quay lại<br></a>';
	require_once("ket_noi.php");
	if (!$_SESSION['user_id']) {
		echo "Bạn chưa đăng nhập! <a href='chuc_nang/dang_nhap/login.php'>Nhấp vào đây để đăng nhập</a> hoặc <a href='chuc_nang/dang_nhap/register.php'>Nhấp vào đây để đăng ký</a>";
	} else {
		$user_id = intval($_SESSION['user_id']);
		$sql_query = @mysqli_query($connect, "SELECT * FROM members WHERE id='{$user_id}'");
		$member = @mysqli_fetch_array($sql_query);
		//----Noi dung thong bao sau khi sua
		$thanhcong = 'Sửa thành công <a href="index.php">Quay lại</a>';
		$kothanh = 'Sửa ko thành công';
		echo "<b>Đang Sửa tài khoản {$member['username']}</b>.<br>";
		echo "
		<form method='POST' action='?thamso=sua_user'>
			<table border='1' width='100%' id='table1' cellspacing='0' cellpadding='0' style='border-collapse: collapse' bordercolor='#C0C0C0'>
				<tr>
					<td>Tên:</td>
					<td><input type='text' value='{$member['Name']}' name='name' size='20'></td>
				</tr>
				<tr>
					<td>Địa chỉ:</td>
					<td><input type='text' value='{$member['URLS']}' name='url' size='20'></td>
				</tr>
				<tr>
					<td>Sinh Nhật:</td>
					<td><input type='text' name='sn' value='{$member['Birthday']}' size='20'></td>
				</tr>
				<tr>
					<td>Email:</td>
					<td><input type='text' name='email' value='{$member['email']}' size='20'></td>
				</tr>
				<tr>
					<td>Số điện thoại:</td>
					<td><input type='text' name='dt' value='{$member['dienthoai']}' size='20'></td>
				</tr>
				<tr>
					<td>Pass:</td>
					<td><input type='password' name='pass' size='20'></td>
				</tr>
			</table>
			<p align='center'><input type='submit' value='Sửa'><input type='reset' value='Khôi phục' name='B2'></p>
		</form>
		";
	}
	?>
</body>

</html>