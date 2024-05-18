@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm mã giảm giá
                </header>
                <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<span style="margin-left: 5px;font-size: 17px; width: 100%; text-align: center; font-weight: bold; color: red;" class="text-alert">' . $message . '</span>';
                    Session::put('message', null);
                }
                ?>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="{{ Route('/them-phieu-giam-gia') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên phiếu giảm giá</label>
                                <input type="text" class="form-control @error('TenMaGiamGia') is-invalid @enderror"
                                       name="TenMaGiamGia" onkeyup="ChangeToSlug();" id="slug"
                                       placeholder="Tên phiếu giảm giá" value="{{old('TenMaGiamGia')}}">
                            </div>
                            @error('TenMaGiamGia')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mã code giảm giá</label>
                                <input type="text" class="form-control @error('MaCode') is-invalid @enderror"
                                       name="MaCode" placeholder="Mã code phiếu giảm giá" value="{{old('MaCode')}}">
                            </div>
                            @error('MaCode')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label for="exampleInputPassword1">Slug phiếu giảm giá</label>
                                <input type="text" class="form-control @error('SlugMaGiamGia') is-invalid @enderror"
                                       id="convert_slug"  name="SlugMaGiamGia" placeholder="Slug phiếu giảm giá" value="{{old('SlugMaGiamGia')}}">
                            </div>
                            @error('SlugMaGiamGia')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label for="exampleInputPassword1">Tính năng mã giảm giá</label>
                                <select name="DonViTinh" class="form-control input-lg m-bot15 ">
                                    <option value="0" {{ old('DonViTinh') == '0' ? 'selected' : '' }}>--Chọn--</option>
                                    <option value="2" {{ old('DonViTinh') == '2' ? 'selected' : '' }}>Giảm theo %</option>
                                    <option value="1" {{ old('DonViTinh') == '1' ? 'selected' : '' }}>Giảm theo tiền</option>
                                </select>
                                <small class="form-text text-muted"> * Mặc định chọn giảm theo %</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nhập số % | số tiền giảm</label>
                                <input type="text" class="form-control @error('TriGia') is-invalid @enderror"
                                      id="TriGia" name="TriGia" value="{{old('TriGia')}}">
                            </div>
                            @error('TriGia')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <button type="submit" name="add_coupon" class="btn btn-info">Thêm mã giảm giá</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const amountInput = document.getElementById('TriGia');
            amountInput.addEventListener('input', function(e) {
                let value = e.target.value;
                // Chỉ cho phép nhập số
                value = value.replace(/[^0-9]/g, '');
                e.target.value = value;
            });

            amountInput.addEventListener('input', function(e) {
                let value = e.target.value;

                // Loại bỏ tất cả dấu phẩy
                value = value.replace(/,/g, '');

                // Thêm dấu phẩy dưới dạng dấu phân cách nghìn
                value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

                e.target.value = value;
            });
        });
    </script>

@endsection


