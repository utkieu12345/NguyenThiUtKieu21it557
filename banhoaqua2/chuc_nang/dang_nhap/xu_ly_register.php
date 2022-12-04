<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
// Tải file mysql.php lên
require_once("ket_noi.php");
//Kiem tra email co hop le hay ko

	// Dùng hàm addslashes() để tránh SQL injection, dùng hàm md5() để mã hóa password
	$username = addslashes( $_POST['username'] );
	$password = md5( addslashes( $_POST['password'] ) );
	$verify_password = md5( addslashes( $_POST['verify_password'] ) );
	$email = addslashes( $_POST['email'] );
	$ten = addslashes( $_POST['name'] );
	$sinhnhat = addslashes( $_POST['sn'] );
	$url = addslashes( $_POST['url'] );
	$dienthoai = addslashes( $_POST['dt'] );
	// Kiểm tra 7 thông tin, nếu có bất kỳ thông tin chưa điền thì sẽ báo lỗi
	if ( ! $username || ! $_POST['password'] || ! $_POST['verify_password'] || ! $email || ! $ten || ! $sinhnhat || ! $ten || !$dienthoai )
	{
		print "Xin vui lòng nhập đầy đủ các thông tin. <a href='javascript:history.go(-1)'>Nhấp vào đây để quay trở lại</a>";
		exit;
	}
	// Kiểm tra username nay co nguoi dung chua
	if ( mysqli_num_rows(mysqli_query($connect,"SELECT username FROM members WHERE username='$username'"))>0)
	{
		print "Username này đã có người dùng, Bạn vui lòng chọn username khác. <a href='javascript:history.go(-1)'>Nhấp vào đây để quay trở lại</a>";
		exit;
	}
	// Kiểm tra email nay co hop le ko
	function check_email($email) {
	if (strlen($email) == 0) return false;
	if (preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/', $email)) return true;
	return false;
	}
	if (!check_email($email))
	{
		print "Email này ko hợp lệ. <a href='javascript:history.go(-1)'>Nhấp vào đây để quay trở lại</a>";
		exit;
	}
	if (!preg_match('/^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/',$sinhnhat))
	{
		print "Ngày tháng năm sinh ko hợp lệ. <a href='javascript:history.go(-1)'>Nhấp vào đây để quay trở lại</a>";
		exit;
	}
	// Kiểm tra email nay co nguoi dung chua
	if ( mysqli_num_rows(mysqli_query($connect,"SELECT email FROM members WHERE email='$email'"))>0)
	{
		print "Email này đã có người dùng, Bạn vui lòng chọn Email khác. <a href='javascript:history.go(-1)'>Nhấp vào đây để quay trở lại</a>";
		exit;
	}
	// Kiểm tra mật khẩu, bắt buộc mật khẩu nhập lúc đầu và mật khẩu lúc sau phải trùng nhau
	if ( $password != $verify_password )
	{
		print "Mật khẩu không giống nhau, bạn hãy nhập lại mật khẩu. <a href='javascript:history.go(-1)'>Nhấp vào đây để quay trở lại</a>";
		exit;
	}
	// Tiến hành tạo tài khoản
	@$a=mysqli_query($connect,"INSERT INTO members (username, password, email,URLS,Name,Birthday,dienthoai) VALUES ('{$username}', '{$password}', '{$email}', '{$url}', '{$ten}', '{$sinhnhat}', '{$dienthoai}')");
	// Thông báo hoàn tất việc tạo tài khoản
	if ($a)
		print "Tài khoản {$username} đã được tạo. <a href='?thamso=dang_nhap'>Nhấp vào đây để đăng nhập</a>";
	else
		print "Có lỗi trong quá trình đăng kí, Vui lòng liên hệ BQT";

?>
</body>
</html>