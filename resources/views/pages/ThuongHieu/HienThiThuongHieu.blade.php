@extends('layout')
@section('content')
<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>Danh mục sản phẩm</h2>
        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
            @foreach ($allDanhMuc as $key => $danhMuc)
                <div class="panel panel-default">
                    @if ($danhMuc->DanhMucCha == 0)
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a href="{{ route('/HienThiDanhMucCha', $danhMuc->MaDanhMuc) }}">{{ $danhMuc->TenDanhMuc }}</a>
                                <span class="badge pull-right">
                                    <a data-toggle="collapse" data-parent="#accordian" href="#{{ $danhMuc->MaDanhMuc }}">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </span>
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
                    @endif
                </div>
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
        </div><!--/brands_products-->
        
        <div class="price-range"><!--price-range-->
            <h2>Price Range</h2>
            <div class="well text-center">
                 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
                 <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
            </div>
        </div>
        <div class="shipping text-center">
            <img src="{{ asset('frontend/images/home/shipping.jpg') }}" alt="" />
        </div>
    </div>
</div>
<div class="col-sm-9 padding-right">
    <div class="features_items">
        <h2 class="title text-center">Sản phẩm nổi bật</h2>
        @foreach ($sanPhamThuocThuongHieu as $key => $sanPham)
        <div class="col-sm-3">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <a href="{{ route('/ChiTietSanPham', $sanPham->MaSanPham) }}">
                            <img src="{{ asset('upload/SanPham/'.$sanPham->HinhAnh) }}" alt="" />
                            <h2>{{  number_format($sanPham->GiaSanPham,0,',','.').' đ'  }}</h2>
                            <p>{{ $sanPham->TenSanPham }}</p>
                        </a>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
{{-- <div class="brands_products">
    <h2>Danh mục nổi bật</h2>
    <div class="category-tab">
        <div class="col-sm-12">
            <ul class="nav nav-tabs">
                @foreach ($allDanhMuc as $key => $danhMuc)
                    @if ($danhMuc->DanhMucCha == 0)
                        <li class="{{ $key+1==1 ? 'active' : '' }}"><a href="{{ $danhMuc->MaDanhMuc }}" data-toggle="tab">{{ $danhMuc->TenDanhMuc }}</a></li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
</div> --}}
    <div class="recommended_items">
        <h2 class="title text-center">Sản phẩm bán chạy</h2>
        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="item active">	
                    <div class="col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{ asset('frontend/images/home/recommend1.jpg') }}" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{ asset('frontend/images/home/recommend1.jpg') }}" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{ asset('frontend/images/home/recommend2.jpg') }}" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{ asset('frontend/images/home/recommend3.jpg') }}" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">	
                    <div class="col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{ asset('frontend/images/home/recommend1.jpg') }}" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{ asset('frontend/images/home/recommend2.jpg') }}" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{ asset('frontend/images/home/recommend3.jpg') }}" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
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