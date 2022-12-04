<?php
$tv = "select id,ten,hinh_anh,gia from san_pham order by id desc limit 0,7";
$tv_1 = mysqli_query($connect, $tv);
$tv_2 = mysqli_fetch_array($tv_1);


?>


<!-- Hot Deal Products Start Here -->
<div class="hot-deal-products off-white-bg pb-90 pb-sm-50">
	<div class="container">
		<!-- Product Title Start -->
		<div class="post-title pb-30">
			<h2>Sản Phẩm Mới</h2>
		</div>
		<!-- Product Title End -->
		<!-- Hot Deal Product Activation Start -->
		<div class="hot-deal-active owl-carousel">
			<!-- Single Product Start -->
			<?php
			while ($tv_2 = mysqli_fetch_array($tv_1)) {
				$link_anh = "hinh_anh/san_pham/" . $tv_2['hinh_anh'];
				$link_chi_tiet = "?thamso=chi_tiet_san_pham&id=" . $tv_2['id'];
				$gia = $tv_2['gia'];
				$gia = number_format($gia, 0, ",", ".");
			?>
				<div class="single-product">

					<!-- Product Image Start -->
					<div class="pro-img">
						<a href="<?= $link_chi_tiet ?>">
							<img style="height:250px ;object-fit: cover;"class="primary-img" src="<?= $link_anh ?>" alt="single-product">
							<!-- <img class="secondary-img" src="img\products\43.jpg" alt="single-product"> -->
						</a>
						<div class="countdown" data-countdown="2022/11/25"></div>
						<a href="#" class="quick_view" data-toggle="modal" data-target="#myModal" title="Quick View"><i class="lnr lnr-magnifier"></i></a>
					</div>
					<!-- Product Image End -->
					<!-- Product Content Start -->
					<div class="pro-content">
						<div class="pro-info">
							<h4><a href="<?= $link_chi_tiet ?>"><?= $tv_2['ten'] ?></a></h4>
							<p><span class="price"><?= $gia ?> VNĐ</span></p>
							<div class="label-product l_sale">giảm 15<span class="symbol-percent">%</span></div>
						</div>
						<div class="pro-actions">
							<div class="actions-primary">
								<a href="<?= $link_chi_tiet ?>" title="Add to Cart">Mua Ngay</a>
							</div>
						</div>
					</div>
					<!-- Product Content End -->
					<span class="sticker-new">new</span>

				</div>
			<?php } ?>
			<!-- Single Product End -->
		</div>
		<!-- Hot Deal Product Active End -->

	</div>
	<!-- Container End -->
</div>
<!-- Hot Deal Products End Here -->