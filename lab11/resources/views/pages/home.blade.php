@extends('layout')
@section('content')
    <div class="features_items">
        <!--features_items-->
        <h2 class="title text-center">Features Items</h2>
        @foreach ($product as $key => $product)
            <div class="col-sm-4">

                <div class="product-image-wrapper">
                    <div class="single-products">

                        <div class="productinfo text-center">
                            <form>
                                @csrf
                                <input type="hidden" class="cart_product_id_{{ $product->product_id }}"
                                    value="{{ $product->product_id }}">
                                <input type="hidden" class="cart_product_name_{{ $product->product_id }}"
                                    value="{{ $product->product_name }}">
                                <input type="hidden" class="cart_product_price_{{ $product->product_id }}"
                                    value="{{ $product->product_price }}">
                                <input type="hidden" class="cart_product_image_{{ $product->product_id }}"
                                    value="{{ $product->product_image }}">
                                <input type="hidden" class="cart_product_qty_{{ $product->product_id }}" value="1">

                                <a href="{{ URL::to('chi-tiet-san-pham?product_id=' . $product->product_id) }}">
                                    <img style="object-fit: cover ;width: 256px;height: 270px;"
                                        src="{{ URL::to('/public/uploads/product/' . $product->product_image) }}"
                                        alt="" />
                                    <h2>{{ number_format($product->product_price) . ' ' . 'VND' }}</h2>
                                    <p>{{ $product->product_name }}</p>
                                </a>
                                {{-- <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm
                                vào giỏ hàng</a> --}}
                                <button type="button" class="btn btn-default add-to-cart" name="add-to-cart"
                                    data-id_product="{{ $product->product_id }}">Thêm Giỏ
                                    Hàng</button>
                            </form>
                        </div>
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

        <script>
            $(document).ready(function() {
                $('.add-to-cart').click(function() {
                    /* Click bắt đầu sự kiện */
                    var id = $(this).data('id_product'); /* Lấy Giá Trị ID Từ data-id_product */
                    var cart_product_id = $('.cart_product_id_' + id).val(); /* Lấy Giá Trị Từ Các Class */
                    var cart_product_name = $('.cart_product_name_' + id).val();
                    var cart_product_image = $('.cart_product_image_' + id).val();
                    var cart_product_price = $('.cart_product_price_' + id).val();
                    var cart_product_qty = $('.cart_product_qty_' + id).val();

                    var _token = $('input[name="_token"]').val(); /* gửi form trong laravel cần token */
                    /* Chuyển Dữ Liệu Bằng Ajax */
                    $.ajax({
                        url: '{{ url('/add-cart-ajax') }}',
                        method: 'POST',
                        data: {
                            cart_product_id: cart_product_id,
                            cart_product_name: cart_product_name,
                            cart_product_image: cart_product_image,
                            cart_product_price: cart_product_price,
                            cart_product_qty: cart_product_qty,

                            _token: _token
                        },
                        success: function(data) {
                            swal({
                                title: "Đã thêm sản phẩm vào giỏ hàng",
                                text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                                showCancelButton: true,
                                cancelButtonText: "Xem tiếp",
                                confirmButtonClass: "btn-success",
                                confirmButtonText: "Đi đến giỏ hàng",
                                closeOnConfirm: false
                            },
                            function() {
                                window.location.href = "{{url('/show-cart-ajax')}}";
                            });

                        },
                        error: function(data) {
                            alert("Nhân Ơi Fix Bug Huhu :<");
                        },
                    });
                });
            });
        </script>

    </div>
    <!--features_items-->

    {{-- <div class="category-tab">
    <!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tshirt" data-toggle="tab">T-Shirt</a></li>
            <li><a href="#blazers" data-toggle="tab">Blazers</a></li>
            <li><a href="#sunglass" data-toggle="tab">Sunglass</a></li>
            <li><a href="#kids" data-toggle="tab">Kids</a></li>
            <li><a href="#poloshirt" data-toggle="tab">Polo shirt</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="tshirt">
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">

                            <img src="{{ 'public/fontend/images/gallery1.jpg' }}" alt="" />
                            <h2>$56</h2>
                            <p>Easy Polo Black Edition</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add
                                to cart</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="blazers">
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">

                            <img src="{{ 'public/fontend/images/gallery4.jpg' }}" alt="" />
                            <h2>$56</h2>
                            <p>Easy Polo Black Edition</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add
                                to cart</a>
                        </div>

                    </div>
                </div>
            </div>


        </div>

        <div class="tab-pane fade" id="sunglass">
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="{{ 'public/fontend/images/gallery3.jpg' }}" alt="" />
                            <h2>$56</h2>
                            <p>Easy Polo Black Edition</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add
                                to cart</a>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        <div class="tab-pane fade" id="kids">
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="{{ 'public/fontend/images/gallery1.jpg' }}" alt="" />
                            <h2>$56</h2>
                            <p>Easy Polo Black Edition</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add
                                to cart</a>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        <div class="tab-pane fade" id="poloshirt">
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="{{ 'public/fontend/images/gallery1.jpg' }}" alt="" />
                            <h2>$56</h2>
                            <p>Easy Polo Black Edition</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add
                                to cart</a>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!--/category-tab-->

<div class="recommended_items">
    <!--recommended_items-->
    <h2 class="title text-center">recommended items</h2>

    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">

                                <img src="{{ 'public/fontend/images/recommend1.jpg' }}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <a href="#" class="btn btn-default add-to-cart"><i
                                        class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{ 'public/fontend/images/recommend2.jpg' }}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <a href="#" class="btn btn-default add-to-cart"><i
                                        class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{ 'public/fontend/images/recommend3.jpg' }}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <a href="#" class="btn btn-default add-to-cart"><i
                                        class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{ 'public/fontend/images/recommend1.jpg' }}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <a href="#" class="btn btn-default add-to-cart"><i
                                        class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{ 'public/fontend/images/recommend2.jpg' }}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <a href="#" class="btn btn-default add-to-cart"><i
                                        class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{ 'public/fontend/images/recommend3.jpg' }}" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <a href="#" class="btn btn-default add-to-cart"><i
                                        class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
        </a>
        <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
        </a>
    </div>
