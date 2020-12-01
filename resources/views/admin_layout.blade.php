<!DOCTYPE html>
<head>
<title>DASHBOARD</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link rel="stylesheet" href="{{asset('public/backEnd/css/bootstrap.min.css')}}" >
<link href="{{asset('public/backEnd/css/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('public/backEnd/css/style-responsive.css')}}" rel="stylesheet"/>
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="{{asset('public/backEnd/css/font.css')}}" type="text/css"/>
<link href="{{asset('public/backEnd/css/font-awesome.css')}}" rel="stylesheet"> 
<link rel="stylesheet" href="{{asset('public/backEnd/css/morris.css')}}" type="text/css"/>
<link rel="stylesheet" href="{{asset('public/backEnd/css/monthly.css')}}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="{{asset('public/backEnd/js/jquery2.0.3.min.js')}}"></script>
<script src="{{asset('public/backEnd/js/raphael-min.js')}}"></script>
<script src="{{asset('public/backEnd/js/morris.js')}}"></script>
{{-- Jquery Validation --}}
</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="index.html" class="logo">
        ADMIN
    </a>
</div>
<!--logo end-->
<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li>
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="{{asset('public/backEnd/images/profile.jpg')}}">
                <span class="username">
	<!-- /############################################################################################################## -->
	<!-- /#####################################################PHP###################################################### -->
	<?php
		$name = Session::get('admin_name');
		if($name){
			echo $name;
		}
	?>
				</span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                <li><a href="{{URL::to('admin-logout')}}"><i class="fa fa-key"></i> Log Out</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
       
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="active" href="index.html">
                        <i class="fa fa-dashboard"></i>
                        <span>DASHBOARD</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-tasks"></i>
                        <span>CATEGORIES</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('add-category')}}">Add Category</a></li>
                        <li><a href="{{URL::to('list-category')}}">List Category</a></li>
                    </ul>
                </li>

				<li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-tasks"></i>
                        <span>BRANDS</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('add-brand')}}">Add Brands</a></li>
                        <li><a href="{{URL::to('list-brand')}}">List Brands</a></li>
                    </ul>
                </li>
                
				<li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-tasks"></i>
                        <span>PRODUCTS</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('add-product')}}">Add Product</a></li>
                        <li><a href="{{URL::to('list-product')}}">List Product</a></li>
                    </ul>
                </li>      
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-tasks"></i>
                        <span>ORDERS</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('manage-order')}}">Manage Order</a></li>
                        <li><a href="{{URL::to('list-order')}}">Test Order</a></li>
                    </ul>
                </li>  
                 <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-tasks"></i>
                        <span>COUPONS</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('add-coupon')}}">Insert Coupon</a></li>
                        <li><a href="{{URL::to('list-coupon')}}">List Coupon</a></li>
                    </ul>
                </li> 
                 <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-tasks"></i>
                        <span>SLIDER BANNER</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('add-banner')}}">Insert Banner</a></li>
                        <li><a href="{{URL::to('list-banner')}}">List Banner</a></li>
                    </ul>
                </li> 
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-tasks"></i>
                        <span>DELIVERY ADDRESS</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('delivery-address')}}">Delivery Address</a></li>
                    </ul>
                </li>       
            </ul>
            </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
	<!--#####################################################################################################################-->
	<!--#####################################################################################################################-->
    @yield('admin_content')
    </section>
  </section>
