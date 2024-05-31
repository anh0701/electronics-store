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
                    <li data-target="#carouselExampleCaptions" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                @endforeach
            </ol>
            <div class="carousel-inner">
                @foreach($galleries->chunk(4) as $galleryCollection)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        @foreach ($galleryCollection as $gallery)
                            <div class="col-md-3">
                                <img src="{{ asset('public/images/galleries/'.$gallery->image) }}" class="d-block w-100">
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
                </div>
                <div class="item">	
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

if($TySo <= 1){
    $TienVanChuyen = 0;
}elseif ($TySo > 1 && $TySo <= 5){
    $TienVanChuyen = $TySo * 2500;
}elseif ($TySo > 5 && $TySo <= 10){
    $TienVanChuyen = $TySo * 3000;
}elseif ($TySo > 10){
    $TienVanChuyen = $TySo * 4000;
}