</div>
<!--/recommended_items--> --}}
    {{-- <div class="fb-share-button" data-href="http://localhost/shopbanhanglaravel" data-layout="button_count"
        data-size="large"><a target="_blank"
            href="https://www.facebook.com/sharer/sharer.php?u={{ $url_canonical }}&amp;src=sdkpreparse"
            class="fb-xfbml-parse-ignore">Chia sẻ</a></div> --}}
    {{-- <div class="fb-like" data-href="{{ $url_canonical }}" data-width="" data-layout="button_count"
            data-action="like" data-size="large" data-share="false"></div> --}}
    {{-- <div class="fb-comments" data-href="{{ $url_canonical }}" data-width="" data-numposts="20"></div> --}}
    <div class="fb-share-button" data-href="https://www.w3schools.com" data-layout="button_count" data-size="large"><a
            target="_blank" href="https://www.w3schools.com&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a>
    </div>
    <div class="fb-like" data-href="https://www.w3schools.com" data-width="" data-layout="button_count" data-action="like"
        data-size="large" data-share="false"></div>
    <div class="fb-comments" data-href="https://www.w3schools.com" data-width="" data-numposts="5"></div>
    <div class="fb-page" data-href="https://www.facebook.com/freefirevn" data-tabs="message" data-width="" data-height=""
        data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
        <blockquote cite="https://www.facebook.com/freefirevn" class="fb-xfbml-parse-ignore"><a
                href="https://www.facebook.com/freefirevn">Garena Free Fire</a></blockquote>
    </div>
@endsection
