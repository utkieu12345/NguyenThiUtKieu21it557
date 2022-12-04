<?php
$tv = "select * from menu_doc order by id";
$tv_1 = mysqli_query($connect, $tv);
while ($tv_2 = mysqli_fetch_array($tv_1)) {
	$link = "?thamso=xuat_san_pham&id=" . $tv_2['id'];
	echo "<a href='$link'>";
	echo $tv_2['ten'];
	echo "</a>";
}
echo "</div>";
?>
<div class="main-page-banner pb-50 off-white-bg">
	<div class="container">
		<div class="row">
			<!-- Vertical Menu Start Here -->
			<div class="col-xl-3 col-lg-4 d-none d-lg-block">
				<div class="vertical-menu mb-all-30">
					<nav>
						<ul class="vertical-menu-list">
							<?php
							while ($tv_2 = mysqli_fetch_array($tv_1)) {
								$link = "?thamso=xuat_san_pham&id=" . $tv_2['id'];
							?>
								<li><a href="<?= $link ?>"><span><img src="img\vertical-menu\5.png" alt="menu-icon"></span><?= $tv_2['ten'] ?></a>
								</li>
							<?php } ?>
							<!-- More Categoies End -->
						</ul>
					</nav>
				</div>
			</div>
			<!-- Vertical Menu End Here -->
			<!-- Slider Area Start Here -->
			<div class="col-xl-9 col-lg-8 slider_box">
				<div class="slider-wrapper theme-default">
					<!-- Slider Background  Image Start-->
					<div id="slider" class="nivoSlider">
						<a href="shop.html"><img src="img\slider\4.jpg" data-thumb="img/slider/1.jpg" alt="" title="#htmlcaption"></a>
						<a href="shop.html"><img src="img\slider\3.jpg" data-thumb="img/slider/2.jpg" alt="" title="#htmlcaption2"></a>
					</div>
					<!-- Slider Background  Image Start-->
				</div>
			</div>
			<!-- Slider Area End Here -->
		</div>
		<!-- Row End -->
	</div>
	<!-- Container End -->
</div>