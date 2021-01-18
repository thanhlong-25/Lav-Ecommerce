@extends('welcome')
@section('content')
@foreach($detail_product as $key => $value_detail_product)
<input type="hidden" id="cart_product_id_{{$value_detail_product->product_id}}" value="{{$value_detail_product->product_id}}">
<input type="hidden" id="cart_product_name_{{$value_detail_product->product_id}}" value="{{$value_detail_product->product_name}}">
<input type="hidden" id="cart_product_image_{{$value_detail_product->product_id}}" value="{{$value_detail_product->product_image}}">
<input type="hidden" id="cart_product_price_{{$value_detail_product->product_id}}" value="{{$value_detail_product->product_price}}">
<input type="hidden" id="product_inventory_{{$value_detail_product->product_id}}" value="{{$value_detail_product->product_inventory}}">
<!--product-details-->

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{URL::to('/trang-chu')}}">Trang chủ</a></li>
        <li class="breadcrumb-item"><a href="{{URL::to('danh-muc-san-pham/'.$product_cate)}}">{{$product_cate}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$value_detail_product->product_name}}</li>
    </ol>
</nav>

<div class="col-sm-6">
    <ul id="imageGallery">
        @foreach($all_gallery as $key1 => $gallery_value)
        <li class="imgslider" data-thumb="{{URL::to('public/upload/gallerys/'.$gallery_value->gallery_image)}}">
            <img src="{{URL::to('public/upload/gallerys/'.$gallery_value->gallery_image)}}" width="100%" height="400px" />
        </li>
        @endforeach
    </ul>
</div>

<div class="col-sm-6">
    <div class="product-information">
        <!--/product-information-->
        <img src="{{URL::to('public/frontEnd/images/product-details/new.jpg')}}" class="newarrival" alt="" />
        <h2>Sản phẩm: {{$value_detail_product->product_name}}</h2>
        <ul class="list-inline">
                    @for($count=1; $count<=5;$count++)
                        @php
                            if($count<=$rating){
                                $color = 'color:#ffcc00;';
                            }else{
                                $color = 'color:#ccc;';
                            }
                        @endphp
                    <li class="rating" style="{{$color}} font-size: 15px;">&#9733</li>
                    @endfor
        </ul>
        <span>
            <span>{{number_format($value_detail_product->product_price,0,',','.')}}đ</span>
            <label>Nhập số lượng:</label>
            <input id="cart_product_qty_{{$value_detail_product->product_id}}" type="number" min="1" max="{{$value_detail_product->product_inventory}}" value="1" />
            <input name="productId_hidden" id="productId_hidden" type="hidden" value="{{$value_detail_product->product_id}}" />
            <?php 
				$customer_id = Session::get('customer_id');
				if($customer_id != null){
			?>
            <a class="fa btn btn-primary" id="add-to-cart" data-id_product="{{$value_detail_product->product_id}}"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ</a>
            <?php
				}else{
			?>
            <a href="{{URL::to('login-checkout')}}" class="fa btn btn-primary add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ</a>
            <?php
					}
			?>

        </span>
        <p><b>Còn lại:</b> {{$value_detail_product->product_inventory}} sản phẩm</p>
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
            <li><a href="#details" data-toggle="tab">Chi tiết</a></li>
            <li><a href="#companyprofile" data-toggle="tab">Hồ sơ</a></li>
            <li class="active"><a href="#reviews" data-toggle="tab">Reviews</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade" id="details">
            <p>{{$value_detail_product->product_description}}</p>
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

{{-- COMMENT --}}
        <div class="tab-pane active in" id="reviews">
            <div class="col-sm-12">
                <ul>
                    <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                    <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                    <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                </ul>

                <div class="comment_load" id="comment_load"></div>

                <?php 
				    if($customer_id != null){
                ?>
                 <form action="{{URL::to('/send-comment')}}" method="POST">
                    <b>Viết đánh giá của bạn</b>
                    <input type="hidden" id="customer_id_hidden" value="{{$customer_id}}"/>
                    <textarea name="comment_content" id="comment_content" placeholder="Nội dung"></textarea>
                    <button type="button" id="send_comment" name="send_comment" class="btn btn-default pull-right">Bình luận</button>
                    <button type="button" data-toggle="modal" data-target="#ratingModal" class="btn btn-default pull-right" style="margin: 0 5px">Đánh giá</button>
                </form>
                <?php
                    }else{
                ?>
                <p>Hãy đăng nhập để bình luận</p>
                <?php
                    }
                ?>
               
            </div>
        </div>

    </div>
</div>
<!--/category-tab-->
@endforeach

<!-- Rating Modal -->
<!-- Modal -->
<div class="modal fade bd-example-modal-sm" id="ratingModal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content ">
      <div class="modal-body align-content-center">
      <p>Đánh giá sản phẩm</p>
        <ul class="list-inline">
                    @for($count=1; $count<=5;$count++)
                        @php
                            if($count<=$rating){
                                $color = 'color:#ffcc00;';
                            }else{
                                $color = 'color:#ccc;';
                            }
                        @endphp
                    <li class="rating" 
                        id="{{$value_detail_product->product_id}}-{{$count}}"
                        data-index="{{$count}}"
                        data-product_id="{{$value_detail_product->product_id}}"
                        data-customer_id="{{$customer_id}}"
                        data-rating="{{$rating}}" 
                        style="cursor:pointer; {{$color}} font-size: 50px;">&#9733</li>
                    @endfor
                </ul>

      </div>
    </div>
  </div>
</div>

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
                                <a href="{{URL::to('chi-tiet-san-pham/'.$value_product_recommended->product_slug)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Xem chi tiết</a>
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

@endsection
