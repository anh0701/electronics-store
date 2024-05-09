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
<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>Danh mục sản phẩm</h2>
        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
            @foreach ($allDanhMuc as $key => $danhMuc)
            @if ($danhMuc->DanhMucCha == 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordian" href="#{{ $danhMuc->MaDanhMuc }}">
                                <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                            </a>
                            <a href="{{ route('/HienThiDanhMucCha', $danhMuc->MaDanhMuc) }}">{{ $danhMuc->TenDanhMuc }}</a>
                        </h4>
                    </div>
                    <div id="{{ $danhMuc->MaDanhMuc }}" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul>
                                @foreach ($allDanhMuc as $key => $valueDanhMuc)
                                    @if($valueDanhMuc->DanhMucCha == $danhMuc->MaDanhMuc)
                                    <li><a href="{{ route('/HienThiDanhMucCon', $valueDanhMuc->MaDanhMuc) }}">{{ $valueDanhMuc->TenDanhMuc }}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
            @endforeach
        </div><!--/category-products-->
    
        <div class="brands_products"><!--brands_products-->
            <h2>Thương hiệu sản phẩm</h2>
            <div class="brands-name">
                <ul class="nav nav-pills nav-stacked">
                    @foreach ($allThuongHieu as $key => $thuongHieu)
                        <li><a href="{{ route('/HienThiThuongHieu', $thuongHieu->MaThuongHieu) }}"><span class="pull-right"></span>{{ $thuongHieu->TenThuongHieu }}</a></li>
                    @endforeach									
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-9 padding-right">
    <div class="features_items">
        <h2 class="title text-center">Sản phẩm nổi bật</h2>
        @foreach ($sanPhamThuocDanhMuc as $key => $sanPham)
        <div class="col-sm-3">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <a href="{{ route('/ChiTietSanPham', $sanPham->MaSanPham) }}">
                            <img src="{{ asset('upload/SanPham/'.$sanPham->HinhAnh) }}" alt="" />
                            <h2>{{  number_format($sanPham->GiaSanPham,0,',','.').' đ'  }}</h2>
                            <p>{{ $sanPham->TenSanPham }}</p>
                        </a>
                        <a href="" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<div class="col-sm-12">
    <div class="recommended_items">
        <h2 class="title text-center">Chương trình giảm giá</h2>
        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
            <img src="{{ asset('frontend/images/shop/discount-program.gif') }}" style="margin-bottom: 15px; width: 100%" alt="">
            <div class="discount-program">
                <div class="col-sm-12">
                    {{-- <img src="{{ asset('frontend/images/shop/discount-program.gif') }}" alt=""> --}}
                </div>
            </div>
            <div class="carousel-inner">
                <div class="item active">	
                    <div class="col-sm-15 col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{ asset('frontend/images/home/acer-aspire-3-a315-58-589k-i5-nxam0sv008-thumb-600x60057.jpg') }}" alt="" />
                                    <h2>56.000 đ</h2>
                                    <p>Sản phẩm D</p>
                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-15 col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{ asset('frontend/images/home/acer-aspire-3-a315-58-589k-i5-nxam0sv008-thumb-600x60057.jpg') }}" alt="" />
                                    <h2>56.000 đ</h2>
                                    <p>Sản phẩm D</p>
                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-15 col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{ asset('frontend/images/home/acer-aspire-3-a315-58-589k-i5-nxam0sv008-thumb-600x60057.jpg') }}" alt="" />
                                    <h2>56.000 đ</h2>
                                    <p>Sản phẩm D</p>
                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-15 col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{ asset('frontend/images/home/acer-aspire-3-a315-58-589k-i5-nxam0sv008-thumb-600x60057.jpg') }}" alt="" />
                                    <h2>56.000 đ</h2>
                                    <p>Sản phẩm D</p>
                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-15 col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{ asset('frontend/images/home/acer-aspire-3-a315-58-589k-i5-nxam0sv008-thumb-600x60057.jpg') }}" alt="" />
                                    <h2>56.000 đ</h2>
                                    <p>Sản phẩm D</p>
                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-15 col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{ asset('frontend/images/home/acer-aspire-3-a315-58-589k-i5-nxam0sv008-thumb-600x60057.jpg') }}" alt="" />
                                    <h2>56.000 đ</h2>
                                    <p>Sản phẩm D</p>
                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-15 col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{ asset('frontend/images/home/acer-aspire-3-a315-58-589k-i5-nxam0sv008-thumb-600x60057.jpg') }}" alt="" />
                                    <h2>56.000 đ</h2>
                                    <p>Sản phẩm D</p>
                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-15 col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{ asset('frontend/images/home/acer-aspire-3-a315-58-589k-i5-nxam0sv008-thumb-600x60057.jpg') }}" alt="" />
                                    <h2>56.000 đ</h2>
                                    <p>Sản phẩm D</p>
                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-15 col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{ asset('frontend/images/home/camera-ip-360-do-3mp-tiandy-tc-h332n-thumb-2-600x60070.jpg') }}" alt="" />
                                    <h2>56.000 đ</h2>
                                    <p>Sản phẩm D</p>
                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-15 col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{ asset('frontend/images/home/camera-ip-ngoai-troi-360-do-3mp-tiandy-tc-h333n-thumb-1-600x60097.jpg') }}" alt="" />
                                    <h2>56.000 đ</h2>
                                    <p>Sản phẩm D</p>
                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
            </a>
            <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
            </a>			
        </div>
    </div>
</div>
@endsection