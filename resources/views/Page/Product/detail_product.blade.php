@extends('welcome')
@section('content')
@foreach($detail_product as $key => $value_detail_product)
<div class="product-details">
    <!--product-details-->
    <div class="col-sm-5">
        <div class="view-product">
            <img src="{{URL::to('public/upload/products/'.$value_detail_product->product_image)}}"/>
        </div>
        <form>
            @csrf
            <input type="hidden" id="cart_product_id_{{$value_detail_product->product_id}}" value="{{$value_detail_product->product_id}}">
            <input type="hidden" id="cart_product_name_{{$value_detail_product->product_id}}" value="{{$value_detail_product->product_name}}">
            <input type="hidden" id="cart_product_image_{{$value_detail_product->product_id}}" value="{{$value_detail_product->product_image}}">
            <input type="hidden" id="cart_product_price_{{$value_detail_product->product_id}}" value="{{$value_detail_product->product_price}}">

            <div id="similar-product" class="carousel slide" data-ride="carousel">
                <!-- Wrapper for slides -->
				<div class="carousel-inner">
					<div class="item active">
						<a href=""><img src="{{URL::to('public/frontEnd/images/product-details/similar1.jpg')}}" alt=""></a>
						<a href=""><img src="{{URL::to('public/frontEnd/images/product-details/similar2.jpg')}}" alt=""></a>
						<a href=""><img src="{{URL::to('public/frontEnd/images/product-details/similar3.jpg')}}" alt=""></a>
					</div>
            <div class="item">
                <a href=""><img src="{{URL::to('public/frontEnd/images/product-details/similar1.jpg')}}" alt=""></a>
                <a href=""><img src="{{URL::to('public/frontEnd/images/product-details/similar2.jpg')}}" alt=""></a>
                <a href=""><img src="{{URL::to('public/frontEnd/images/product-details/similar3.jpg')}}" alt=""></a>
            </div>
    </div>

    <!-- Album -->
    <a class="left item-control" href="#similar-product" data-slide="prev">
        <i class="fa fa-angle-left"></i>
    </a>
    <a class="right item-control" href="#similar-product" data-slide="next">
        <i class="fa fa-angle-right"></i>
    </a>
</div>
</div>
<div class="col-sm-7">
    <div class="product-information">
        <!--/product-information-->
        <img src="{{URL::to('public/frontEnd/images/product-details/new.jpg')}}" class="newarrival" alt="" />
        <h2>Sản phẩm: {{$value_detail_product->product_name}}</h2>
        <img src="{{URL::to('public/frontEnd/images/product-details/rating.png')}}" alt="" />
        <span>
            <span>{{number_format($value_detail_product->product_price,0,',','.')}}đ</span>
            <label>Nhập số lượng:</label>
            <input id="cart_product_qty_{{$value_detail_product->product_id}}" type="number" min="1" value="1" />
            <input name="productId_hidden" type="hidden" value="{{$value_detail_product->product_id}}" />
			<?php 
				$customer_id = Session::get('customer_id');
				if($customer_id != null){
			?>
				<a class="fa btn btn-primary"  id="add-to-cart" data-id_product="{{$value_detail_product->product_id}}"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ</a>
			<?php
				}else{
			?>
				<a href="{{URL::to('login-checkout')}}" class="fa btn btn-primary add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ</a>
			<?php
					}
			?>
            
        </span>
        <p><b>Danh mục:</b> {{$value_detail_product->cate_name}}</p>
        <p><b>Thương hiệu:</b> {{$value_detail_product->brand_name}}</p>
        <p><b>Giới thiệu:</b> {{$value_detail_product->product_description}}</p>
        <a href=""><img src="images/product-details/share.png" class="share img-responsive" alt="" /></a>
    </div>
    <!--/product-information-->
</div>
</div>
<!--/product-details-->
</form>
<div class="category-tab shop-details-tab">
    <!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#details" data-toggle="tab">Chi tiết</a></li>
            <li><a href="#companyprofile" data-toggle="tab">Hồ sơ</a></li>
            <li><a href="#reviews" data-toggle="tab">Reviews</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="details">
            <p>{{$value_detail_product->product_content}}</p>
        </div>
        <div class="tab-pane fade" id="companyprofile">
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="images/home/gallery4.jpg" alt="" />
                            <h2>$56</h2>
                            <p>Easy Polo Black Edition</p>
                            <button type="button" class="btn btn-default"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="reviews">
            <div class="col-sm-12">
                <ul>
                    <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                    <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                    <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                </ul>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                <p><b>Write Your Review</b></p>

                <form action="#">
                    <span>
                        <input type="text" placeholder="Your Name" />
                        <input type="email" placeholder="Email Address" />
                    </span>
                    <textarea name=""></textarea>
                    <b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
                    <button type="button" class="btn btn-default pull-right">
                        Submit
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>
<!--/category-tab-->
@endforeach
<div class="recommended_items">
    <!--recommended_items-->
    <h2 class="title text-center">Gợi ý cho bạn</h2>
    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">
                @foreach($product_recommended as $key => $value_product_recommended)
                <div class="col-sm-3">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{URL::to('public/upload/products/'.$value_product_recommended->product_image)}}" height="100%" width="100%" />
                                <h3>{{$value_product_recommended->product_name}}</h3>
                                <h5 id="price_product">{{number_format($value_product_recommended->product_price,0,',','.')}}Đ</h5>
                                <a href="{{URL::to('chi-tiet-san-pham/'.$value_product_recommended->product_id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
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
<!--/recommended_items-->
<!-- ajajax -->

@endsection
