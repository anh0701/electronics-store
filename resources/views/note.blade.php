$data = $request->all();

echo '<pre>';
print_r($data);
echo '</pre>';

Route::get('/TrangLietKeBinhLuan', [DanhGiaController::class, 'TrangLietKeBinhLuan'])->name('/TrangLietKeBinhLuan');

<div class="row">
    <div class="bd-example">
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach($galleries as $value)
                    <li data-target="#carouselExampleCaptions" data-slide-to="'. $loop->index .'" class="'. $loop->first ? 'active' : '' .'"></li>
                @endforeach
            </ol>
            <div class="carousel-inner">
                @foreach($galleries->chunk(4) as $galleryCollection)
                    <div class="carousel-item '. $loop->first ? 'active' : '' .'">
                        @foreach ($galleryCollection as $gallery)
                            <div class="col-md-3">
                                <img src="'. asset('public/images/galleries/'.$gallery->image) .'" class="d-block w-100">
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>

<div class="col-sm-12">
    <div class="recommended_items">
        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
            <img src="'. asset('frontend/images/shop/discount-program.gif') .'" style="margin-bottom: 3px; width: 100%" alt="">
            <div class="discount-program">
                <div class="col-sm-12">
                    '.-- <img src="'. asset('frontend/images/shop/discount-program.gif') .'" alt=""> --.'
                </div>
            </div>
            <div class="carousel-inner">
                <div class="item active">	
                    <div class="col-sm-3 col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="'. asset('frontend/images/home/acer-aspire-3-a33-58-589k-i5-nxam0sv008-thumb-600x60057.jpg') .'" alt="" />
                                    <h2>56.000 đ</h2>
                                    <p>Sản phẩm D</p>
                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">	
                    <div class="col-sm-3 col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="'. asset('frontend/images/home/acer-aspire-3-a33-58-589k-i5-nxam0sv008-thumb-600x60057.jpg') .'" alt="" />
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

Route::get('/Test', [CTGiamGiaController::class, 'Test'])->name('/Test');

Route::get('/TrangThemCTGG', [CTGiamGiaController::class, 'TrangThemCTGG'])->name('/TrangThemCTGG');
Route::get('/TrangThemCTGGSP', [CTGiamGiaController::class, 'TrangThemCTGGSP'])->name('/TrangThemCTGGSP');
Route::post('/ThemCTGGVaoSession', [CTGiamGiaController::class, 'ThemCTGGVaoSession'])->name('/ThemCTGGVaoSession');
Route::post('/HienThiSanPham', [CTGiamGiaController::class, 'HienThiSanPham'])->name('/HienThiSanPham');
Route::get('/ThemSanPhamVaoSession/{MaSanPham}', [CTGiamGiaController::class, 'ThemSanPhamVaoSession'])->name('/ThemSanPhamVaoSession');
Route::get('/XoaSanPhamKhoiSession/{session_id}', [CTGiamGiaController::class, 'XoaSanPhamKhoiSession'])->name('/XoaSanPhamKhoiSession');
Route::post('/SuaPhanTramGiamSanPham/{session_id}', [CTGiamGiaController::class, 'SuaPhanTramGiamSanPham'])->name('/SuaPhanTramGiamSanPham');
Route::post('/ThemCTGG', [CTGiamGiaController::class, 'ThemCTGG'])->name('/ThemCTGG');

