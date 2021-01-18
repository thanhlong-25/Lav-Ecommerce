<!DOCTYPE html>
<head>
    <title>DASHBOARD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }

    </script>
    <link rel="stylesheet" href="{{asset('public/backEnd/css/bootstrap.min.css')}}">
    <link href="{{asset('public/backEnd/css/style.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('public/backEnd/css/style-responsive.css')}}" rel="stylesheet" />
    <link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{asset('public/backEnd/css/font.css')}}" type="text/css" />
    <link href="{{asset('public/backEnd/css/font-awesome.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('public/backEnd/css/morris.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('public/backEnd/css/monthly.css')}}" type="text/css" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" type="text/css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="{{asset('public/frontEnd/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
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
                    MANAGER
                </a>
            </div>
            <!--logo end-->
            <div class="top-nav clearfix">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" onclick="myFunction()">
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
                        </a>
                        <ul id="dropdown-menu" class="dropdown-menu extended logout">
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
                                <span>USER</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('list-user')}}">List User</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-tasks"></i>
                                <span>CATEGORIES</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('list-category')}}">List Category</a></li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-tasks"></i>
                                <span>BRANDS</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('list-brand')}}">List Brands</a></li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-tasks"></i>
                                <span>PRODUCTS</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('list-product')}}">List Product</a></li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-tasks"></i>
                                <span>ORDERS</span> 
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('list-order')}}">Manage Order</a></li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-tasks"></i>
                                <span>COUPONS</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('list-coupon')}}">List Coupon</a></li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-tasks"></i>
                                <span>SLIDER BANNER</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('list-banner')}}">List Banner</a></li>
                            </ul>
                        </li>

                         <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-tasks"></i>
                                <span>COMMENT</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('list-comment')}}">List Comment</a></li>
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
    <script src="{{asset('public/frontEnd/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/backEnd/js/jquery.dcjqaccordion.2.7.js')}}"></script>
    <script src="{{asset('public/backEnd/js/scripts.js')}}"></script>
    <script src="{{asset('public/backEnd/js/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('public/backEnd/js/jquery.nicescroll.js')}}"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('public/backEnd/js/jquery.scrollTo.js')}}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('content_blog');

    </script>
    <script type='text/javascript'>
        function myFunction() {
            document.getElementById("dropdown-menu").classList.toggle("show");
        }
        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.dropdown')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }

    </script>
</body>

<script type="text/javascript">
    function ChangeToSlug() {
        var slug;

        //Lấy text từ thẻ input title 
        slug = document.getElementById("slug").value;
        slug = slug.toLowerCase();
        //Đổi ký tự có dấu thành không dấu
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
        //Xóa các ký tự đặt biệt
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        //Đổi khoảng trắng thành ký tự gạch ngang
        slug = slug.replace(/ /gi, "-");
        //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
        //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');
        //Xóa các ký tự gạch ngang ở đầu và cuối
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
        //In slug ra textbox có id “slug”
        document.getElementById('convert_slug').value = slug;
    }

</script>

<script type="text/javascript">
    $(document).ready(function() {
        // Lấy data ****************************************************************************
        fetch_delivery();

        function fetch_delivery() {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{url('/load-delivery-cost')}}'
                , method: 'POST'
                , data: {
                    _token: _token
                }
                , success: function(data) {
                    $('#load_delivery_cost').html(data); // nói chung là nó sẽ load dữ liệu vô cái id="load_devivery_cost"
                }
            });
        }
        // Update ********************************************************************************
        $(document).on('blur', '.shippingcost_edit', function() { // class shippingcost_id, "Blur" là khi click trong textedit sau đó click ra ngoài thì blur sẽ được gọi
            var id = $(this).data('shippingcost_id'); // data lấy trong data-shippingcost-id
            var cost = $(this).text(); // lấy giá trị trong text
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{url('/update-delivery-cost')}}'
                , method: 'POST'
                , data: {
                    id: id
                    , cost: cost
                    , _token: _token
                }
                , success: function(data) {
                    fetch_delivery();
                }
            });
        });
        // Click Chọn Thành Phố các thứ****************************************************************************
        $('.choose').on('change', function() {
            var action = $(this).attr('id'); //hành động xem xét dựa vào id
            var value_name = $(this).val();
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
                    , value_name
                    , value_name
                    , _token: _token
                }
                , success: function(data) {
                    $('#' + result).html(data);
                }
            });
        });

        // Cập nhật trạng thái đơn hàng
        $('#change_order_status').on('change', function() {
            var order_id = $('#order_id').val();
            var status = $(this).val();
            var _token = $('input[name="_token"]').val();
            order_quantity = [];
            // Lấy số lượng
            $("input[name='product_sales_quantity']").each(function() {
                order_quantity.push($(this).val());
            });
            // lấy id
            product_id = [];
            $("input[id='product_id']").each(function() {
                product_id.push($(this).val());
            });
            count = 0; // biến đếm số row không đạt chuẩn
            for (i = 0; i < product_id.length; i++) {
                var order_qty = order_quantity[i]; // số lượng sản phẩm trong order
                var product_inventory = $('#product_inventory_' + product_id[i]).val(); // số lượng trong kho
                if (parseInt(order_qty) > parseInt(product_inventory)) {
                    count += 1;
                    $('.row_status_' + product_id[i]).css('background', '#F0BCB4'); // đổi màu cho row không đạt chuẩn
                }
            }

            if (count == 0) {
                $.ajax({
                    url: '{{url('/update-order-status')}}'
                    , method: 'POST'
                    , data: {
                        order_id: order_id
                        , status: status
                        , order_quantity: order_quantity
                        , product_id: product_id
                        , _token: _token
                    }
                    , success: function(data) {
                        swal("Successfully!", "Order confirmation success!", "success").then((value) => {
                            location.reload();
                        });
                    }
                });
            } else {
                swal("Warning!", "Inventory is not available!", "error");
            }
        });
    })

</script>

{{-- Table --}}

{{-- Preview Image before upload --}}
<script>
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
</script>
</html>
