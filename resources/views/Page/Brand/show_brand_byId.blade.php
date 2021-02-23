@extends('welcome')
@section('content')
<div class="features_items"><!--features_items-->
                        <h2 class="title text-center">Thương hiệu {{$get_brand_name->brand_name}}</h2>
						<div class="row">
							<div class="col-md-2" style="margin-left: 15px; margin-bottom: 15px ">
							<form>
							@csrf
								<select class="form-select" name="filter" id="filter">
									<option selected>Lọc</option>
									<option value="{{Request::url()}}?sap_xep=ten_tang_dan">Tên từ A -> Z</option>
									<option value="{{Request::url()}}?sap_xep=ten_giam_dan">Tên từ Z -> A</option>
									<option value="{{Request::url()}}?sap_xep=gia_tang_dan">Giá tăng dần</option>
									<option value="{{Request::url()}}?sap_xep=gia_giam_dan">Giá giảm dần</option>
								</select>
							</form>
							</div>
						</div>
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
										<li><a href="{{URL::to('chi-tiet-san-pham/'.$value_product_byId->product_slug)}}"><i class="fa fa-shopping-cart"></i>Chi tiết</a></li>
									</ul>
								</div>
							</div>
                        </div>
						@endforeach
                    </div><!--features_items-->
					<div>
					<span>{{$product_byId->links()}}<span>
					</div>
					
@endsection