@extends('layout')
@section('content')
    <div class="container">
        <div class="main">
            <div class="row">
                <form action="{{route('/thongTinTaiKhoan')}}" method="post">
                    <div class="col-md-4">
                        <div class="card text-center sidebar">
                            <div class="card-body">
                                <img id="profile-image-preview" style="margin: 5% auto" src="{{$tk[0]->HinhAnh ? asset($tk[0]->HinhAnh): asset('upload/avatar-default.jpg')}}" class="rounded-circle" width="150" alt="Ảnh đại diện">
                                {{--                        <div class="mt-3">--}}
                                {{--                            <a href="">Xem mã giảm giá</a>--}}
                                {{--                            <a href="">Xem đơn hàng</a>--}}
                                {{--                            <a href="Signout"></a>--}}
                                {{--                        </div>--}}
                                <input type="file" style="color: black; margin: 5% auto" name="HinhAnh" id="HinhAnh" onchange="previewImage(event)">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-7">
                        <div class="card mb-3 content">
                            <h1 class="m-3 pt-3">Thông tin cá nhân</h1>
                            <div class="card-body">
                                <hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <h5>Họ và tên</h5>
                                    </div>
                                    <div class="col-9 text-secondary">
                                        <input type="text" name="TenNguoiDung" id="TenNguoiDung" value="{{old('TenNguoiDung', $tk[0] -> TenNguoiDung)}}">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <h5>Email</h5>
                                    </div>
                                    <div class="col-9 text-secondary">
                                        <input type="text" name="Email" id="Email" value="{{old('Email', $tk[0]->Email)}}">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <h5>Số điện thoại</h5>
                                    </div>
                                    <div class="col-9 text-secondary">
                                        <input type="text" name="SoDienThoai" id="SoDienThoai" value="{{old('SoDienThoai', $tk[0]->SoDienThoai)}}">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <h5>Địa chỉ</h5>
                                    </div>
                                    <div class="col-9 text-secondary">
                                        <input type="text" name="DiaChi" id="DiaChi" value="{{old('DiaChi', $tk[0]->DiaChi)}}">
                                    </div>
                                </div>
                                <hr>

                                <button type="submit" class="btn btn-info">Cập nhật thông tin</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <section id="cart_items">
        <div class="container">
            <div class="review-payment">
                <h2>Mã giảm giá của người dùng</h2>
            </div>
            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                    <tr class="cart_menu">
                        <td class="text-center">STT</td>
{{--                        <td class="image">Item</td>--}}
                        <td class="description">Tên phiếu giảm giá</td>
                        <td class="price">Trị giá</td>
{{--                        <td class="quantity">Quantity</td>--}}
{{--                        <td class="total">Total</td>--}}
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="text-center">1</td>
                        <td class="cart_description">
                            <h4><a href="">Colorblock Scuba</a></h4>
                            <p>Web ID: 1089772</p>
                        </td>
                        <td class="cart_price">
                            <p>$59</p>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function(){
                const output = document.getElementById('profile-image-preview');
                output.src = reader.result;
                output.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

    <style>
        .card{
            border: none !important;
        }

        input:focus {
            outline: none;
        }

        input[type=text]{
            border: 1px solid #ccc;
            /*width: 100%;*/
            padding: 1%;
        }
    </style>
@endsection
