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
    <div class="col-sm-12 padding-right">
        <div class="product-details">
            <div class="col-sm-5">
                <div class="view-product">
                    <img src="{{ asset('upload/SanPham/'.$chiTietSanPham->HinhAnh) }}" alt="" />
                    <h3>ZOOM</h3>
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
                    {{-- <img src="{{ asset('frontend/images/product-details/rating.png') }}" alt="" /> --}}
                    <span>
                        <span >{{  number_format($chiTietSanPham->GiaSanPham,0,',','.').' đ'  }}</span>
                        <label>Số lượng:</label>
                        <input type="text" value="3" />
                        <button type="button" class="btn btn-fefault cart">
                            <i class="fa fa-shopping-cart"></i>
                            Add to cart
                        </button>
                    </span>
                    <p><b>Availability:</b> In Stock</p>
                    <p><b>Condition:</b> New</p>
                    <p><b>Thương hiệu:</b> {{ $chiTietSanPham->ThuongHieu->TenThuongHieu }}</p>
                    <a href=""><img src="{{ asset('frontend/images/product-details/share.png') }}" class="share img-responsive"  alt="" /></a>
                </div>
            </div>
        </div>
        
        <div class="category-tab shop-details-tab"><!--category-tab-->
            <div class="col-sm-12">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#details" data-toggle="tab">Thông tin sản phẩm</a></li>
                    <li><a href="#companyprofile" data-toggle="tab">Sản phẩm liên quan</a></li>
                    <li><a href="#tag" data-toggle="tab">Thông số kỹ thuật</a></li>
                    <li><a href="#reviews" data-toggle="tab">Bình luận</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade active in" id="details" >
                    <div class="col-sm-12">
                        <span>
                            <p>{{ $chiTietSanPham->MoTa }}
                            </p>
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
                                    <img src="images/home/gallery4.jpg" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                </div>
                            </div>
                        </div>
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
</div>
@endsection
