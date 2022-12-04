<!-- Arrivals Products Area Start Here -->
<?php
$tv = "select id,ten,gia,hinh_anh,thuoc_menu from san_pham where trang_chu='co' order by sap_xep_trang_chu desc limit 0,15";
$tv_1 = mysqli_query($connect, $tv);
?>
<div class="arrivals-product pb-85 pb-sm-45" style="margin-top: 50px;">
	<div class="container">
		<div class="main-product-tab-area" style="max-width: 100%;">
			<div class="tab-menu mb-25">
				<div class="section-ttitle">
					<h2>Sản Phẩm</h2>
				</div>
				<!-- Nav tabs -->
			</div>
			<div class="row">
				<?php
				while ($tv_2 = mysqli_fetch_array($tv_1)) {
					if ($tv_2 != false) {
						$link_anh = "hinh_anh/san_pham/" . $tv_2['hinh_anh'];
						$link_chi_tiet = "?thamso=chi_tiet_san_pham&id=" . $tv_2['id'];
						$quick_view = "?thamso=quick_view&id=" . $tv_2['id'];
						$gia = $tv_2['gia'];
						$gia = number_format($gia, 0, ",", "."); ?>

						<div class="col-lg-3 col-md-4 col-sm-6 col-6">
							<div class="single-product">
								<!-- Product Image Start -->
								<div class="pro-img">
									<a href="<?= $link_chi_tiet ?>">
										<img style="height:250px ;" class="primary-img" src="<?= $link_anh ?>" alt="single-product">
										<!-- <img class="secondary-img" src="img\products\2.jpg" alt="single-product"> -->
									</a>
									<a href="<?= $quick_view ?>" class="quick_view" data-toggle="modal" data-target="#myModal" title="Quick View"><i class="lnr lnr-magnifier"></i></a>
								</div>
								<!-- Product Image End -->
								<!-- Product Content Start -->
								<div class="pro-content">
									<div class="pro-info">
										<h4><a href="<?= $link_chi_tiet ?>"><?= $tv_2['ten'] ?></a></h4>
										<p><span class="price"><?= $gia ?> VNĐ</span></p>
									</div>
									<div class="pro-actions">
										<div class="actions-primary">
											<a href="<?= $link_chi_tiet ?>" title="Add to Cart">Mua Ngay</a>
										</div>
									</div>
								</div>
								<!-- Product Content End -->
							</div>
						</div>
						<!-- Single Product End -->

				<?php				}
				}
				?>
			</div>
		</div>
		<!-- main-product-tab-area-->
	</div>
	<!-- Container End -->
</div>
<!-- Arrivals Products Area End Here -->