<!--main content end-->
</section>
<script src="{{asset('public/backEnd/js/bootstrap.js')}}"></script>
<script src="{{asset('public/backEnd/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('public/backEnd/js/scripts.js')}}"></script>
<script src="{{asset('public/backEnd/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('public/backEnd/js/jquery.nicescroll.js')}}"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{asset('public/backEnd/js/jquery.scrollTo.js')}}"></script>
<script src="{{asset('public/frontEnd/js/sweetalert.js')}}"></script>
{{-- JQUERY Validation --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script type='text/javascript'>
$(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("form[name='add_category_form']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      nameCategory: {required =  true, 
      minlength: 5
      },
      description_category: "required",
      minlength: 5
    },
    // Specify validation error messages
    messages: {
      name_category: "Please enter your firstname",
      description_category: "Please enter your lastname",
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  });
});
</script>
<!-- morris JavaScript -->	
<script>
	$(document).ready(function() {
		//BOX BUTTON SHOW AND CLOSE
	   jQuery('.small-graph-box').hover(function() {
		  jQuery(this).find('.box-button').fadeIn('fast');
	   }, function() {
		  jQuery(this).find('.box-button').fadeOut('fast');
	   });
	   jQuery('.small-graph-box .box-close').click(function() {
		  jQuery(this).closest('.small-graph-box').fadeOut(200);
		  return false;
	   });
	   
	    //CHARTS
	    function gd(year, day, month) {
			return new Date(year, month - 1, day).getTime();
		}
		
		graphArea2 = Morris.Area({
			element: 'hero-area',
			padding: 10,
        behaveLikeLine: true,
        gridEnabled: false,
        gridLineColor: '#dddddd',
        axes: true,
        resize: true,
        smooth:true,
        pointSize: 0,
        lineWidth: 0,
        fillOpacity:0.85,
			data: [
				{period: '2015 Q1', iphone: 2668, ipad: null, itouch: 2649},
				{period: '2015 Q2', iphone: 15780, ipad: 13799, itouch: 12051},
				{period: '2015 Q3', iphone: 12920, ipad: 10975, itouch: 9910},
				{period: '2015 Q4', iphone: 8770, ipad: 6600, itouch: 6695},
				{period: '2016 Q1', iphone: 10820, ipad: 10924, itouch: 12300},
				{period: '2016 Q2', iphone: 9680, ipad: 9010, itouch: 7891},
				{period: '2016 Q3', iphone: 4830, ipad: 3805, itouch: 1598},
				{period: '2016 Q4', iphone: 15083, ipad: 8977, itouch: 5185},
				{period: '2017 Q1', iphone: 10697, ipad: 4470, itouch: 2038},
			
			],
			lineColors:['#eb6f6f','#926383','#eb6f6f'],
			xkey: 'period',
            redraw: true,
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
			pointSize: 2,
			hideHover: 'auto',
			resize: true
		});
	});
</script>
</body>

<script type="text/javascript">
$(document).ready(function(){
// Lấy data ****************************************************************************
        fetch_delivery();
        function fetch_delivery(){
            var _token = $('input[name="_token"]').val(); 
            $.ajax({
                    url: '{{url('/load-delivery-cost')}}',
                        method: 'POST',
                        data: {_token:_token},
                        success:function(data){
                            $('#load_delivery_cost').html(data); // nói chung là nó sẽ load dữ liệu vô cái id="load_devivery_cost"
                        }	
                    });
                }
// Update ********************************************************************************
$(document).on('blur', '.shippingcost_edit', function(){    // class shippingcost_id, "Blur" là khi click trong textedit sau đó click ra ngoài thì blur sẽ được gọi
    var id = $(this).data('shippingcost_id');               // data lấy trong data-shippingcost-id
    var cost = $(this).text();                              // lấy giá trị trong text
    var _token = $('input[name="_token"]').val(); 
    $.ajax({
            url: '{{url('/update-delivery-cost')}}',
            method: 'POST',
            data: {
                id:id,
                cost:cost,
                _token:_token},
            success:function(data){
                fetch_delivery();
                }	
            });
    });

// Click thêm****************************************************************************
        $('#add_shippingcost').click( function(){
            var city = $('#city_province_id').val();
            var district = $('#district_id').val();
            var subdistrict = $('#subdistrict_id').val();
            var cost = $('#shippingcost').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                   url: '{{url('/add-cost')}}',
                    method: 'POST',
                    data:{
                        city:city, 
                        district:district,
                        subdistrict:subdistrict,
                        cost:cost,
                        _token:_token},
                    success:function(data){
                        alert('Insert Successfully!!!');
                        fetch_delivery();
    				    }	
                    });
                });

// Click Chọn Thành Phố các thứ****************************************************************************
            $('.choose').on('change', function(){
                var action = $(this).attr('id');    //hành động xem xét dựa vào id
                var value_name = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = "";

                if(action == 'city_province_id'){   // Khi chọn city thì district nhận giá trị VD: city Hồ Chí Minh thì có quận x, y, z
                    result = 'district_id';
                }else{
                    result = 'subdistrict_id';
                }
                $.ajax({
                   url: '{{url('/select-delivery')}}',
                    method: 'POST',
                    data:{
                        action:action, 
                        value_name,value_name,
                        _token:_token},
                    success:function(data){
                        $('#'+result).html(data);
    				    }	
                    });          
                });


            })
</script>
</html>
