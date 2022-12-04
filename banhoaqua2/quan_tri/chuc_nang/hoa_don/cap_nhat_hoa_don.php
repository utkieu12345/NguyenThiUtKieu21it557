<?php 
	if(!isset($bien_bao_mat)){exit();}
?>
<?php 
	$id=$_GET['id'];
	$tv="update  hoa_don set noi_dung = 'Da duyet' WHERE id = $id ";
	mysqli_query($connect,$tv);
	
	$link_xem="?thamso=xem_hoa_don&id=".$id."&trang=".$_GET['trang'];
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Cập nhật hóa đơn</title>
	</head>
	<body>
		<script type="text/javascript" >
			window.location="<?php echo $link_xem; ?>";
		</script>
	</body>
</html>
<?php 
	exit();
?>