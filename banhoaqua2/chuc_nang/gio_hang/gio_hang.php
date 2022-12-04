<?php

if (isset($_GET['id']) and $_SESSION['trang_chi_tiet_gio_hangx'] == "co") {
	$_SESSION['trang_chi_tiet_gio_hangx'] = "huy_bo";
	if (isset($_SESSION['id_them_vao_giox'])) {
		$so = count($_SESSION['id_them_vao_giox']);
		$trung_lap = "khong";
		for ($i = 0; $i < count($_SESSION['id_them_vao_giox']); $i++) {
			if ($_SESSION['id_them_vao_giox'][$i] == $_GET['id']) {
				$trung_lap = "co";
				$vi_tri_trung_lap = $i;
				break;
			}
		}
		if ($trung_lap == "khong") {
			$_SESSION['id_them_vao_giox'][$so] = $_GET['id'];
			$_SESSION['sl_them_vao_giox'][$so] = $_GET['so_luong'];
		}
		if ($trung_lap == "co") {
			$_SESSION['sl_them_vao_giox'][$vi_tri_trung_lap] = $_SESSION['sl_them_vao_giox'][$vi_tri_trung_lap] + $_GET['so_luong'];
		}
	} else {
		$_SESSION['id_them_vao_giox'][0] = $_GET['id'];
		$_SESSION['sl_them_vao_giox'][0] = $_GET['so_luong'];
	}
}

$gio_hang = "khong";
if (isset($_SESSION['id_them_vao_giox'])) {
	$so_luong = 0;
	for ($i = 0; $i < count($_SESSION['id_them_vao_giox']); $i++) {
		$so_luong = $so_luong + $_SESSION['sl_them_vao_giox'][$i];
	}
	if ($so_luong != 0) {
		$gio_hang = "co";
	}
}

?>


<!-- Cart Main Area Start -->
<div class="cart-main-area ptb-100 ptb-sm-60">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<!-- Form Start -->
				<?php
				if ($gio_hang == "khong") {
					echo "Không có sản phẩm trong giỏ hàng";
				} else {
				?>
					<form action="" method='post'>
						<input type='hidden' name='cap_nhat_gio_hang' value='co'>
						<!-- Table Content Start -->
						<div class="table-content table-responsive mb-45">
							<table>
								<thead>
									<tr>
										<th class="product-thumbnail">Hinh Ảnh</th>
										<th class="product-name">Tên</th>
										<th class="product-price">Giá</th>
										<th class="product-quantity">Số Lượng</th>
										<th class="product-subtotal">Tổng</th>
										<th class="product-remove">Xoá</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$tong_cong = 0;
									for ($i = 0; $i < count($_SESSION['id_them_vao_giox']); $i++) {

										$tv = "select id,ten,gia,hinh_anh from san_pham where id='" . $_SESSION['id_them_vao_giox'][$i] . "'";
										$tv_1 = mysqli_query($connect, $tv);
										$tv_2 = mysqli_fetch_array($tv_1);
										error_reporting(0);
										$link_anh = "hinh_anh/san_pham/" . $tv_2['hinh_anh'];
										$link_chi_tiet = "?thamso=chi_tiet_san_pham&id=" . $tv_2['id'];
										$tien = $tv_2['gia'] * $_SESSION['sl_them_vao_giox'][$i];
										$tong_cong = $tong_cong + $tien;
										$name_id = "id_" . $i;
										$name_sl = "sl_" . $i;
										$name_ch = "ch_" . $i;
										if ($_SESSION['sl_them_vao_giox'][$i] != 0) {
									?>
											<tr>
												<td class="product-thumbnail">
													<a href="<?= $link_chi_tiet ?>"><img src="<?= $link_anh ?>" alt="cart-image"></a>
												</td>
												<td class="product-name"><a href="<?= $link_chi_tiet ?>"><?= $tv_2['ten'] ?></a></td>
												<td class="product-price"><span class="amount"><?= $tv_2['gia'] ?> VNĐ</span></td>
												<td class="product-quantity">
													<input type='hidden' name="<?= $name_id ?>" value="<?= $_SESSION['id_them_vao_giox'][$i] ?>">
													<input name="<?= $name_sl ?>" type="number" value="<?= $_SESSION['sl_them_vao_giox'][$i] ?>">
												</td>
												<td class="product-subtotal"><?= $tien ?> VNĐ</td>
												<td class="product-remove"> <input type="checkbox" name="<?= $name_ch ?>" value="<?= $id ?>"></td>
											</tr>

									<?php
											if (isset($hang_duoc_mua1)) {
												$hang_duoc_mua1 = $hang_duoc_mua1 . $_SESSION['id_them_vao_giox'][$i] . "[|||]" . $_SESSION['sl_them_vao_giox'][$i] . "[|||||]";
											}
										}
									}
									?>
								</tbody>
							</table>
						</div>
						<!-- Table Content Start -->
						<div class="row">
							<!-- Cart Button Start -->
							<div class="col-md-8 col-sm-12">
								<div class="buttons-cart">
									<input type="submit" value="Cập Nhật">
									<a href="?thamso=xuat_san_pham_2">Mua thêm sản phẩm</a>
								</div>
							</div>
							<!-- Cart Button Start -->
							<!-- Cart Totals Start -->
							<div class="col-md-4 col-sm-12">
								<div class="cart_totals float-md-right text-md-right">
									<h2>Tổng Giá Trị Đơn Hàng</h2>
									<br>
									<table class="float-md-right">
										<tbody>
											<tr class="cart-subtotal">
												</td>
											</tr>
											<tr class="order-total">
												<td>
													<strong><span class="amount"><?= $tong_cong ?> VNĐ</span></strong>
												</td>
											</tr>
										</tbody>
									</table>
									<div class="wc-proceed-to-checkout">
										<a href="#">Hoá đơn chưa làm</a>
									</div>
								</div>
							</div>
							<!-- Cart Totals End -->
						</div>
						<!-- Row End -->
					</form>
				<?php
					if (isset($_SESSION['user_id'])) {
						echo "<form action='' method='post' >";
						echo "<input type='hidden' name='thong_tin_khach_hang' value='co' > ";
						echo "<br>";
						echo "<input type='submit' value='Gửi đơn hàng' >";
						echo "</form>";
					} else {
						echo "<br>";
						echo "<br>";
						echo "<br>";
						echo "<a href='?thamso=dang_ky'>Đăng ký để mua hàng và nhận ưu đãi</a>";
						echo "<br>";
						echo "Quý khách có thể Nhập nhanh thông tin mua hàng để chúng tôi liên hệ";
						include("chuc_nang/gio_hang/bieu_mau_mua_hang.php");
					}
				} ?>
				<!-- Form End -->
			</div>
		</div>
		<!-- Row End -->
	</div>
</div>
<!-- Cart Main Area End -->