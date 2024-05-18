@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật mã giảm giá sản phẩm
                </header>
                <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<span style="font-size: 17px; width: 100%; text-align: center; font-weight: bold; color: red;" class="text-alert">' . $message . '</span>';
                    Session::put('message', null);
                }
                ?>
                <div class="panel-body">
                    <div class="position-center">
                        @foreach ($suaPhieu as $key => $edit_value)
                            <form role="form" action="{{ Route('/suaPhieuGG', [$edit_value->MaGiamGia]) }}"
                                  method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên phiếu giảm giá</label>
                                    <input type="text" value="{{ old('TenMaGiamGia', $edit_value->TenMaGiamGia) }}"
                                           class="@error('TenMaGiamGia') is-invalid @enderror form-control"
                                           name="TenMaGiamGia" placeholder="Tên mã giảm giá">
                                </div>
                                @error('TenMaGiamGia')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mã code phiếu giảm giá</label>
                                    <input type="text" value="{{ old('MaCode', $edit_value->MaCode) }}"
                                           class="@error('MaCode') is-invalid @enderror form-control"
                                           name="MaCode" placeholder="Code mã giảm giá">
                                </div>
                                @error('MaCode')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Slug giảm giá</label>
                                    <input type="text" value="{{ old('SlugMaGiamGia', $edit_value->SlugMaGiamGia) }}"
                                           class="@error('SlugMaGiamGia') is-invalid @enderror form-control"
                                           name="SlugMaGiamGia" placeholder="Code mã giảm giá">
                                </div>
                                @error('SlugMaGiamGia')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Số tiền | Phần trămm giảm</label>
                                    <select name="DonViTinh" class="form-control input-lg m-bot15">
                                        @if ($edit_value->DonViTinh == '1')
                                            <option value="1" selected>Giảm theo tiền</option>
                                            <option value="2">Giảm theo %</option>
                                        @else
                                            <option value="1">Giảm theo tiền</option>
                                            <option value="2" selected>Giảm theo %</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Trị giá</label>
                                    <input type="text" value="{{ old('TriGia', $edit_value->TriGia) }}"
                                           class="@error('TriGia') is-invalid @enderror form-control"
                                          id="TriGia" name="TriGia" placeholder="Giá trị">
                                </div>
                                @error('TriGia')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <button type="submit" name="suaPhieuGG" class="btn btn-info">Cập nhật mã giảm giá
                                </button>
                            </form>
                        @endforeach
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
