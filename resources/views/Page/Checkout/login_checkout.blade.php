@extends('welcome')
@section('content')
<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <h2 class="title text-center">Tài khoản</h2>
				</ol>
			</div>
<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-5">
					<div class="login-form"><!--login form-->
						<h2>Đăng nhập</h2>
						<form action="{{URL::to('login-customer')}}" method="post">
							{{csrf_field()}}
							<input type="email" name="email_login" placeholder="Email" />
							<input type="password" name="password_login" placeholder="Mật khẩu" />
							<span>
								<input type="checkbox" class="checkbox"> 
								Nhớ mật khẩu?
							</span>						
								<button type="submit" class="btn btn-default">Đăng nhập</button>
								<span><a href="{{URL::to('forgot-password')}}">Quên mật khẩu?</a></span>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">Hoặc</h2>
				</div>
				<div class="col-sm-5">
					<div class="signup-form"><!--sign up form-->
						<h2>Đăng kí</h2>
						<form action="{{URL::to('register-customer')}}" method="post">
						{{csrf_field()}}
							<input type="text" maxlength="20" minlength="4" pattern="^[a-zA-Z]*$" required name="name_register" placeholder="Tên"/>
							<input type="email" name="email_register" placeholder="Email" required/>
                            <input type="phone" name="phone_register" placeholder="Số điện thoại" required/>
							<input type="password" name="password_register" placeholder="Mật khẩu" required/>
                            <input type="password" name="repassword_register" placeholder="Nhập lại mật khẩu"required />
							<button type="submit" class="btn btn-default">Đăng kí</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
@endsection