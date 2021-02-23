<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | E-Commerce</title>
    <link href="{{asset('public/frontEnd/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('public/frontEnd/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('public/frontEnd/css/prettyPhoto.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('public/frontEnd/css/animate.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('public/frontEnd/css/main.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('public/frontEnd/css/responsive.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('public/frontEnd/css/sweetalert.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('public/frontEnd/css/lightslider.css')}}" type="text/css" rel="stylesheet" />
    <link rel="shortcut icon" href="{{('public/frontEnd/images/ico/favicon.ico')}}">
</head>
<!--/head-->

<body>
    <?php
    Session::get("shipping_id");
    Session::get("customer_id");
?>
    <header id="header">
        <!--header-->
        <div class="header_top">
            <!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fa fa-phone"></i> +0981803365</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> long.tranthanh025@gmail.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/header_top-->

        <div class="header-middle">
            <!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="index.html"><img src="{{('public/frontEnd/images/home/logo.png')}}" alt="" /></a>
                        </div>
                        <div class="btn-group pull-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                    USA
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Canada</a></li>
                                    <li><a href="#">UK</a></li>
                                </ul>
                            </div>

                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                    DOLLAR
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Canadian Dollar</a></li>
                                    <li><a href="#">Pound</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="{{URL::to('login-checkout')}}"><i class="fa fa-user"></i> Tài khoản</a></li>
                                {{-- Check login --}}
                                <?php
									$customer_id = Session::get('customer_id');
									if($customer_id != null){
								?>
                                <li><a href="{{URL::to('payment')}}"><i class="fa fa-lock"></i> Đơn hàng của bạn</a></li>
                                <?php
									}else{
								?>
                                <li><a href="{{URL::to('login-checkout')}}"><i class="fa fa-lock"></i> Đơn hàng của bạn</a></li>
                                <?php
									}
								?>
                                {{-- Check login --}}
                                <?php
									$customer_id = Session::get('customer_id');
									if($customer_id != null){
								?>
                                <li><a href="{{URL::to('logout-checkout')}}"><i class="fa fa-lock"></i> Đăng xuất</a></li>
                                <?php
									}else{
								?>
                                <li><a href="{{URL::to('login-checkout')}}"><i class="fa fa-lock"></i> Đăng nhập</a></li>
                                <?php
									}
								?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/header-middle-->

        <div class="header-bottom">
            <!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{URL::to('/trang-chu')}}" class="active">Trang chủ</a></li>
                                <li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="shop.html">Sản phẩm</a></li>
                                        <li><a href="product-details.html">Chi tiết sản phẩm</a></li>
                                        {{-- <li><a href="{{URL::to('/show-cart')}}">Giỏ hàng</a>
                                </li> --}}
                                <li><a href="{{URL::to('/show-cart-ajax')}}">Giỏ hàng</a></li>
                                <li><a href="{{URL::to('login-checkout')}}">Đăng nhập</a></li>
                            </ul>
                            </li>
                            <li class="dropdown"><a href="#">Tin tức<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="blog.html">Blog List</a></li>
                                    <li><a href="blog-single.html">Blog Single</a></li>
                                </ul>
                            </li>
                            <li><a href="{{URL::to('/show-cart-ajax')}}">Giỏ hàng</a></li>
                            <li><a href="{{URL::to('/contact')}}">Liên hệ</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <form action="{{URL::to('tim-kiem')}}" method="post">
                            {{csrf_field()}}
                            <div class="search_box pull-right">
                                <input type="text" id="keyword_search" name="keyword_search" placeholder="Tìm kiếm" />
                                <input style="margin-top: 0px; color: #000; width: 80px" class="btn btn-primary btn-sm" type="submit" value="Tìm kiếm" />
                                <div id="search_ajax"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!--/header-bottom-->
    </header>
    <!--/header-->

    <section id="slider">
        <!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#slider-carousel" data-slide-to="1"></li>
                            <li data-target="#slider-carousel" data-slide-to="2"></li>
                        </ol>

                        @if($banner)
                        <div class="carousel-inner">
                            @php
                            $i = 0;
                            @endphp
                            @foreach($banner as $key => $banner_value)
                            @php
                            $i++;
                            @endphp
                            <div class="item {{$i == 1 ? 'active' : ''}}">
                                <div class="col-sm-12">
                                    <img src="{{URL::to('public/upload/banners/'.$banner_value->banner_image)}}" class="img img-responsive" width="100%">
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif

                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--/slider-->

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <div class="left-sidebar">
                        <!--brands_products-->
                        <div class="brands_products">
                            <h2>Dang Mục</h2>
                            <div class="brands-name">
                                <ul class="nav nav-pills nav-stacked">
                                    @foreach($all_cate as $key => $cate)
                                    <li><a href="{{URL::to('danh-muc-san-pham/'.$cate->cate_slug)}}">{{$cate->cate_name}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <!--/brands_products-->
                        <!--/category-products-->

                        <div class="brands_products">
                            <!--brands_products-->
                            <h2>Thương Hiệu</h2>
                            <div class="brands-name">
                                <ul class="nav nav-pills nav-stacked">
                                    @foreach($all_brand as $key => $brand)
                                    <li><a href="{{URL::to('thuong-hieu-san-pham/'.$brand->brand_slug)}}">{{$brand->brand_name}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!--/brands_products-->

                        {{-- <div class="price-range">
                            <!--price-range-->
                            <h2>Mức giá</h2>
                            <div class="well text-center">
                                <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2"><br />
                                <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
                            </div>
                        </div> --}}
                    </div>
                </div>

                <div class="col-sm-10 padding-right">
                    <!-- ############################################################################################################## -->
                    <!-- ############################################################################################################## -->
                    <!-- Gọi lại home.blale.php -- gọi theo tên trong section -->
                    @yield('content')
                </div>
            </div>
    </section>

    <footer id="footer">
        <!--Footer-->
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="companyinfo">
                            <h2><span>e</span>-shopper</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{asset('public/frontEnd/images/home/iframe4.png')}}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{asset('public/frontEnd/images/home/iframe4.png')}}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{asset('public/frontEnd/images/home/iframe4.png')}}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{asset('public/frontEnd/images/home/iframe4.png')}}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="address">
                            <img src="{{asset('public/frontEnd/images/home/iframe4.png')}}" alt="" />
                            <p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-widget">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Service</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Hỗ trợ</a></li>
                                <li><a href="#">Liên hệ</a></li>
                                <li><a href="#">Trạng thái</a></li>
                                <li><a href="#">Change Location</a></li>
                                <li><a href="#">FAQ’s</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Quock Shop</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">T-Shirt</a></li>
                                <li><a href="#">Mens</a></li>
                                <li><a href="#">Womens</a></li>
                                <li><a href="#">Gift Cards</a></li>
                                <li><a href="#">Shoes</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Policies</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Điều khoản dịch vụ</a></li>
                                <li><a href="#">Chính sách quyền riêng tư</a></li>
                                <li><a href="#">Chính sách hoàn trả</a></li>
                                <li><a href="#">Hệ thống thanh toán</a></li>
                                <li><a href="#">Ticket System</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>About Shopper</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Thông tin công ty</a></li>
                                <li><a href="#">Nhân sự</a></li>
                                <li><a href="#">Văn phòng</a></li>
                                <li><a href="#">Chi nhánh</a></li>
                                <li><a href="#">Bản quyền</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3 col-sm-offset-1">
                        <div class="single-widget">
                            <h2>About Shopper</h2>
                            <form action="#" class="searchform">
                                <input type="text" placeholder="Your email address" />
                                <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                                <p>Get the most recent updates from <br />our site and be updated your self...</p>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <p class="pull-left">Copyright © 2020 ThanhLongCorp Inc. All rights reserved.</p>
                    <p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
                </div>
            </div>
        </div>

    </footer>
    <!--/Footer-->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="{{asset('public/frontEnd/js/jquery.js')}}"></script>
    <script src="{{asset('public/frontEnd/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/frontEnd/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('public/frontEnd/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/frontEnd/js/main.js')}}"></script>
    <script src="{{asset('public/frontEnd/js/sweetalert.js')}}"></script>
    <script src="{{asset('public/frontEnd/js/lightslider.js')}}"></script>

    {{-- ########################### Comment ####################################--}}
    <script type="text/javascript">
        $(document).ready(function() {

            loadComment();

            function loadComment() {
                var product_id = $('#productId_hidden').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{url('/load-comment')}}'
                    , method: 'POST'
                    , data: {
                        product_id: product_id
                        , _token: _token
                    }
                    , success: function(data) {
                        $('#comment_load').html(data);
                    }
                });
            }

            $('#send_comment').click(function() {
                var customer_id = $('#customer_id_hidden').val();
                var product_id = $('#productId_hidden').val();
                var comment_content = $('#comment_content').val();
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: '{{url('/send-comment')}}'
                    , method: 'POST'
                    , data: {
                        product_id: product_id
                        , customer_id: customer_id
                        , comment_content: comment_content
                        , _token: _token
                    }
                    , success: function(data) {
                        loadComment();
                        $('#comment_content').val("");
                    }
                });
            })

        });

    </script>


    {{--// -----------------------------------------------------Rating Hover---------------------------------------------------------}}
    <script text="type/javascript">
        $(document).ready(function() {
            //Rating Hover---------------------------------------------------------
            function remove_background(product_id) {
                for (var count = 1; count <= 5; count++) {
                    $('#' + product_id + '-' + count).css('color', '#ccc');
                }
            }

            $(document).on('mouseenter', '.rating', function() {
                var index = $(this).data("index");
                var product_id = $(this).data("product_id");
                remove_background(product_id);

                for (var count = 1; count <= index; count++) {
                    $('#' + product_id + '-' + count).css('color', '#ffcc00');
                }
            });

            $(document).on('mouseleave', '.rating', function() {
                var index = $(this).data("index");
                var product_id = $(this).data("product_id");
                var rating = $(this).data("rating");
                remove_background(product_id);

                for (var count = 1; count <= rating; count++) {
                    $('#' + product_id + '-' + count).css('color', '#ffcc00');
                }
            });

            $(document).on('click', '.rating', function() {
                var index = $(this).data("index");
                var product_id = $(this).data("product_id");
                var customer_id = $(this).data("customer_id");
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{url(' /rating-product')}}'
                    , method: 'POST'
                    , data: {
                        index: index
                        , product_id: product_id
                        , customer_id: customer_id
                        , _token: _token
                    }
                    , success: function(data) {
                        swal("Xin cảm ơn!", "Bạn đã đánh giá sản phẩm này " + index + " sao", "success").then((value) => {
                            location.reload();
                        });
                    }
                });
            });
        })

    </script>


    {{-- //---------------------------------------------------------------------------------- --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $("#add-to-cart").click(function() {
                // Class thì .cart_product_id_, ID thì #cart_product_id_
                var id = $(this).data('id_product');
                var cart_product_id = $('#cart_product_id_' + id).val();
                var cart_product_name = $('#cart_product_name_' + id).val();
                var cart_product_image = $('#cart_product_image_' + id).val();
                var cart_product_price = $('#cart_product_price_' + id).val();
                var cart_product_qty = $('#cart_product_qty_' + id).val();
                var product_inventory = $('#product_inventory_' + id).val();
                var _token = $('input[name="_token"]').val();

                if (parseInt(product_inventory) < parseInt(cart_product_qty)) {
                    swal("Thất bại!", "Sản phẩm trong kho không đủ!", "error");
                } else {
                    $.ajax({
                        url: '{{url('/add-cart-ajax')}}'
                        , method: 'POST'
                        , data: {
                            cart_product_id: cart_product_id
                            , cart_product_name: cart_product_name
                            , cart_product_image: cart_product_image
                            , cart_product_price: cart_product_price
                            , cart_product_qty: cart_product_qty
                            , product_inventory: product_inventory
                            , _token: _token
                        }
                        , success: function(data) {
                            swal({
                                    title: "Đã thêm sản phẩm vào giỏ hàng"
                                    , text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán"
                                    , icon: "warning"
                                    , showCancelButton: true
                                    , cancelButtonText: "Xem tiếp"
                                    , confirmButtonClass: "btn-success"
                                    , confirmButtonText: "Đi đến giỏ hàng"
                                    , closeOnConfirm: false
                                }
                                , function() {
                                    window.location.href = "{{url('/show-cart-ajax')}}";
                                });
                        }
                    });
                }
            });

            // Click Chọn Thành Phố các thứ****************************************************************************
            $('.choose').on('change', function() {
                var action = $(this).attr('id'); //hành động xem xét dựa vào id
                var value_id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = "";

                if (action == 'city_province_id') { // Khi chọn city thì district nhận giá trị VD: city Hồ Chí Minh thì có quận x, y, z
                    result = 'district_id';
                } else {
                    result = 'subdistrict_id';
                }
                $.ajax({
                    url: '{{url('/select-delivery')}}'
                    , method: 'POST'
                    , data: {
                        action: action
                        , value_id: value_id
                        , _token: _token
                    }
                    , success: function(data) {
                        $('#' + result).html(data);
                    }
                });
            });



            // SLider Product
            $('#imageGallery').lightSlider({
                gallery: true
                , item: 1
                , loop: true
                , thumbItem: 4
                , slideMargin: 5
                , enableDrag: false
                , currentPagerPosition: 'left'
                , onSliderLoad: function(el) {
                    el.lightGallery({
                        selector: '#imageGallery .lslide'
                    });
                }
            });
        });

    </script>

    {{-- -------------------------------------------------AutoComplete Search--------------------------------------------- --}}
    <script type="text/javascript">
        $('#keyword_search').keyup(function() {
            var query = $(this).val();
            if (query != '') {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{url('/autocomplete-search')}}'
                    , method: 'POST'
                    , data: {
                        query: query
                        , _token: _token
                    }
                    , success: function(data) {
                        $('#search_ajax').fadeIn();
                        $('#search_ajax').html(data);
                    }
                });
            } else {
                $('#search_ajax').fadeOut();
            }
        })

        $(document).on('click', '#li_search_ajax', function() {
            $('#keyword_search').val($(this).text());
            $('#search_ajax').fadeOut();
        });

    </script>

    <script type="text/javascript">
        $('.tab_brands').click(function() {
            var brand_id = $(this).data('brand_id');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{url('/tab-brands')}}'
                , method: 'POST'
                , data: {
                    brand_id: brand_id
                    , _token: _token
                }
                , success: function(data) {
                    $('#tab_products').html(data);
                }
            });

        })

    </script>

    {{-- Filter --}}
    <script type="text/javascript">
        $('#filter').on('change', function() {
            var url = $(this).val();
            if (url) {
                window.location = url;
            }
            return false;
        });

      
    </script>
</body>
</html>
