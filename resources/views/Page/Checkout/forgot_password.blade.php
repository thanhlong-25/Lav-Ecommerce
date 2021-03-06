@extends('welcome')
@section('content')
<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <h2 class="title text-center">Quên mật khẩu</h2>
				</ol>
			</div>
			
{{-- Session Message --}}
@if(session()->has('message'))
    <div class="alert alert-success">
    {{session() -> get('message')}}
    </div>
@elseif(session()->has('error'))
    <div class="alert alert-danger">
    {{session() -> get('error')}}
    </div>
@endif
<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-8 offset-2">
					<div class="login-form"><!--login form-->
						<h2>Điền số điện thoại đăng kí</h2>
						<form action="{{URL::to('recover-password')}}" method="post">
							{{csrf_field()}}
							<input type="number" name="phonenumber_recover_password" placeholder="Số điện thoại" />		
								<button type="submit" class="btn btn-default">Lấy lại mật khẩu</button>
						</form>
					</div><!--/login form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
@endsection