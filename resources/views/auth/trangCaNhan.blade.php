@extends('layout')
@section('content')
    <div class="container">
        <div class="main">
            <div class="row">
                <form action="{{route('/thongTinTaiKhoan')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="quyen" value="{{$tk[0]->Quyen}}">
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="card text-center sidebar">
                            <div class="card-body">
                                <img id="profile-image-preview" style="margin: 5% auto" src="{{$tk[0]->HinhAnh ? asset($tk[0]->HinhAnh): asset('upload/avatar-default.jpg')}}" class="rounded-circle" width="150" alt="Ảnh đại diện">
                                <input type="file" class="form-control @error('HinhAnh') is-invalid @enderror" style="color: black; margin: 5% auto" name="HinhAnh" id="HinhAnh" onchange="previewImage(event)">
                                @error('HinhAnh')
                                <div class="alert alert-danger  mt-2 small-alert">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1 col-md-0"></div>
                    <div class="col-lg-7 col-md-6">
                        <div class="card mb-3 content">
                            <h1 style="margin-bottom: 5%">Thông tin cá nhân</h1>
                            <div class="card-body">

                                <div class="row mb-3" style="margin-bottom: 3%">
                                    <div class="col-md-3">
                                        <h5>Họ và tên</h5>
                                    </div>
                                    <div class="col-md-9 text-secondary">
                                        <input type="text" class="form-control @error('TenNguoiDung') is-invalid @enderror" name="TenNguoiDung" id="TenNguoiDung" value="{{old('TenNguoiDung', $tk[0] -> TenNguoiDung)}}">
                                        @error('TenNguoiDung')
                                        <div class="alert alert-danger  mt-2 small-alert">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3" style="margin-bottom: 3%">
                                    <div class="col-md-3">
                                        <h5>Email</h5>
                                    </div>
                                    <div class="col-md-9 text-secondary">
                                        <input type="email" class="form-control @error('Email') is-invalid @enderror" name="Email" id="Email" value="{{old('Email', $tk[0]->Email)}}">
                                        @error('Email')
                                        <div class="alert alert-danger  mt-2 small-alert">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3" style="margin-bottom: 3%">
                                    <div class="col-md-3">
                                        <h5>Số điện thoại</h5>
                                    </div>
                                    <div class="col-md-9 text-secondary">
                                        <input type="text" class="form-control @error('SoDienThoai') is-invalid @enderror" name="SoDienThoai" id="SoDienThoai" value="{{old('SoDienThoai', $tk[0]->SoDienThoai)}}">

                                        @error('SoDienThoai')
                                        <div class="alert alert-danger  mt-2 small-alert">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3" style="margin-bottom: 3%">
                                    <div class="col-md-3">
                                        <h5>Địa chỉ</h5>
                                    </div>
                                    <div class="col-md-9 text-secondary">
                                        <input type="text" class="form-control @error('DiaChi') is-invalid @enderror" name="DiaChi" id="DiaChi" value="{{old('DiaChi', $tk[0]->DiaChi)}}">
                                        @error('DiaChi')
                                        <div class="alert alert-danger  mt-2 small-alert">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3" style="margin-bottom: 3%">
                                    <div class="col-12 text-center text-secondary">
                                        <button type="submit" class="btn btn-info w-100">Cập nhật thông tin</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <section id="cart_items" >
            <div class="container">
                <div class="review-payment">
                    <h2 class="mb-4">Mã giảm giá của người dùng</h2>
                </div>

                <div class="table-responsive cart_info">
                    <table class="table table-condensed">
                        <thead>
                        <tr class="cart_menu">
                            <td class="text-center">STT</td>
                            <td>Mã code</td>
                            <td class="description">Tên phiếu giảm giá</td>
                            <td class="price">Trị giá</td>
                            <td>Thời gian có hiệu lực</td>
                            <td>Thời gian hết hiệu lực</td>
                        </tr>
                        </thead>
                        @php $i = 0; @endphp
                        @foreach($phieuGiamGia as $phieu)
                            <tbody>
                            <tr class="{{ ($phieu->ThoiGianKetThuc < now() || $phieu->TrangThai == 0) ? 'text-muted' : '' }}">
                                <td class="text-center">{{$i = $i + 1}}</td>
                                <td><h5>{{$phieu->MaCode}}</h5></td>
                                <td>
                                    {{$phieu ->TenMaGiamGia}}
                                </td>
                                <td>
                                    <p>{{number_format($phieu->TriGia, 0, '', ',') . ($phieu ->DonViTinh  == 2? '%' : 'đ')}}</p>
                                </td>
                                <td>{{$phieu->ThoiGianBatDau}}</td>
                                <td>{{$phieu->ThoiGianKetThuc}}</td>
                            </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
                <div class="row">
                    <div class="col-sm-5 text-center">
                    </div>
                    <div class="col-sm-7 text-right text-center-xs">
                        <ul class="pagination pagination-sm m-t-none m-b-none">
                            @if ($phieuGiamGia instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                {{ $phieuGiamGia->links('vendor.pagination.bootstrap-4') }}
                            @endif
                        </ul>
                    </div>
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
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Thành công',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 1500
            });
            @endif
        });
    </script>

    <style>
        .card {
            border: none !important;
        }

        input:focus {
            outline: none;
        }

        input[type=text], input[type=email] {
            border: 1px solid #ccc;
            padding: 1%;
            width: 100%;
        }

        .text-muted {
            color: #a6a5a5 !important;
            background-color: #ccc;
        }

        .mt-2 {
            margin-top: 0.5rem;
            margin-bottom: 0;
        }

        .small-alert {
            padding: 0.75rem 0.75rem;
            font-size: 1.25rem;
        }
    </style>
@endsection
