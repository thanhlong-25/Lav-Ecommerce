<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<head>
<title>MANAGER - REGISTER</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="{{asset('public/backEnd/css/bootstrap.min.css')}}" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->

<link href="{{asset('public/backEnd/css/style.css')}}" rel='stylesheet' type='text/css'/>
<link href="{{asset('public/backEnd/css/style-responsive.css')}}" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{asset('public/backEnd/css/font.css')}}" type="text/css"/>
<link href="{{asset('public/backEnd/css/font-awesome.css')}}" rel="stylesheet"> 
<!-- //font-awesome icons -->
<script src="{{asset('public/backEnd/js/jquery2.0.3.min.js')}}"></script>
</head>
<body>
<div class="log-w3">
<div class="w3layouts-main">
	<h2>REGISTER</h2>
	<!-- /############################################################################################################## -->
	<!-- /#####################################################PHP###################################################### -->
@if(session()->has('message'))
    <div class="alert alert-success">
    {{session() -> get('message')}}
    </div>
@elseif(session()->has('error'))
    <div class="alert alert-danger">
    {{session() -> get('error')}}
    </div>
@endif
		<form action="{{URL::to('/admin-register')}}" method="post">
		{{ csrf_field() }}
		@foreach($errors->all() as $value)
			<div class="alert alert-danger">{{$value}}</div>
		@endforeach
			<input type="text" class="ggg" name="admin_name" placeholder="NAME" value="{{old('admin_name')}}">
			<input type="number" class="ggg" name="admin_phone" placeholder="PHONE NUMBER" value="{{old('admin_phone')}}">
			<input type="text" class="ggg" name="admin_email" placeholder="E-MAIL" value="{{old('admin_email')}}">
			<input type="password" class="ggg" name="admin_password" placeholder="PASSWORD" value="">
			<input type="password" class="ggg" name="admin_repassword" placeholder="RE-PASSWORD" value="">
		
			<input type="submit" value="Register" name="login">
		</form>
		<p>Already have an Account ?<a href="{{URL::to('/admin')}}">Login</a></p>

</div>
</div>
<script src="{{asset('public/backEnd/js/bootstrap.js')}}"></script>
<script src="{{asset('public/backEnd/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('public/backEnd/js/scripts.js')}}"></script>
<script src="{{asset('public/backEnd/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('public/backEnd/js/jquery.nicescroll.js')}}"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{asset('public/backEnd/js/jquery.scrollTo.js')}}"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>
</html>
