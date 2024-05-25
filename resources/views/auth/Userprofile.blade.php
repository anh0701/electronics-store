@extends('layout')
@section('content')
    <div class="container">
        <div class="main">
            <div class="row">
                <form action="{{route('/thongTinTaiKhoan')}}" method="post">
                    @csrf
                    <div class="col-md-4">
                        <div class="card text-center sidebar">
                            <div class="card-body">
                                <img id="profile-image-preview" style="margin: 5% auto" src="{{$tk[0]->HinhAnh ? asset($tk[0]->HinhAnh): asset('upload/avatar-default.jpg')}}" class="rounded-circle" width="150" alt="Ảnh đại diện">
                                {{--                        <div class="mt-3">--}}
                                {{--                            <a href="">Xem mã giảm giá</a>--}}
                                {{--                            <a href="">Xem đơn hàng</a>--}}
                                {{--                            <a href="Signout"></a>--}}
                                {{--                        </div>--}}
                                <input type="file" class="@error('HinhAnh') is-invalid @enderror" style="color: black; margin: 5% auto" name="HinhAnh" id="HinhAnh" onchange="previewImage(event)">
                                @error('HinhAnh')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
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
                                        <input type="text" class="@error('TenNguoiDung') is-invalid @enderror" name="TenNguoiDung" id="TenNguoiDung" value="{{old('TenNguoiDung', $tk[0] -> TenNguoiDung)}}">
                                        @error('TenNguoiDung')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <h5>Email</h5>
                                    </div>
                                    <div class="col-9 text-secondary">
                                        <input type="text" class="@error('Email') is-invalid @enderror" name="Email" id="Email" value="{{old('Email', $tk[0]->Email)}}">
                                        @error('Email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <h5>Số điện thoại</h5>
                                    </div>
                                    <div class="col-9 text-secondary">
                                        <input type="text" class="@error('SoDienThoai') is-invalid @enderror" name="SoDienThoai" id="SoDienThoai" value="{{old('SoDienThoai', $tk[0]->SoDienThoai)}}">
                                        @error('SoDienThoai')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <h5>Địa chỉ</h5>
                                    </div>
                                    <div class="col-9 text-secondary">
                                        <input type="text" class="@error('DiaChi') is-invalid @enderror" name="DiaChi" id="DiaChi" value="{{old('DiaChi', $tk[0]->DiaChi)}}">
                                        @error('DiaChi')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
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
                        <td>Mã code</td>
{{--                        <td class="image">Item</td>--}}
                        <td class="description">Tên phiếu giảm giá</td>
                        <td class="price">Trị giá</td>
{{--                        <td class="quantity">Quantity</td>--}}
{{--                        <td class="total">Total</td>--}}
                        <td></td>
                    </tr>
                    </thead>
                    @php $i = 0; @endphp
                    @foreach($phieuGiamGia as $phieu)
                    <tbody>
                    <tr>
                        <td class="text-center">{{$i = $i + 1}}</td>
                        <td>{{$phieu->MaCode}}</td>
                        <td class="cart_description">
                            <h4>{{$phieu ->TenMaGiamGia}}</h4>
                        </td>
                        <td class="cart_price">
                            <p>{{$phieu->TriGia . ($phieu ->DonViTinh  == 2? '%' : 'đ')}}</p>
                        </td>
                    </tr>
                    </tbody>
                    @endforeach
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
