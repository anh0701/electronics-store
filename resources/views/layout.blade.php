<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/animate.css') }}" rel="stylesheet">
	<link href="{{ asset('frontend/css/main.css') }}" rel="stylesheet">
	<link href="{{ asset('frontend/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/sweetalert.css') }}" rel="stylesheet" >
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">      
    <link rel="shortcut icon" href="{{ asset('frontend/images/ico/favicon.ico') }}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('frontend/images/ico/apple-touch-icon-144-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('frontend/images/ico/apple-touch-icon-114-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('frontend/images/ico/apple-touch-icon-72-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('frontend/images/ico/apple-touch-icon-57-precomposed.png') }}">
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
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
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-3">
						<div class="logo pull-left">
							<a href="{{ route('/') }}"><img src="{{ asset('frontend/images/home/logo.png') }}" alt="" /></a>
						</div>
						<div class="btn-group pull-right">
							<div class="btn-group">
							</div>
							<div class="btn-group">
							</div>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-user"></i> Account</a></li>
								<li><a href="{{ route('/ThanhToan') }}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
								{{-- <li><a href="{{ route('/GioHang') }}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li> --}}
								{{-- Đăng xuất/ Đăng nhập --}}								
								@php
									$maTaiKhoan = Session::get('MaTaiKhoan');
									$isAdmin = Session::get('isAdmin');
									if($maTaiKhoan != ''){
								@endphp
									<li><a href="{{ route('/KhachHangDangXuat') }}"><i class="fa fa-lock"></i> Đăng xuất</a></li>
								@php
									}else{
								@endphp
									<li><a href="{{ route('/TrangKhachHangDangNhap') }}"><i class="fa fa-lock"></i> Đăng nhập</a></li>
								@php
									}
								@endphp		
								{{-- Trang admin --}}	
								@php
									if($isAdmin != '' && $isAdmin != '1'){
								@endphp
									<li class=""><a href="{{ route('/dashboard') }}"><i class="fa fa-users"></i> Admin</a></li>
								@php
									}else{
								@endphp
									<li class="hidden"><a href="{{ route('/dashboard') }}"><i class="fa fa-users"></i> Admin</a></li>
								@php
									}
								@endphp
								
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
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
								<li><a href="{{ route('/') }}" class="active">Home</a></li>
								<li class="dropdown"><a href="#">Danh mục<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="blog.html">Blog List</a></li>
										<li><a href="blog-single.html">Blog Single</a></li>
                                    </ul>
                                </li>
								<li class="dropdown"><a href="#">Bài viết<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="blog.html">Blog List</a></li>
										<li><a href="blog-single.html">Blog Single</a></li>
                                    </ul>
                                </li>
							</ul>
						</div>
					</div>
					<div class="col-sm-4">
						<form action="{{ route('/TimKiem') }}" method="GET">
							{{ csrf_field() }}
							<div class="search_box pull-right">
								<input type="text" name="keywords_submit" placeholder="Tìm kiếm"/>
								<input style="width: 50px" type="submit" name="search_items" class="btn btn-success btn-sm" value="Tìm">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
	
	<section id="slider">
		<div class="container">
			<div class="row">
				@yield('slider')
			</div>
		</div>
	</section>
	
	<section>
		<div class="container">
			<div class="row">
				@yield('content')
			</div>
		</div>
	</section>
	
	<footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><span>E</span>-lectronic</h2>
							<p>Luôn phục vụ mọi lúc mọi nơi</p>
						</div>
					</div>
					{{-- <div class="col-sm-7">
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{ asset('frontend/images/home/iframe1.png') }}" alt="" />
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
										<img src="{{ asset('frontend/images/home/iframe2.png') }}" alt="" />
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
										<img src="{{ asset('frontend/images/home/') }}" alt="" />
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
										<img src="{{ asset('frontend/images/home/') }}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
					</div> --}}
					{{-- <div class="col-sm-3">
						<div class="address">
							<img src="{{ asset('frontend/images/home/map.png') }}" alt="" />
							<p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
						</div>
					</div> --}}
				</div>
			</div>
		</div>
		
		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-3">
						<div class="single-widget">
							<h2>Liên hệ</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Trợ giúp khách hàng</a></li>
								<li><a href="#">Số điện thoại</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="single-widget">
							<h2>Sản phẩm chính</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Laptop</a></li>
								<li><a href="#">Máy lạnh</a></li>
								<li><a href="#">Tivi</a></li>
								<li><a href="#">Quạt</a></li>
								<li><a href="#">Điều hòa</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="single-widget">
							<h2>Chính sách</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Chính sách bảo hành</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="single-widget">
							<h2>Thông tin về cửa hàng</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Thông tin công ty</a></li>
								<li><a href="#">Địa chỉ</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Thực tập tốt nghiệp</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="#">Nhóm 59</a></span></p>
				</div>
			</div>
		</div>
	</footer><!--/Footer-->

    <script src="{{ asset('frontend/js/jquery.js') }}"></script>
	<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('frontend/js/jquery.scrollUp.min.js') }}"></script>
	<script src="{{ asset('frontend/js/price-range.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
	<script src="{{ asset('frontend/js/sweetalert.min.js') }}"></script>
	{{-- Create cart --}}
	<script type="text/javascript">
		$(document).ready(function(){
			$('.ThemGioHang').click(function(){
				var id = $(this).data('id_product');
				var cart_product_id = $('.cart_product_id_' + id).val();
				var cart_product_name = $('.cart_product_name_' + id).val();
				var cart_product_image = $('.cart_product_image_' + id).val();
				var cart_product_price = $('.cart_product_price_' + id).val();
				var cart_product_qty = $('.cart_product_qty_' + id).val();
				var _token = $('input[name="_token"]').val();
				
				$.ajax({
					url: '{{ route('/them-gio-hang') }}',
					method: 'POST',
					data:{
						cart_product_id:cart_product_id, 
						cart_product_name:cart_product_name,
						cart_product_image:cart_product_image, 
						cart_product_price:cart_product_price,
						cart_product_qty:cart_product_qty, 
						_token:_token
					},
					success:function(data){
						swal({
							title: "Đã thêm sản phẩm vào giỏ hàng",
							text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
							
							showCancelButton: true,
							cancelButtonText: "Xem tiếp",
							confirmButtonClass: "btn-success",
							confirmButtonText: "Đi đến giỏ hàng",
							closeOnConfirm: false
							},
						function() {
							window.location.href = "{{ route('/hien-thi-gio-hang') }}";
						});
					}
				});
			});
		});
	</script>
	{{-- Update cart Item --}}
	<script type="text/javascript">
		$(document).on('click', '.updateCartItem', function(){
			if($(this).hasClass('qtyPlus')){
				var quantity = $(this).data('qty');
				new_qty = parseInt(quantity)+1;
			}
			if($(this).hasClass('qtyMinus')){
				var quantity = $(this).data('qty');
				if(quantity<=1){
					alert("Item quantity must be 1 or greater!");
					return false;
				}
				new_qty = parseInt(quantity)-1;
			}
			var cartid = $(this).data('cartid');
			var _token = $('input[name="_token"]').val();
			$.ajax({
				url: '{{ route('/thay-doi-so-luong') }}',
				method: 'POST',
				data:{
					cartid:cartid,
					qty:new_qty,
					_token:_token
				},
				success:function(data){
					location.reload();
				}
			});
		});
	</script>
</body>
</html>