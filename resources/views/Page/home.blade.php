@extends('welcome')
@section('content')
<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Sản phẩm mới nhất</h2>
						@foreach($all_product as $key => $product)
						<div class="col-sm-3">
						<form
							@csrf
						<input type="hidden" id="cart_product_id_{{$product->product_id}}" value="{{$product->product_id}}">
						<input type="hidden" id="cart_product_name_{{$product->product_id}}" value="{{$product->product_name}}">
						<input type="hidden" id="cart_product_image_{{$product->product_id}}" value="{{$product->product_image}}">
						<input type="hidden" id="cart_product_price_{{$product->product_id}}" value="{{$product->product_price}}">
						<input type="hidden" id="cart_product_qty_{{$product->product_id}}" value="{{1}}">

							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="public/upload/products/{{$product->product_image}}"  height="200" height="100%" />
											<h4 name="name_product">{{$product->product_name}}</h4>
											<h5 id="price_product">{{number_format($product->product_price,0,',','.')}}đ</h5>
										</div>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a class="fa add-to-cart" href="{{URL::to('chi-tiet-san-pham/'.$product->product_slug)}}"><i class="fa fa-shopping-cart"></i>Đặt hàng</a></li>	
										<li><a class="fa add-to-cart" data-toggle="modal" data-target="#favourite" data-id_product="{{$product->product_id}}" ><i class="fa fa-eye"></i>Yêu thích</a></li>	
									</ul>
								</div>
							</div>
						</form>
                        </div>
						@endforeach
                    </div><!--features_items-->

					<!-- Modal -->
						<div class="modal fade" id="favourite" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								...
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="button" class="btn btn-primary">Save changes</button>
							</div>
							</div>
						</div>
						</div>

					{{-- Phân trang --}}
					<footer class="panel-footer">
        				<span>{{$all_product->links('vendor.pagination.custom_pagination')}}<span>
    				</footer>

                    <div class="category-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
							@foreach($all_brand as $key => $value_brand)
								<li><a href="#tshirt" data-toggle="tab">{{$value_brand->brand_name}}</a></li>
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