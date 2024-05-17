@extends('layout')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="review-payment">
            <h2>Giỏ hàng</h2>
        </div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {!! session()->get('message') !!}
            </div>
        @elseif (session()->has('error'))
            <div class="alert alert-danger">
                {!! session()->get('error') !!}
            </div>
        @endif
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Hình ảnh</td>
                        <td style="width: 25%" class="description">Tên sản phẩm</td>
                        <td class="price">Giá</td>
                        <td class="quantity">Số lượng</td>
                        <td class="total">Thành tiền</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $total = 0;
                    @endphp
                    @if (Session::get('cart') == true)
                        @foreach (Session::get('cart') as $key => $cart)
                        @php
                            $subtotal = $cart['GiaSanPham'] * $cart['SoLuong'];
                            $total += $subtotal;
                        @endphp
                        <tr>
                            <td class="HinhAnh">
                                <a href=""><img src="{{ asset('upload/SanPham/'.$cart['HinhAnh']) }}" style="width: 120px; height:90px" alt=""></a>
                            </td>
                            <td class="TenSanPham">
                                <h4><a href=""></a></h4>
                                <p>{{ $cart['TenSanPham'] }}</p>
                            </td>
                            <td class="GiaSanPham">
                                <p class="cart_total_price">{{ number_format($cart['GiaSanPham'], 0, '', '.') }} đ</p>
                            </td>
                            <td class="SoLuong">
                                <div class="cart_quantity_button">
                                    <a class="cart_quantity_up updateCartItem qtyPlus" 
                                    data-cartid="{{ $cart['session_id'] }}" data-qty="{{ $cart['SoLuong'] }}"> + </a>
                                    <input class="cart_quantity_input " type="text" name="quantity" 
                                    value="{{ $cart['SoLuong'] }}" autocomplete="off" size="2" 
                                    data-min="1" data-max="1000">
                                    <a class="cart_quantity_down updateCartItem qtyMinus" 
                                    data-cartid="{{ $cart['session_id'] }}" data-qty="{{ $cart['SoLuong'] }}"> - </a>
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">{{ number_format($subtotal, 0, '', '.') }} đ</p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" href="{{ route('/XoaSanPhamTrongGioHang', $cart['session_id']) }}"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>                            
                        @endforeach
                    @endif
                    <tr>
                        <td colspan="4"></td>
                        <td colspan="2">
                            <table class="table table-condensed total-result">
                                <tr>
                                    <td>Tiền của giỏ hàng</td>
                                    <td>{{ number_format($total, 0, '', '.') }} đ</td>
                                </tr>
                                <tr>
                                    <td>Tiền từ giảm giá</td>
                                    <td></td>
                                </tr>
                                <tr class="shipping-cost">
                                    <td>Tiền giao hàng</td>
                                    <td>
                                        @if (Session::get('fee'))
                                            {{ number_format(Session::get('fee'), 0,',','.') }} đ
                                        @elseif (!Session::get('fee'))
                                            0 đ
                                        @endif
                                    </td>										
                                </tr>
                                <tr>
                                    <td>Tổng tiền</td>
                                    <td><span>{{ number_format(Session::get('fee') + $total, 0,',','.') }}  đ</span></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="review-payment">
            <h2>Điền thông tin đặt hàng</h2>
        </div>
        <div class="shopper-informations">
            <div class="row">
                <div class="col-sm-3">
                    <div class="shopper-info">
                        <p>Thông tin người nhận hàng</p>
                        <form>
                            <input type="text" placeholder="Tên người nhận">
                            <input type="text" placeholder="Số điện thoại">
                            <input type="text" placeholder="Địa chỉ">
                        </form>
                        <a class="btn btn-primary" href="">Đặt hàng</a>
                    </div>
                </div>
                <div class="col-sm-6 clearfix">
                    <div class="bill-to">
                        <p>Phiếu giảm giá và tiền giao hàng</p>
                        <div class="form-one">
                            <form>
                                <input type="text" placeholder="Coupon code">
                            </form>
                            <a class="btn btn-primary" href="">Áp dụng mã giảm giá</a>
                            <a class="btn btn-primary" href="">Xóa mã giảm giá</a>
                        </div>
                        <div class="form-two">
                            <form>
                                {{ csrf_field() }}
                                <select name="MaThanhPho" id="MaThanhPho" class="ChonDiaDiem MaThanhPho">
                                    <option>-- Thành phố / Tỉnh --</option>
                                    @foreach ($allThanhPho as $key => $thanhPho)
                                        <option value="{{ $thanhPho->MaThanhPho }}" >{{ $thanhPho->TenThanhPho }}</option>
                                    @endforeach
                                </select>
                                <select name="MaQuanHuyen" id="MaQuanHuyen" class="ChonDiaDiem MaQuanHuyen">
                                    <option>-- Quận / Huyện --</option>
                                </select>
                                <select name="MaXaPhuong" id="MaXaPhuong" class="MaXaPhuong">
                                    <option>-- Xã / Phường --</option>
                                </select>
                            </form>
                            <a class="btn btn-primary TinhPhiGiaoHang" name="TinhPhiGiaoHang" >Tính tiền giao hàng</a>
                            <a class="btn btn-primary" href="{{ route('/XoaPhiGiaoHang') }}">Xóa tiền giao hàng</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="order-message">
                        <p>Ghi chú</p>
                        <textarea name="message"  placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea>
                        <label><input type="checkbox">Ghi chú trước khi nhận đơn hàng của bạn</label>
                    </div>	
                </div>					
            </div>
        </div>
        <div class="payment-options">
            
        </div>
    </div>
</section>
@endsection