@extends('welcome')
@section('content') 
<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Kết quả tìm kiếm</h2>
						@foreach($search_product as $key => $product)
						<div class="col-sm-3">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="public/upload/products/{{$product->product_image}}"  height="200" height="100%" />
											<h4>{{$product->product_name}}</h4>
											<h5 id="price_product">{{number_format($product->product_price) . ' Vnđ'}}</h4>
										</div>
										<div class="product-overlay">
											<div class="overlay-content">
												<img src="{{URL::to('public/upload/products/'.$product->product_image)}}" height="100%" width="100%" />
											</div>
										</div>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="{{URL::to('chi-tiet-san-pham/'.$product->product_id)}}"><i class="fa fa-shopping-cart"></i>Chi tiết</a></li>
									</ul>
								</div>
							</div>
                        </div>
						@endforeach
                    </div><!--features_items-->
                    <div class="category-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
							@foreach($all_brand as $key => $value_cate)
								<li><a href="#tshirt" data-toggle="tab">{{$value_cate->brand_name}}</a></li>
							@endforeach	
								{{-- <li><a href="#tshirt" data-toggle="tab">T-Shirt</a></li> --}}
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="tshirt" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="{{('public/frontEnd/images/home/gallery1.jpg')}}" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div>
							<div class="tab-pane fade" id="sunglass" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery3.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div>
							<div class="tab-pane fade" id="kids" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery1.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div>
						</div>
					</div><!--/category-tab-->
@endsection