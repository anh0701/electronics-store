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
    </div>
</div>
<div class="col-sm-9 padding-right">
    <div class="mainmenu pull-left">
        <h2 class="title text-center">Bộ lọc</h2>
        <ul class="nav navbar-nav collapse navbar-collapse">
            <li class="dropdown"><a href="#">Bộ lọc<i class="fa fa-angle-down"></i></a>
                <ul role="menu" class="sub-menu">
                    <li class="pull-left"><a href="#">Giá thấp đến cao</a></li>
                    <li class="pull-left"><a href="#">Giá cao đến thấy</a></li>
                    <li class="pull-left"><a href="#">Bán chạy</a></li>
                    <li class="pull-left"><a href="#">Giảm theo %</a></li>
                </ul>
            </li>
            <li class="dropdown"><a href="#">Hãng<i class="fa fa-angle-down"></i></a>
                <ul role="menu" class="sub-menu">
                    @foreach ($allTHDM as $key => $valueTHDM)
                    <li class="col-sm-15 col-sm-3"><a href=""><img src="{{ asset('upload/ThuongHieu/'.$valueTHDM->ThuongHieu->HinhAnh) }}" alt=""></a></li>
                    @endforeach
                </ul>
            </li>
            @foreach ($allDanhMucTSKT as $key => $valueDanhMucTSKT)
            <li class="dropdown"><a href="#">{{ $valueDanhMucTSKT->TenDMTSKT }}<i class="fa fa-angle-down"></i></a>
                <ul role="menu" class="sub-menu">
                    @foreach ($allTSKT as $key => $valueTSKT)
                        @if ($valueTSKT->MaDMTSKT == $valueDanhMucTSKT->MaDMTSKT)
                            <li class="pull-left"><a href="#">{{ $valueTSKT->TenTSKT }}</a></li>
                        @endif
                    @endforeach
                </ul>
            </li>
            @endforeach
        </ul>
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
                        <form>
                            {{ csrf_field() }}
                            <input type="hidden" value="{{ $sanPham->MaSanPham }}" class="cart_product_id_{{ $sanPham->MaSanPham }}">
                            <input type="hidden" value="{{ $sanPham->TenSanPham }}" class="cart_product_name_{{ $sanPham->MaSanPham }}">
                            <input type="hidden" value="{{ $sanPham->HinhAnh }}" class="cart_product_image_{{ $sanPham->MaSanPham }}">
                            <input type="hidden" value="{{ $sanPham->GiaSanPham }}" class="cart_product_price_{{ $sanPham->MaSanPham }}">
                            <input type="hidden" value="1" class="cart_product_qty_{{ $sanPham->MaSanPham }}">
                            <a href="{{ route('/ChiTietSanPham', $sanPham->MaSanPham) }}">
                                <img src="{{ asset('upload/SanPham/'.$sanPham->HinhAnh) }}" alt="" />
                                <h2>{{  number_format($sanPham->GiaSanPham,0,',','.').' đ'  }}</h2>
                                <p>{{ $sanPham->TenSanPham }}</p>
                            </a>
                            <button type="button" class="btn btn-default add-to-cart ThemGioHang" 
                            data-id_product="{{ $sanPham->MaSanPham }}">
                                <i class="fa fa-shopping-cart"></i>Thêm giỏ hàng
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<div class="col-sm-12">
    <div class="recommended_items">
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