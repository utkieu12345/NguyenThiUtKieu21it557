@extends('layout')
@section('content_category')
<div class="features_items">
    <!--features_items-->
    <h2 class="title text-center">Danh Mục Sản Phẩm {{ $category_name->category_name }}</h2>
    @foreach($category_by_id as $key => $product)
    <div class="col-sm-4">
       
        <div class="product-image-wrapper">
            <div class="single-products">

                <div class="productinfo text-center">
                    <a href="{{ URL::to('chi-tiet-san-pham?product_id='.$product->product_id) }}">
                        <img style="object-fit: cover ;width: 256px;height: 270px;"
                            src="{{ URL::to('/public/uploads/product/' . $product->product_image) }}" alt="" />
                        <h2>{{ number_format($product->product_price) . ' ' . 'VND' }}</h2>
                        <p>{{ $product->product_name }}</p>
                    </a>
                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
                </div>
                {{-- <div class="product-overlay">
                    <div class="overlay-content">
                        <h2>{{ $product->product_price }}</h2>
                        <p>{{ $product->product_name }}</p>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
                    </div>
                </div> --}}
            </div>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                    <li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
                </ul>
            </div>
        </div>
       
    </div>
    @endforeach

</div>
@endsection