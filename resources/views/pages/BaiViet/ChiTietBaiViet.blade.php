@extends('layout')
@section('slider')
<div class="col-sm-12">
    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
            <li data-target="#slider-carousel" data-slide-to="1"></li>
            <li data-target="#slider-carousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="item active">
                <div class="col-sm-6">
                    <h1><span>E</span>lectronic Shop</h1>
                    <h2>Nơi bán sản phẩm điện tử số 1 Việt Nam</h2>
                    <p>Luôn phục vụ tận tình quý khách mọi lúc mọi nơi</p>
                    <button type="button" class="btn btn-default get">Get it now</button>
                </div>
                <div class="col-sm-6">
                    <img src="{{ asset('frontend/images/home/vi-vn-may-giat-samsung-inverter-8kg-ww80t3020ww-sv-0139.jpg') }}" style="height: 400px; width: 315px" class="girl img-responsive" alt="" />
                </div>
            </div>
            <div class="item">
                <div class="col-sm-6">
                    <h1><span>E</span>lectronic Shop</h1>
                    <h2>Nơi bán sản phẩm điện tử số 1 Việt Nam</h2>
                    <p>Luôn phục vụ tận tình quý khách mọi lúc mọi nơi</p>
                    <button type="button" class="btn btn-default get">Get it now</button>
                </div>
                <div class="col-sm-6">
                    <img src="{{ asset('frontend/images/home/camera-ip-360-do-3mp-tiandy-tc-h332n-thumb-2-600x60070.jpg') }}" style="height: 400px; width: 315px" class="girl img-responsive" alt="" />
                </div>
            </div>
            <div class="item">
                <div class="col-sm-6">
                    <h1><span>E</span>lectronic Shop</h1>
                    <h2>Nơi bán sản phẩm điện tử số 1 Việt Nam</h2>
                    <p>Luôn phục vụ tận tình quý khách mọi lúc mọi nơi</p>
                    <button type="button" class="btn btn-default get">Get it now</button>
                </div>
                <div class="col-sm-6">
                    <img src="{{ asset('frontend/images/home/tai-nghe-bluetooth-airpods-pro-2-magsafe-charge-apple-mqd83-trang-090922-034128-600x600198.jpg') }}" style="height: 400px; width: 315px" class="girl img-responsive" alt="" />
                </div>
            </div>
        </div>
        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
            <i class="fa fa-angle-left"></i>
        </a>
        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
            <i class="fa fa-angle-right"></i>
        </a>
    </div>
