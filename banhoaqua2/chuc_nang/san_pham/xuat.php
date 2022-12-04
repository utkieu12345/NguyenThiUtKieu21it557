<?php
$id = $_GET['id'];

$so_du_lieu = 15;
$tv = "select count(*) from san_pham where thuoc_menu='$id';";
$tv_1 = mysqli_query($connect, $tv);
$tv_2 = mysqli_fetch_array($tv_1);
$so_trang = ceil($tv_2[0] / $so_du_lieu);

if (!isset($_GET['trang'])) {
	$vtbd = 0;
} else {
	$vtbd = ($_GET['trang'] - 1) * $so_du_lieu;
}

$tv = "select id,ten,gia,hinh_anh,thuoc_menu from san_pham where thuoc_menu='$id' order by id desc limit $vtbd,$so_du_lieu";
$tv_1 = mysqli_query($connect, $tv);


?>

<!-- Shop Page Start -->
<div class="main-shop-page pt-100 pb-100 ptb-sm-60">
	<div class="container">
		<!-- Row End -->
		<div class="row">
			<!-- Sidebar Shopping Option Start -->
			<div class="col-lg-3 order-2 order-lg-1">
				<div class="sidebar">

					<!-- Single Banner End -->
				</div>
			</div>
			<!-- Sidebar Shopping Option End -->
			<!-- Product Categorie List Start -->
			<div class="col-lg-9 order-1 order-lg-2">
				<!-- Grid & List View Start -->
				<div class="grid-list-top border-default universal-padding d-md-flex justify-content-md-between align-items-center mb-30">
					<div class="grid-list-view  mb-sm-15">
						<ul class="nav tabs-area d-flex align-items-center">
							<li><a class="active" data-toggle="tab" href="#grid-view"><i class="fa fa-th"></i></a></li>
							<!--<li><a data-toggle="tab" href="#list-view"><i class="fa fa-list-ul"></i></a></li> -->
						</ul>
					</div>
				</div>
				<!-- Grid & List View End -->
				<div class="main-categorie mb-all-40">
					<!-- Grid & List Main Area End -->
					<div class="tab-content fix">
						<div id="grid-view" class="tab-pane fade show active">
							<div class="row">
								<!-- Single Product Start -->
								<?php
								while ($tv_2 = mysqli_fetch_array($tv_1)) {
									for ($i = 1; $i <= 3; $i++) {
										if ($tv_2 != false) {
											$link_anh = "hinh_anh/san_pham/" . $tv_2['hinh_anh'];
											$link_chi_tiet = "?thamso=chi_tiet_san_pham&id=" . $tv_2['id'];
											$gia = $tv_2['gia'];
											$gia = number_format($gia, 0, ",", "."); ?>

											<div class="col-lg-4 col-md-4 col-sm-6 col-6">
												<div class="single-product">
													<!-- Product Image Start -->
													<div class="pro-img">
														<a href="<?= $link_chi_tiet ?>">
															<img style="height:250px ;" class="primary-img" src="<?= $link_anh ?>" alt="single-product">
															<!-- <img class="secondary-img" src="img\products\2.jpg" alt="single-product"> -->
														</a>
														<a href="#" class="quick_view" data-toggle="modal" data-target="#myModal" title="Quick View"><i class="lnr lnr-magnifier"></i></a>
													</div>
													<!-- Product Image End -->
													<!-- Product Content Start -->
													<div class="pro-content">
														<div class="pro-info">
															<h4><a href="<?= $link_chi_tiet ?>"><?= $tv_2['ten'] ?></a></h4>
															<p><span class="price"><?= $gia ?></span></p>
															<div class="label-product l_sale">giảm 30<span class="symbol-percent">%</span></div>
														</div>
														<div class="pro-actions">
															<div class="actions-primary">
																<a href="cart.html" title="Add to Cart"> + Add To Cart</a>
															</div>
															<div class="actions-secondary">
																<a href="compare.html" title="Compare"><i class="lnr lnr-sync"></i> <span>Add To Compare</span></a>
																<a href="wishlist.html" title="WishList"><i class="lnr lnr-heart"></i> <span>Add to WishList</span></a>
															</div>
														</div>
													</div>
													<!-- Product Content End -->
												</div>
											</div>
											<!-- Single Product End -->

								<?php				} else {
										}
										if ($i != 3) {
											$tv_2 = mysqli_fetch_array($tv_1);
										}
									}
								}
								?>

							</div>
							<!-- Row End -->
						</div>
						<!-- #grid view End -->
						<div id="list-view" class="tab-pane fade">
							<!-- Single Product End -->
						</div>
						<!-- #list view End -->
						<div class="pro-pagination">
							<ul class="blog-pagination">
								<?php
								for ($i = 1; $i <= $so_trang; $i++) {
									$link = "?thamso=xuat_san_pham_2&trang=" . $i;
								?>
									<li class="active"><a href="<?= $link ?>"><?= $i ?></a></li>
								<?php } ?>
							</ul>
							<div class="product-pagination">
								<span class="grid-item-list">Showing 1 to 12 of 51 (5 Pages)</span>
							</div>
						</div>
						<!-- Product Pagination Info -->
					</div>
					<!-- Grid & List Main Area End -->
				</div>
			</div>
			<!-- product Categorie List End -->
		</div>
		<!-- Row End -->
	</div>
	<!-- Container End -->
</div>
<!-- Shop Page End -->