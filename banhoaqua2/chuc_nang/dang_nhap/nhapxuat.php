<?php
require_once("ket_noi.php");
if (!isset($_SESSION['user_id'])) {
?>
	<ul>
		<li><a href="#">Tài Khoản<i class="lnr lnr-chevron-down"></i></a>
			<!-- Dropdown Start -->
			<ul class="ht-dropdown">
				<li><a href="?thamso=dang_nhap">Đăng nhập</a></li>
				<li><a href="?thamso=dang_ky">Đăng ký</a></li>
			</ul>
			<!-- Dropdown End -->
		</li>
	</ul>
	<?php } else {
	if (isset($_SESSION['user_id'])) {
		$user_id = intval($_SESSION['user_id']);
		$sql_query = @mysqli_query($connect, "SELECT * FROM members WHERE id='{$user_id}'");
		$member = @mysqli_fetch_array($sql_query);
		$usert = $member['username'];
	?>
		<ul>
			<li><a href="#">Tài Khoản<i class="lnr lnr-chevron-down"></i></a>
				<!-- Dropdown Start -->
				<ul class="ht-dropdown">
					<li>Xin chào <?= $member['username'] ?></li>
					<li><a href="?thamso=suathongtin_dn">Sửa thông tin</a></li>
					<?php
					if ($member['admin'] == "1") {
						$_SESSION['adminx'] = "1"; ?>
						<li><a href="quan_tri/index.php">Quản trị</a></li>
					<?php	}
					?>
					<li><a href="?thamso=thoat">Thoát</a></li>
				</ul>
				<!-- Dropdown End -->
			</li>
		</ul>
<?php	} else {
		$_SESSION['user_id'] = "undefine";
	}
}
?>