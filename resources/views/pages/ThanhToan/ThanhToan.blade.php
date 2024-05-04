@extends('layout')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="review-payment">
            <h2>Giỏ hàng</h2>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="{{ asset('frontend/images/home/tai-nghe-bluetooth-airpods-pro-2-magsafe-charge-apple-mqd83-trang-090922-034128-600x600198.jpg') }}" style="width: 100px; height:70px" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">Sản phẩm B</a></h4>
                            <p>Web ID: 1089772</p>
                        </td>
                        <td class="cart_price">
                            <p>59.000 đ</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <a class="cart_quantity_up" href=""> + </a>
                                <input class="cart_quantity_input" type="text" name="quantity" value="1" autocomplete="off" size="2">
                                <a class="cart_quantity_down" href=""> - </a>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">59.000 đ</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4"></td>
                        <td colspan="2">
                            <table class="table table-condensed total-result">
                                <tr>
                                    <td>Cart Sub Total</td>
                                    <td>59.000 đ</td>
                                </tr>
                                <tr>
                                    <td>Exo Tax</td>
                                    <td>$2</td>
                                </tr>
                                <tr class="shipping-cost">
                                    <td>Shipping Cost</td>
                                    <td>Free</td>										
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td><span>$61</span></td>
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
                        <p>Bill To</p>
                        <div class="form-one">
                            <form>
                                <input type="text" placeholder="Coupon code">
                            </form>
                            <a class="btn btn-primary" href="">Áp dụng mã giảm giá</a>
                        </div>
                        <div class="form-two">
                            <form>
                                <select>
                                    <option>-- Thành phố / Tỉnh --</option>
                                    <option>United States</option>
                                    <option>Bangladesh</option>
                                    <option>UK</option>
                                    <option>India</option>
                                    <option>Pakistan</option>
                                    <option>Ucrane</option>
                                    <option>Canada</option>
                                    <option>Dubai</option>
                                </select>
                                <select>
                                    <option>-- Quận / Huyện --</option>
                                    <option>United States</option>
                                    <option>Bangladesh</option>
                                    <option>UK</option>
                                    <option>India</option>
                                    <option>Pakistan</option>
                                    <option>Ucrane</option>
                                    <option>Canada</option>
                                    <option>Dubai</option>
                                </select>
                                <select>
                                    <option>-- Xã / Phường --</option>
                                    <option>United States</option>
                                    <option>Bangladesh</option>
                                    <option>UK</option>
                                    <option>India</option>
                                    <option>Pakistan</option>
                                    <option>Ucrane</option>
                                    <option>Canada</option>
                                    <option>Dubai</option>
                                </select>
                                <input type="text" placeholder="Tiền giao hàng">
                            </form>
                            <a class="btn btn-primary" href="">Chọn địa điểm</a>
                            <a class="btn btn-primary" href="">Xóa tiền giao hàng</a>
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