@foreach ($allSanPham as $key => $sanPham)
            @foreach ($allDanhMuc as $key => $danhMuc)
                @if ($danhMuc->DanhMucCha == $danhMucCha && $sanPham->DanhMuc->MaDanhMuc == $danhMuc->MaDanhMuc)
                <div class="col-sm-3">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <form>
                                    '. csrf_field() .'
                                    <input type="hidden" value="'. $sanPham->MaSanPham .'" class="cart_product_id_'. $sanPham->MaSanPham .'">
                                    <input type="hidden" value="'. $sanPham->TenSanPham .'" class="cart_product_name_'. $sanPham->MaSanPham .'">
                                    <input type="hidden" value="'. $sanPham->HinhAnh .'" class="cart_product_image_'. $sanPham->MaSanPham .'">
                                    <input type="hidden" value="'. $sanPham->GiaSanPham .'" class="cart_product_price_'. $sanPham->MaSanPham .'">
                                    <input type="hidden" value="'. $sanPham->ChieuCao .'" class="cart_product_height_'. $sanPham->MaSanPham .'">
                                    <input type="hidden" value="'. $sanPham->ChieuNgang .'" class="cart_product_width_'. $sanPham->MaSanPham .'">
                                    <input type="hidden" value="'. $sanPham->ChieuDay .'" class="cart_product_thick_'. $sanPham->MaSanPham .'">
                                    <input type="hidden" value="'. $sanPham->CanNang .'" class="cart_product_weight_'. $sanPham->MaSanPham .'">
                                    <input type="hidden" value="'. $sanPham->ThoiGianBaoHanh .'" class="cart_product_guarantee_'. $sanPham->MaSanPham .'">
                                    <input type="hidden" value="1" class="cart_product_qty_'. $sanPham->MaSanPham .'">
                                    <a href="'. route('/ChiTietSanPham', $sanPham->MaSanPham) .'">
                                        <img src="'. asset('upload/SanPham/'.$sanPham->HinhAnh) .'" alt="" />
                                        <p class="product-name">'. $sanPham->TenSanPham .'</p>
                                        <h2 class="">'.  number_format($sanPham->GiaSanPham,0,',','.').'₫'  .'</h2>
                                        <p class="vote-txt">
                                            @php
                                            $count = 0;
                                            $tongSoSao = 0;
                                                foreach($allDanhGia as $key => $danhGia){
                                                    if($danhGia->MaSanPham == $sanPham->MaSanPham){
                                                        $count++;
                                                        $tongSoSao += $danhGia->SoSao;
                                                    }
                                                }
                                            @endphp
                                            @php
                                                if($count > 0){
                                                $tongSoSao = $tongSoSao/$count
                                            @endphp
                                                <b>'. number_format($tongSoSao, 1); .'</b>
                                                <i style="color:#FFCC36; margin-right: 5px" class="fa fa-star fa-fw"></i>
                                                <b>('. $count .')</b>
                                            @php
                                                }elseif($count == 0){
                                            @endphp
                                                <b>0</b>
                                                <i style="color:#FFCC36; margin-right: 5px" class="fa fa-star fa-fw"></i>
                                                <b>(0)</b>
                                            @php
                                                }
                                            @endphp
                                        </p>
                                    </a>
                                    <button type="button" class="btn btn-default add-to-cart ThemGioHang" 
                                    data-id_product="'. $sanPham->MaSanPham .'">
                                        <i class="fa fa-shopping-cart"></i>Thêm giỏ hàng
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
            @if ($sanPham->MaDanhMuc == $danhMucCha)
                <div class="col-sm-3">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <form>
                                    '. csrf_field() .'
                                    <input type="hidden" value="'. $sanPham->MaSanPham .'" class="cart_product_id_'. $sanPham->MaSanPham .'">
                                    <input type="hidden" value="'. $sanPham->TenSanPham .'" class="cart_product_name_'. $sanPham->MaSanPham .'">
                                    <input type="hidden" value="'. $sanPham->HinhAnh .'" class="cart_product_image_'. $sanPham->MaSanPham .'">
                                    <input type="hidden" value="'. $sanPham->GiaSanPham .'" class="cart_product_price_'. $sanPham->MaSanPham .'">
                                    <input type="hidden" value="'. $sanPham->ChieuCao .'" class="cart_product_height_'. $sanPham->MaSanPham .'">
                                    <input type="hidden" value="'. $sanPham->ChieuNgang .'" class="cart_product_width_'. $sanPham->MaSanPham .'">
                                    <input type="hidden" value="'. $sanPham->ChieuDay .'" class="cart_product_thick_'. $sanPham->MaSanPham .'">
                                    <input type="hidden" value="'. $sanPham->CanNang .'" class="cart_product_weight_'. $sanPham->MaSanPham .'">
                                    <input type="hidden" value="'. $sanPham->ThoiGianBaoHanh .'" class="cart_product_guarantee_'. $sanPham->MaSanPham .'">
                                    <input type="hidden" value="1" class="cart_product_qty_'. $sanPham->MaSanPham .'">
                                    <a href="'. route('/ChiTietSanPham', $sanPham->MaSanPham) .'">
                                        <img src="'. asset('upload/SanPham/'.$sanPham->HinhAnh) .'" alt="" />
                                        <p class="product-name">'. $sanPham->TenSanPham .'</p>
                                        <h2 class="">'.  number_format($sanPham->GiaSanPham,0,',','.').'₫'  .'</h2>
                                        <p class="vote-txt">
                                            @php
                                            $count = 0;
                                            $tongSoSao = 0;
                                                foreach($allDanhGia as $key => $danhGia){
                                                    if($danhGia->MaSanPham == $sanPham->MaSanPham){
                                                        $count++;
                                                        $tongSoSao += $danhGia->SoSao;
                                                    }
                                                }
                                            @endphp
                                            @php
                                                if($count > 0){
                                                $tongSoSao = $tongSoSao/$count
                                            @endphp
                                                <b>'. number_format($tongSoSao, 1); .'</b>
                                                <i style="color:#FFCC36; margin-right: 5px" class="fa fa-star fa-fw"></i>
                                                <b>('. $count .')</b>
                                            @php
                                                }elseif($count == 0){
                                            @endphp
                                                <b>0</b>
                                                <i style="color:#FFCC36; margin-right: 5px" class="fa fa-star fa-fw"></i>
                                                <b>(0)</b>
                                            @php
                                                }
                                            @endphp
                                        </p>
                                    </a>
                                    <button type="button" class="btn btn-default add-to-cart ThemGioHang" 
                                    data-id_product="'. $sanPham->MaSanPham .'">
                                        <i class="fa fa-shopping-cart"></i>Thêm giỏ hàng
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach

        <p class="vote-txt">
            $count = 0;
            $tongSoSao = 0;
                foreach($allDanhGia as $key => $danhGia){
                    if($danhGia->MaSanPham == $sanPham->MaSanPham){
                        $count++;
                        $tongSoSao += $danhGia->SoSao;
                    }
                }
                if($count > 0){
                    $tongSoSao = $tongSoSao/$count
                    <b>'. number_format($tongSoSao, 1) .'</b>
                    <i style="color:#FFCC36; margin-right: 5px" class="fa fa-star fa-fw"></i>
                    <b>('. $count .')</b>
                }elseif($count == 0){
                    <b>0</b>
                    <i style="color:#FFCC36; margin-right: 5px" class="fa fa-star fa-fw"></i>
                    <b>(0)</b>
                }
        </p>

        <div class="col-sm-15">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <form>
                            {{ csrf_field() }}
                            <input type="hidden" value="{{ $sanPham->MaSanPham }}" class="cart_product_id_{{ $sanPham->MaSanPham }}">
                            <input type="hidden" value="{{ $sanPham->TenSanPham }}" class="cart_product_name_{{ $sanPham->MaSanPham }}">
                            <input type="hidden" value="{{ $sanPham->HinhAnh }}" class="cart_product_image_{{ $sanPham->MaSanPham }}">
                            <input type="hidden" value="{{ $sanPham->GiaSanPham }}" class="cart_product_price_{{ $sanPham->MaSanPham }}">
                            <input type="hidden" value="{{ $sanPham->ChieuCao }}" class="cart_product_height_{{ $sanPham->MaSanPham }}">
                            <input type="hidden" value="{{ $sanPham->ChieuNgang }}" class="cart_product_width_{{ $sanPham->MaSanPham }}">
                            <input type="hidden" value="{{ $sanPham->ChieuDay }}" class="cart_product_thick_{{ $sanPham->MaSanPham }}">
                            <input type="hidden" value="{{ $sanPham->CanNang }}" class="cart_product_weight_{{ $sanPham->MaSanPham }}">
                            <input type="hidden" value="{{ $sanPham->ThoiGianBaoHanh }}" class="cart_product_guarantee_{{ $sanPham->MaSanPham }}">
                            <input type="hidden" value="1" class="cart_product_qty_{{ $sanPham->MaSanPham }}">
                            <a href="{{ route('/ChiTietSanPham', $sanPham->MaSanPham) }}">
                                <img src="{{ asset('upload/SanPham/'.$sanPham->HinhAnh) }}" alt="" />
                                <p class="product-name">{{ $sanPham->TenSanPham }}</p>
                                <h2 class="">{{  number_format($sanPham->GiaSanPham,0,',','.').'₫'  }}</h2>
                                <p class="vote-txt">
                                    @php
                                    $count = 0;
                                    $tongSoSao = 0;
                                        foreach($allDanhGia as $key => $danhGia){
                                            if($danhGia->MaSanPham == $sanPham->MaSanPham){
                                                $count++;
                                                $tongSoSao += $danhGia->SoSao;
                                            }
                                        }
                                    @endphp
                                    @php
                                        if($count > 0){
                                        $tongSoSao = $tongSoSao/$count
                                    @endphp
                                        <b>{{ number_format($tongSoSao, 1); }}</b>
                                        <i style="color:#FFCC36; margin-right: 5px" class="fa fa-star fa-fw"></i>
                                        <b>({{ $count }})</b>
                                    @php
                                        }elseif($count == 0){
                                    @endphp
                                        <b>0</b>
                                        <i style="color:#FFCC36; margin-right: 5px" class="fa fa-star fa-fw"></i>
                                        <b>(0)</b>
                                    @php
                                        }
                                    @endphp
                                </p>
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