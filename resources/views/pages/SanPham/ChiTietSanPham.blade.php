@extends('layout')
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
                            <a href="">{{ $danhMuc->TenDanhMuc }}</a>
                        </h4>
                    </div>
                    <div id="{{ $danhMuc->MaDanhMuc }}" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul>
                                @foreach ($allDanhMuc as $key => $chiTietSanPhamDanhMuc)
                                    @if($chiTietSanPhamDanhMuc->DanhMucCha == $danhMuc->MaDanhMuc)
                                    <li><a href="{{ route('/HienThiDanhMucCon', $chiTietSanPhamDanhMuc->MaDanhMuc) }}">{{ $chiTietSanPhamDanhMuc->TenDanhMuc }}</a></li>
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
        </div><!--/brands_products-->
    </div>
</div>
<div class="col-sm-9 padding-right">
    <div class="col-sm-12 padding-right">
        <div class="product-details">
            <div class="col-sm-5">
                <div class="view-product">
                    <img src="{{ asset('upload/SanPham/'.$chiTietSanPham->HinhAnh) }}" alt="" />
                </div>
                <div id="similar-product" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="item active">
                            <a href=""><img src="{{ asset('frontend/images/product-details/similar1.jpg') }}" alt=""></a>
                            <a href=""><img src="{{ asset('frontend/images/product-details/similar2.jpg') }}" alt=""></a>
                            <a href=""><img src="{{ asset('frontend/images/product-details/similar3.jpg') }}" alt=""></a>
                        </div>
                        <div class="item">
                            <a href=""><img src="{{ asset('frontend/images/product-details/similar1.jpg') }}" alt=""></a>
                            <a href=""><img src="{{ asset('frontend/images/product-details/similar2.jpg') }}" alt=""></a>
                            <a href=""><img src="{{ asset('frontend/images/product-details/similar3.jpg') }}" alt=""></a>
                        </div>
                        <div class="item">
                            <a href=""><img src="{{ asset('frontend/images/product-details/similar1.jpg') }}" alt=""></a>
                            <a href=""><img src="{{ asset('frontend/images/product-details/similar2.jpg') }}" alt=""></a>
                            <a href=""><img src="{{ asset('frontend/images/product-details/similar3.jpg') }}" alt=""></a>
                        </div>
                    </div>
                    <a class="left item-control" href="#similar-product" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="right item-control" href="#similar-product" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
            <div class="col-sm-7">
                <div class="product-information">
                    <img src="{{ asset('frontend/images/product-details/new.jpg') }}" class="newarrival" alt="" />
                    <h2>{{ $chiTietSanPham->TenSanPham }}</h2>
                    <p>Mã sản phẩm: {{ $chiTietSanPham->MaSanPham }}</p>
                    <img src="images/product-details/rating.png" alt="" />
                    <form>
                        <input type="hidden" value="{{$chiTietSanPham->MaSanPham}}" class="cart_product_id_{{$chiTietSanPham->MaSanPham}}">
                        <input type="hidden" value="{{$chiTietSanPham->TenSanPham}}" class="cart_product_name_{{$chiTietSanPham->MaSanPham}}">
                        <input type="hidden" value="{{$chiTietSanPham->HinhAnh}}" class="cart_product_image_{{$chiTietSanPham->MaSanPham}}">
                        <input type="hidden" value="{{$chiTietSanPham->GiaSanPham}}" class="cart_product_price_{{$chiTietSanPham->MaSanPham}}">
                        <span>
                            <span>{{number_format($chiTietSanPham->GiaSanPham,0,',','.').' đ'}}</span>
                            <label>Số lượng:</label>
                            <input name="qty" type="number" min="1" class="cart_product_qty_{{$chiTietSanPham->MaSanPham}}" value="1"/>
                            <input name="productid_hidden" type="hidden"  value="{{$chiTietSanPham->MaSanPham}}" />
                        </span>
                        <input type="button" value="Thêm giỏ hàng" class="btn btn-primary cart btn-sm add-to-cart ThemGioHang" 
                        data-id_product="{{$chiTietSanPham->MaSanPham}}">
                    </form>
                    <p><b>Còn hàng:</b> Tại cửa hàng</p>
                    <p><b>Tình trạng:</b> Mới</p>
                    <p><b>Thương hiệu:</b> {{ $chiTietSanPham->ThuongHieu->TenThuongHieu }}</p>
                    <p><b>Danh mục:</b> {{ $chiTietSanPham->DanhMuc->TenDanhMuc }}</p>
                </div>
            </div>
        </div>
        
        <div class="category-tab shop-details-tab"><!--category-tab-->
            <div class="col-sm-12">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#details" data-toggle="tab">Thông tin sản phẩm</a></li>
                    <li><a href="#companyprofile" data-toggle="tab">Sản phẩm liên quan</a></li>
                    <li><a href="#tag" data-toggle="tab">Thông số kỹ thuật</a></li>
                    <li><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade active in" id="details" >
                    <div class="col-sm-12">
                        <span>
                            {{-- <textarea name="" id="MoTa" cols="30" rows="10">{{ $chiTietSanPham->MoTa }}</textarea> --}}
                            <p>{{ $chiTietSanPham->MoTa }}</p>
                        </span>
                    </div>
                </div>
                <div class="tab-pane fade" id="companyprofile" >
                    <div class="col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="images/home/gallery1.jpg" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="images/home/gallery3.jpg" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="images/home/gallery2.jpg" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="images/home/gallery4.jpg" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="tab-pane fade" id="tag" >
                    <div class="col-sm-12">
                        <span>
                            Thông số kỹ thuật {{ $chiTietSanPham->TenSanPham }}
                        </span>
                    </div>
                </div>
                <div class="tab-pane fade" id="reviews" >
                    <div class="col-sm-12">
                        <ul>
                            <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                            <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                            <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                        </ul>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                        <p><b>Write Your Review</b></p>
                        <form action="#">
                            <span>
                                <input type="text" placeholder="Your Name"/>
                                <input type="email" placeholder="Email Address"/>
                            </span>
                            <textarea name="" ></textarea>
                            <b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
                            <button type="button" class="btn btn-default pull-right">
                                Submit
                            </button>
                        </form>
                    </div>
                </div>
                
            </div>
        </div><!--/category-tab-->
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
