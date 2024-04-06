@extends('layout')
@section('content')
<section id="form">
	<div class="container">
		<div class="row">
			<div class="col-sm-4 col-sm-offset-1">
				<div class="login-form"><!--login form-->
					<h2>Đăng nhập tài khoản</h2>
					<form action="{{ route('/KhachHangDangNhap') }}" method="POST">
						{{ csrf_field() }}
						<input type="text" placeholder="Email" name="Email" value="{{ old('Email') }}" />
						<input type="password" placeholder="Password" name="MatKhau" />
						<span>
							<input type="checkbox" class="checkbox"> 
							Keep me signed in
						</span>
						<button type="submit" class="btn btn-default">Login</button>
					</form>
				</div><!--/login form-->
			</div>
			<div class="col-sm-1">
				<h2 class="or">OR</h2>
			</div>
			<div class="col-sm-4">
				<div class="signup-form"><!--sign up form-->
					<h2>Đăng ký tài khoản</h2>
					<form action="#">
						{{ csrf_field() }}
						<input type="text" placeholder="Name" name="TenTaiKhoan"/>
						<input type="email" placeholder="Email Address" name="Email"/>
						<input type="password" placeholder="Password" name="MatKhau"/>
						<input type="text" placeholder="Phone number" name="SoDienThoai"/>
						<button type="submit" class="btn btn-default">Signup</button>
					</form>
				</div><!--/sign up form-->
			</div>
		</div>
	</div>
</section>
@endsection