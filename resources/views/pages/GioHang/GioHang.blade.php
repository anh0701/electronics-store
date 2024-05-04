@extends('layout')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
              <li class="active">Giỏ hàng</li>
            </ol>
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
                <form>
                    {{ csrf_field() }}
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
                                    <a class="cart_quantity_delete" href="{{ route('/xoa-sp-trong-gio-hang', $cart['session_id']) }}"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>                            
                            @endforeach
                        @else
                        @php
                            echo 'Chưa có sản phẩm nào ở giỏ hàng';
                        @endphp
                        @endif
                    </tbody>
                </form>
            </table>
        </div>
    </div>
</section>
<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>Bạn có muốn áp dụng mã giảm giá cho giỏ hàng ?</h3>
            <p>Hãy chọn mã giảm giá phù hợp với giỏ hàng của bạn</p>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="chose_area">
                    <ul class="user_info">
                        <li class="single_field zip-field">
                            <label>Nhập mã giảm giá:</label>
                            <input type="text" >
                        </li>
                    </ul>
                    <a class="btn btn-default update" href="">Tính mã giảm giả</a>
                    <a class="btn btn-default check_out" href="">Xóa mã giảm giá</a>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Tiền của giỏ hàng <span>{{ number_format($total, 0, '', '.') }} đ</span></li>
                        <li>Mã giảm giá <span>$2</span></li>
                        <li>Tổng tiền <span>$61</span></li>
                    </ul>
                        <a class="btn btn-default update" href="{{ route('/xoa-gio-hang') }}">Xóa giỏ hàng</a>
                        <a class="btn btn-default check_out" href="">Thanh toán</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection