<?php
if (trim($_GET['tu_khoa']) != "") {
	$m = explode(" ", $_GET['tu_khoa']);
	$chuoi_tim_sql = "";
	for ($i = 0; $i < count($m); $i++) {
		$tu = trim($m[$i]);
		if ($tu != "") {
			$chuoi_tim_sql = $chuoi_tim_sql . " ten like '%" . $tu . "%' or";
		}
	}

	$m_2 = explode(" ", $chuoi_tim_sql);
	$chuoi_tim_sql_2 = "";
	for ($i = 0; $i < count($m_2) - 1; $i++) {
		$chuoi_tim_sql_2 = $chuoi_tim_sql_2 . $m_2[$i] . " ";
	}

	$so_du_lieu = 15;
	$tv = "select count(*) from san_pham  where $chuoi_tim_sql_2";
	$tv_1 = mysqli_query($connect, $tv);
	$tv_2 = mysqli_fetch_array($tv_1);
	$so_trang = ceil($tv_2[0] / $so_du_lieu);

	if (!isset($_GET['trang'])) {
		$vtbd = 0;
	} else {
		$vtbd = ($_GET['trang'] - 1) * $so_du_lieu;
	}

	$tv = "select id,ten,gia,hinh_anh,thuoc_menu from san_pham where $chuoi_tim_sql_2 order by id desc limit $vtbd,$so_du_lieu";

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
								<li><a data-toggle="tab" href="#list-view"><i class="fa fa-list-ul"></i></a></li>
							</ul>
						</div>
						<!-- Toolbar Short Area Start -->
						<div class="main-toolbar-sorter clearfix">
							<div class="toolbar-sorter d-flex align-items-center">
								<h4 style="margin:auto;">Sản Phẩm</h4>
							</div>
						</div>
						<!-- Toolbar Short Area End -->
						<!-- Toolbar Short Area Start -->
						<div class="main-toolbar-sorter clearfix">
							<div class="toolbar-sorter d-flex align-items-center">
								<div class="pro-pagination">
									<ul class="blog-pagination">
										<?php
										for ($i = 1; $i <= $so_trang; $i++) {
											$link = "?thamso=tim_kiem&tu_khoa=" . $_GET['tu_khoa'] . "&trang=" . $i;
										?>
											<li class="active"><a href="<?= $link ?>"><?= $i ?></a></li>
										<?php } ?>
									</ul>
									<div class="product-pagination">
										<span class="grid-item-list"></span>
									</div>
								</div>
							</div>
						</div>
						<!-- Toolbar Short Area End -->
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
												$quick_view = "?thamso=quick_view&id=" . $tv_2['id'];
												$gia = $tv_2['gia'];
												$gia = number_format($gia, 0, ",", "."); ?>

												<div class="col-lg-4 col-md-4 col-sm-6 col-6">
													<div class="single-product">
														<!-- Product Image Start -->
														<div class="pro-img">
															<a href="<?= $link_chi_tiet ?>">
																<img class="primary-img" src="<?= $link_anh ?>" alt="single-product">
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
																<div class="label-product l_sale">giảm 30<span class="symbol-percent">%</span></div>
															</div>
															<div class="pro-actions">
																<div class="actions-primary">
																	<a href="cart.html" title="Add to Cart">Mua Ngay</a>
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
								<div class="single-product">
									<div class="row">
										<?php
										while ($tv_2 = mysqli_fetch_array($tv_1)) {
											for ($i = 1; $i <= 3; $i++) {
												if ($tv_2 != false) {
													$link_anh = "hinh_anh/san_pham/" . $tv_2['hinh_anh'];
													$link_chi_tiet = "?thamso=chi_tiet_san_pham&id=" . $tv_2['id'];
													$quick_view = "?thamso=quick_view&id=" . $tv_2['id'];
													$gia = $tv_2['gia'];
													$gia = number_format($gia, 0, ",", "."); ?>
													<!-- Product Image Start -->
													<div class="col-lg-4 col-md-5 col-sm-12">
														<div class="pro-img">
															<a href="<?= $link_chi_tiet ?>">
																<img class="primary-img" src="<?= $link_anh ?>" alt="single-product">
															</a>
															<a href="#" class="quick_view" data-toggle="modal" data-target="#myModal" title="Quick View"><i class="lnr lnr-magnifier"></i></a>
															<span class="sticker-new">new</span>
														</div>
													</div>
													<!-- Product Image End -->
													<!-- Product Content Start -->
													<div class="col-lg-8 col-md-7 col-sm-12">
														<div class="pro-content hot-product2">
															<h4>
																<a href="<?= $link_chi_tiet ?>"><?= $tv_2['ten'] ?></a>
															</h4>
															<p><span class="price"><?= $gia ?></span></p>
															<p><?= $tv_2['noi_dung'] ?></p>
															<div class="pro-actions">
																<div class="actions-primary">
																	<a href="cart.html" title="" data-original-title="Add to Cart"> +
																		Add To Cart</a>
																</div>
																<div class="actions-secondary">
																	<a href="compare.html" title="" data-original-title="Compare"><i class="lnr lnr-sync"></i> <span>Add To Compare</span></a>
																	<a href="wishlist.html" title="" data-original-title="WishList"><i class="lnr lnr-heart"></i> <span>Add to WishList</span></a>
																</div>
															</div>
														</div>
													</div>
										<?php
												} else {
												}
												if ($i != 3) {
													$tv_2 = mysqli_fetch_array($tv_1);
												}
											}
										} ?>
										<!-- Product Content End -->
									</div>
								</div>
								<!-- Single Product End -->
							</div>
							<!-- #list view End -->
							<div class="pro-pagination">
								<ul class="blog-pagination">
									<?php
									for ($i = 1; $i <= $so_trang; $i++) {
										$link = "?thamso=tim_kiem&tu_khoa=" . $_GET['tu_khoa'] . "&trang=" . $i;
									?>
										<li class="active"><a href="<?= $link ?>"><?= $i ?></a></li>
									<?php } ?>
								</ul>
								<div class="product-pagination">
									<!-- <span class="grid-item-list">Trang</span> -->
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
<?php	} else {
	echo "Bạn chưa nhập từ khóa";
}
