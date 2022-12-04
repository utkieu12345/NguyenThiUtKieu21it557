<?php 
	if(!isset($bien_bao_mat)){exit();}
?>
<?php 
session_start();
echo '<title>Huong Dan tao trang dang ki/Dang Nhap</title>';
if (session_destroy()) 
	{
	echo "Thoát thành công!";
	header('location: index.php');
	}
else
	echo "KO thể thoát dc, có lỗi trong việc hủy session";

echo '<br><a href="index.php">Bấm vào đây để quay lại trang chủ<br></a>';


//	unset($_SESSION['ky_danh']);
//	unset($_SESSION['mat_khau']);
?>
