<?php
$tv = "select * from banner limit 0,1";
$tv_1 = mysqli_query($connect, $tv);
$tv_2 = mysqli_fetch_array($tv_1);
$link_hinh = "hinh_anh/banner/" . $tv_2['hinh'];
?>
<div class="popup_banner">
    <span class="popup_off_banner">×</span>
    <div class="banner_popup_area">
        <img style ="height: 300px; object-fit: cover; "src="<?= $link_hinh ?>" alt="">
    </div>
</div>