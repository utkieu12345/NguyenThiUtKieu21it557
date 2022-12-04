<?php
$_SESSION['trang_chi_tiet_gio_hangx'] = "co";
// get: lấy tham số trên khung url
$id = $_GET['id'];
//lay du lieu khi $id lấy từ trang chi tiết sản phẩm
$tv = "select * from san_pham where id='$id'";
$tv_1 = mysqli_query($connect, $tv);
$tv_2 = mysqli_fetch_array($tv_1);

$link_anh = "hinh_anh/san_pham/" . $tv_2['hinh_anh'];
$gia = $tv_2['gia'];
$gia = number_format($gia, 0, ",", ".");
?>
<!-- Product Thumbnail Start -->
<div class="main-product-thumbnail ptb-100 ptb-sm-60">
	<div class="container">
		<div class="thumb-bg">
			<div class="row">
				<!-- Main Thumbnail Image Start -->
				<div class="col-lg-5 mb-all-40">
					<!-- Thumbnail Large Image start -->
					<div class="tab-content">

						<div id="thumb5" class="tab-pane fade">
							<a data-fancybox="images" href=""><img src="<?= $link_anh ?>" alt="product-view"></a>
						</div>
					</div>
					<!-- Thumbnail Large Image End -->
					<!-- Thumbnail Image End -->
					<div class="product-thumbnail mt-15">
						<div class="thumb-menu owl-carousel nav tabs-area" role="tablist">
							<a data-toggle="tab" href="#thumb5"><img src="<?= $link_anh ?>" alt="product-thumbnail"></a>
						</div>
					</div>
					<!-- Thumbnail image end -->
				</div>
				<!-- Main Thumbnail Image End -->
				<!-- Thumbnail Description Start -->
				<div class="col-lg-7">
					<div class="thubnail-desc fix">
						<h3 class="product-header"><?= $tv_2['ten'] ?></h3>
						<div class="rating-summary fix mtb-10">
							//sao đánh giá
							<div class="rating">
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star-o"></i>
								<i class="fa fa-star-o"></i>
								<i class="fa fa-star-o"></i>
							</div>
							<div class="rating-feedback">
								<a href="#">(1 review)</a>
								<a href="#">add to your review</a>
							</div>
						</div>
						<div class="pro-price mtb-30">
							<p class="d-flex align-items-center"><span class="price"><?= $gia ?> VNĐ</span></p>
						</div>
						<p class="mb-20 pro-desc-details"><?= $tv_2['noi_dung'] ?></p>

						<div class="box-quantity d-flex hot-product2">
							<form action="">
								<input type='hidden' name='thamso' value='gio_hang'>
								<input type='hidden' name='id' value='<?= $id ?>'>
								<input class="quantity mr-15" type="number" min="0" name='so_luong' value="1">
								<button type="submit" class="btn btn-primary">Thêm Vào Giỏ</button>
							</form>
						</div>

						<div class="socila-sharing mt-25">
							<ul class="d-flex">
								<li>share</li>
								<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus-official" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
				<!-- Thumbnail Description End -->
			</div>
			<!-- Row End -->
		</div>
	</div>
	<!-- Container End -->
</div>
<!-- Product Thumbnail End -->
<!-- Product Thumbnail Description Start -->
<div class="thumnail-desc pb-100 pb-sm-60">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<ul class="main-thumb-desc nav tabs-area" role="tablist">
					<li><a class="active" data-toggle="tab" href="#dtail">Product Details</a></li>
					<li><a data-toggle="tab" href="#review">Reviews 1</a></li>
				</ul>
				<!-- Product Thumbnail Tab Content Start -->
				<div class="tab-content thumb-content border-default">
					<div id="dtail" class="tab-pane fade show active">
						<p>Fashion has been creating well-designed collections since 2010. The brand offers feminine designs delivering stylish separates and statement dresses which have since evolved into a full ready-to-wear collection in which every item is a vital part of a woman's wardrobe. The result? Cool, easy, chic looks with youthful elegance and unmistakable signature style. All the beautiful pieces are made in Italy and manufactured with the greatest attention. Now Fashion extends to a range of accessories including shoes, hats, belts and more!</p>
					</div>
					<div id="review" class="tab-pane fade">
						<!-- Reviews Start -->
						<div class="review border-default universal-padding">
							<div class="group-title">
								<h2>customer review</h2>
							</div>
							<h4 class="review-mini-title">Truemart</h4>
							<ul class="review-list">
								<!-- Single Review List Start -->
								<li>
									<span>Quality</span>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o"></i>
									<i class="fa fa-star-o"></i>
									<label>Truemart</label>
								</li>
								<!-- Single Review List End -->
								<!-- Single Review List Start -->
								<li>
									<span>price</span>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o"></i>
									<i class="fa fa-star-o"></i>
									<i class="fa fa-star-o"></i>
									<label>Review by <a href="https://themeforest.net/user/hastech">Truemart</a></label>
								</li>
								<!-- Single Review List End -->
								<!-- Single Review List Start -->
								<li>
									<span>value</span>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o"></i>
									<label>Posted on 7/20/18</label>
								</li>
								<!-- Single Review List End -->
							</ul>
						</div>
						<!-- Reviews End -->
						<!-- Reviews Start -->
						<div class="review border-default universal-padding mt-30">
							<h2 class="review-title mb-30">You're reviewing: <br><span>Faded Short Sleeves T-shirt</span></h2>
							<p class="review-mini-title">your rating</p>
							<ul class="review-list">
								<!-- Single Review List Start -->
								<li>
									<span>Quality</span>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o"></i>
									<i class="fa fa-star-o"></i>
								</li>
								<!-- Single Review List End -->
								<!-- Single Review List Start -->
								<li>
									<span>price</span>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o"></i>
									<i class="fa fa-star-o"></i>
									<i class="fa fa-star-o"></i>
								</li>
								<!-- Single Review List End -->
								<!-- Single Review List Start -->
								<li>
									<span>value</span>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o"></i>
								</li>
								<!-- Single Review List End -->
							</ul>
							<!-- Reviews Field Start -->
							<div class="riview-field mt-40">
								<form autocomplete="off" action="#">
									<div class="form-group">
										<label class="req" for="sure-name">Nickname</label>
										<input type="text" class="form-control" id="sure-name" required="required">
									</div>
									<div class="form-group">
										<label class="req" for="subject">Summary</label>
										<input type="text" class="form-control" id="subject" required="required">
									</div>
									<div class="form-group">
										<label class="req" for="comments">Review</label>
										<textarea class="form-control" rows="5" id="comments" required="required"></textarea>
									</div>
									<button type="submit" class="customer-btn">Submit Review</button>
								</form>
							</div>
							<!-- Reviews Field Start -->
						</div>
						<!-- Reviews End -->
					</div>
				</div>
				<!-- Product Thumbnail Tab Content End -->
			</div>
		</div>
		<!-- Row End -->
	</div>
	<!-- Container End -->
</div>
<!-- Product Thumbnail Description End -->