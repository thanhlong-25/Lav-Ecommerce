@extends('welcome')
@section('content')
<div class="features_items"><!--features_items-->
                        @foreach($get_brand_name as $key => $value_brand_name)
                            <h2 class="title text-center">Thương hiệu {{$value_brand_name->brand_name}}</h2>
                        @endforeach
						@foreach($product_byId as $key => $value_product_byId)
						
						<div class="col-sm-3">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="{{URL::to('public/upload/products/'.$value_product_byId->product_image)}}"  height="200px" width="100%" />
											<h4>{{$value_product_byId->product_name}}</h4>
											<h5 id="price_product">{{number_format($value_product_byId->product_price,0,',','.')}}đ</h5>
										</div>
										<div class="product-overlay">
											<div class="overlay-content">
												<img src="{{URL::to('public/upload/products/'.$value_product_byId->product_image)}}"  height="100%" width="100%" />
											</div>									
										</div>
										
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="{{URL::to('chi-tiet-san-pham/'.$value_product_byId->product_id)}}"><i class="fa fa-shopping-cart"></i>Chi tiết</a></li>
									</ul>
								</div>
							</div>
                        </div>
						@endforeach
                    </div><!--features_items-->
@endsection