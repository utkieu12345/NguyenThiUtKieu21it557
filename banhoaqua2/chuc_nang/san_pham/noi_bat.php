<div class="hot-deal-products pt-100 pt-sm-60">
	<div class="container">
		<div class="all-border">
			<!-- Product Title Start -->
			<div class="section-ttitle mb-30">
				<h2>nổi bật</h2>
			</div>
			<!-- Product Title End -->
			<!-- Hot Deal Product Activation Start -->
			<div class="hot-deal-active3 owl-carousel">
				<?php
				$tv = "select id,ten,hinh_anh,gia,noi_dung from san_pham where noi_bat='co' order by id desc limit 0,3";
				$tv_1 = mysqli_query($connect, $tv);
				while ($tv_2 = mysqli_fetch_array($tv_1)) {
					$link_anh = "hinh_anh/san_pham/" . $tv_2['hinh_anh'];
					$link_chi_tiet = "?thamso=chi_tiet_san_pham&id=" . $tv_2['id'];
					$gia = $tv_2['gia'];
					$gia = number_format($gia, 0, ",", ".");
					$noi_dung = $tv_2['noi_dung'];
				?>
					<div class="row">
						<!-- Main Thumbnail Image Start -->
						<div class="col-lg-6 mb-all-40 hot-product2 ">
							<!-- Thumbnail Large Image start -->
							<div class="tab-content">
								<div id="thumb1" class="tab-pane fade show active">
									<a data-fancybox="images" href="<?= $link_chi_tiet ?>"><img src="<?= $link_anh ?>" alt="product-view"></a>
								</div>
								<!-- <div id="thumb2" class="tab-pane fade">
									<a data-fancybox="images" href="img\products\13.jpg"><img src="img\products\13.jpg" alt="product-view"></a>
								</div>
								<div id="thumb3" class="tab-pane fade">
									<a data-fancybox="images" href="img\products\15.jpg"><img src="img\products\15.jpg" alt="product-view"></a>
								</div> -->

							</div>
							<!-- Thumbnail Large Image End -->
							<!-- Thumbnail Image End -->
							<div class="product-thumbnail">
								<div class="pro-tab-menu nav tabs-area" role="tablist">
									<!-- <a class="active" data-toggle="tab" href="#thumb1"><img src="img\products\35.jpg" alt="product-thumbnail"></a>
									<a data-toggle="tab" href="#thumb2"><img src="img\products\13.jpg" alt="product-thumbnail"></a>
									<a data-toggle="tab" href="#thumb3"><img src="img\products\15.jpg" alt="product-thumbnail"></a> -->

								</div>
							</div>
							<!-- Thumbnail image end -->
						</div>
						<!-- Main Thumbnail Image End -->
						<!-- Thumbnail Description Start -->
						<div class="col-lg-6 hot-product2">
							<div class="thubnail-desc fix">
								<div class="countdown" data-countdown="2025/03/01"></div>
								<h3><a href="<?= $link_chi_tiet ?>"><?= $tv_2['ten'] ?></a></h3>
								<div class="rating-summary fix mtb-10">
								<!-- 5 ngoi sao -->
									<div class="rating">
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-o"></i>
									</div>
									<div class="rating-feedback">
										<!-- <a href="#">(1 review)</a>
								<a href="#">add to your review</a> -->
									</div>
								</div>
								<div class="pro-price mtb-30">
									<p><span class="price"><?= $gia ?> VNĐ</span></p>
								</div>
								<p class="mb-30 pro-desc-details"></p>
								<div class="pro-actions">
									<div class="actions-primary">
										<a href="<?= $link_chi_tiet ?>" title="Add to Cart">Mua Ngay</a>
									</div>
								</div>
							</div>
						</div>
						<!-- Thumbnail Description End -->
					</div>
				<?php } ?>
			</div>
			<!-- Hot Deal Product Active End -->
		</div>
	</div>
	<!-- Container End -->
</div>