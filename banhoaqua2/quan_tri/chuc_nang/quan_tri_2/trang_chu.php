<?php 
	if(!isset($bien_bao_mat)){exit();}
?>
<style type="text/css" >
	a.lk_1{font-size:22px;text-decoration:none;color:blue;margin-right:30px}
	a.lk_1:hover {color:red}
</style>
<br>
<center>
<a href="index.php" style="font-size:72px;color:blue;text-decoration:none" >Quản trị cửa hàng</a>
</center>
<br><br>
<table width="990px" >
	<tr>
		<td width="800px">
			<a href="index.php" class="lk_1" >Trang chủ</a>
			<a href="?thamso=menu_doc" class="lk_1" >Danh mục</a>
			<a href="?thamso=san_pham" class="lk_1" >Sản phẩm</a>
			<a href="?thamso=hoa_don" class="lk_1" >Hóa đơn</a>
		</td>
		<td align="right">
			<!-- dùng thoát có tham số = thoat ,sẽ đăng xuất luôn và muốn vào lại trang quản trị sẽ đăng nhập lại -->
			<a href="../index.php?thamso=thoat" class="lk_1">đăng xuất</a>

			<!-- thoát này thì quay lại trang index shop -->
			<!-- <a href="../index.php?" class="lk_1">Thoát</a> -->
		</td>
	</tr>
</table>
<br><br>
<?php 
	include("chuc_nang/quan_tri_2/dieu_huong.php");
?>
<br><br>
<table width="990px" >
	<tr>
		<td width="445px" align="right">
			Cửa hàng :
		</td>
		<td width="445px" >
			Shop Fruit
		</td>
	</tr>
	<tr>
		<td align="right" >
			Quản trị viên :
		</td>
		<td>
			Nguyễn Thị Út Kiều
		</td>
	</tr>
	<tr>
		<td align="right" >
			Điện thoại :
		</td>
		<td>
			0364736809
		</td>
	</tr>
</table>