</div>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-3">
            <div class="left-sidebar">
                <div class="brands_products">
                    <h2>Danh mục bài viết</h2>
                    <div class="brands-name">
                        <ul class="nav nav-pills nav-stacked">
                            @foreach ($allDanhMucBV as $key => $danhMucBV)
                            <li><a href="{{ route('/HienThiBaiVietTheoDMBV', $danhMucBV->MaDanhMucBV) }}"><span class="pull-right"></span>{{ $danhMucBV->TenDanhMucBV }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="blog-post-area">
                <h2 class="title text-center">Chi tiết bài viết {{ $baiViet->TenBaiViet }}</h2>
                <div class="single-blog-post">
                    <h3>{{ $baiViet->TenBaiViet }}</h3>
                    <span>
                        {!! $baiViet->MoTa !!}
                    </span>
                </div>
            </div>
            <div class="response-area">
                <div class="col-sm-12 comment-blog">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {!! session()->get('message') !!}
                        </div>
                    @elseif (session()->has('error'))
                        <div class="alert alert-danger">
                            {!! session()->get('error') !!}
                        </div>
                    @endif
                    <h2>Viết bình luận về bài viết</h2>
                    <form action="{{ route('/BinhLuan') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="MaBaiViet" value="{{ $baiViet->MaBaiViet }}" class="MaBaiViet_{{ $baiViet->MaBaiViet }}">
                        <textarea id="BinhLuanBaiViet"
                        class="NoiDung_{{ $baiViet->MaBaiViet }}" name="NoiDung"></textarea>
                        </textarea>
                        <button type="submit" name="ThemBinhLuan" class="btn btn-primary pull-right ThemBinhLuan" data-MaBaiViet="{{ $baiViet->MaBaiViet }}">
                            Bình luận
                        </button>
                    </form>
                </div>

{{--                binh luan--}}

                <div class="col-sm-12 comment-blog">
                    <h2>Bình luận về bài viết</h2>
                    <ul class="media-list">
                        @foreach ($allBinhLuan as $binhLuan)
                            @if ($binhLuan->PhanHoi == 0)
                                <li class="media" style="margin-bottom: 5%;">
                                    <a class="pull-left" href="#">
                                        @if(isset($binhLuan->TaiKhoan) && $binhLuan->TaiKhoan->HinhAnh)
                                            <img class="media-object" src="{{ asset('upload/TaiKhoan/'.$binhLuan->TaiKhoan->HinhAnh) }}" alt="Ảnh đại diện" style="width: 64px; height: 64px;">
                                        @else
                                            <img class="media-object" src="{{ asset('upload/Profile/default.jpg') }}" alt="Ảnh đại diện" style="width: 64px; height: 64px;">
                                        @endif
                                    </a>
                                    <div class="media-body">
                                        <ul class="single-post-meta">
                                            <li><i class="fa fa-user"></i>{{ isset($binhLuan->TaiKhoan) ? $binhLuan->TaiKhoan->TenTaiKhoan : 'Người dùng ẩn danh' }}</li>
                                            <li><i class="fa fa-calendar"></i>{{ date("d M Y", strtotime($binhLuan->ThoiGianTao)) }}</li>
                                        </ul>
                                        <p>{{ $binhLuan->NoiDung }}</p>

                                        <!-- Hiển thị các phản hồi -->
                                        <ul class="media-list" style="margin-left: 20%;">
                                            @foreach ($binhLuan->phanHoi as $phanHoi)
                                                <li class="media" style="display: flex; justify-content: {{ isset($phanHoi->TaiKhoan) && $phanHoi->TaiKhoan->Quyen == 'Nhân viên bán hàng' ? 'flex-end' : 'flex-start' }}; margin-bottom: 10px;">
                                                    @if(isset($phanHoi->TaiKhoan) && $phanHoi->TaiKhoan->Quyen == 'Nhân viên bán hàng')
                                                        <div class="media-body" style="text-align: right;">
                                                            <ul class="single-post-meta">
                                                                <li><i class="fa fa-user"></i>{{ $phanHoi->TaiKhoan ? $phanHoi->TaiKhoan->TenTaiKhoan : 'Người dùng ẩn danh' }}</li>
                                                                <li><i class="fa fa-calendar"></i>{{ date("d M Y", strtotime($phanHoi->ThoiGianTao)) }}</li>
                                                            </ul>
                                                            <p style="background-color: #f0f0f0; padding: 10px; border-radius: 5px;">{{ $phanHoi->NoiDung }}</p>
                                                        </div>
                                                        <a class="pull-right" href="#">
                                                            @if($phanHoi->TaiKhoan && $phanHoi->TaiKhoan->HinhAnh)
                                                                <img class="media-object" src="{{ asset('upload/TaiKhoan/'.$phanHoi->TaiKhoan->HinhAnh) }}" alt="Ảnh đại diện" style="width: 48px; height: 48px;">
                                                            @else
                                                                <img class="media-object" src="{{ asset('upload/Profile/default.jpg') }}" alt="Ảnh đại diện" style="width: 48px; height: 48px;">
                                                            @endif
                                                        </a>
                                                    @else
                                                        <a class="pull-left" href="#">
                                                            @if($phanHoi->TaiKhoan && $phanHoi->TaiKhoan->HinhAnh)
                                                                <img class="media-object" src="{{ asset('upload/TaiKhoan/'.$phanHoi->TaiKhoan->HinhAnh) }}" alt="Ảnh đại diện" style="width: 48px; height: 48px;">
                                                            @else
                                                                <img class="media-object" src="{{ asset('upload/Profile/default.jpg') }}" alt="Ảnh đại diện" style="width: 48px; height: 48px;">
                                                            @endif
                                                        </a>
                                                        <div class="media-body">
                                                            <ul class="single-post-meta">
                                                                <li><i class="fa fa-user"></i>{{ isset($phanHoi->TaiKhoan) ? $phanHoi->TaiKhoan->TenTaiKhoan : 'Người dùng ẩn danh' }}</li>
                                                                <li><i class="fa fa-calendar"></i>{{ date("d M Y", strtotime($phanHoi->ThoiGianTao)) }}</li>
                                                            </ul>
                                                            <p style="background-color: #f0f0f0; padding: 10px; border-radius: 5px;">{{ $phanHoi->NoiDung }}</p>
                                                        </div>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>

                                        <!-- Form để phản hồi bình luận -->
                                        <form action="{{ route('them_phan_hoi') }}" method="POST" style="margin-top: 10px; text-align: right;">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="MaBaiViet" value="{{ $baiViet->MaBaiViet }}">
                                            <input type="hidden" name="MaBinhLuan" value="{{ $binhLuan->MaBinhLuan }}">
                                            <textarea class="form-control" name="NoiDungPhanHoi" placeholder="Nhập phản hồi..." style="width: 70%; float: right; margin-bottom: 10px;"></textarea>
                                            <button type="submit" class="btn btn-primary pull-right">Phản hồi</button>
                                        </form>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>

                <style>
                    .media-body {
                        position: relative;
                    }
                    .media-body .single-post-meta {
                        list-style: none;
                        padding: 0;
                        margin: 0 0 10px 0;
                        color: #999;
                    }
                    .media-body .single-post-meta li {
                        display: inline;
                        margin-right: 10px;
                    }
                    .media-body p {
                        margin: 0 0 10px;
                    }
                    .media-object {
                        border-radius: 50%;
                    }
                    .form-control {
                        resize: none;
                    }
                </style>






            </div>
        </div>
    </div>
</div>
@endsection
@section('js-custom')
    <script>
        ClassicEditor
        .create(document.querySelector('#MoTa'))
        .catch(error => {
            console.error(error);
        })
    </script>
@endsection
