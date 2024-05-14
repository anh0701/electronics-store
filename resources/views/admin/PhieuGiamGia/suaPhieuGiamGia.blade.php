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
                                    <label for="exampleInputEmail1">Tên mã giảm giá</label>
                                    <input type="text" value="{{ $edit_value->TenMaGiamGia }}" class="form-control"
                                           name="TenMaGiamGia" placeholder="Tên mã giảm giá">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mã phiếu giảm giá</label>
                                    <input type="text" value="{{ $edit_value->MaCode }}" class="form-control"
                                           name="MaCode" placeholder="Code mã giảm giá">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Slug giảm giá</label>
                                    <input type="text" value="{{ $edit_value->SlugMaGiamGia }}" class="form-control"
                                           name="SlugMaGiamGia" placeholder="Code mã giảm giá">
                                </div>
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
                                    <input type="text" value="{{ $edit_value->TriGia }}" class="form-control"
                                           name="TriGia" placeholder="Giá trị">
                                </div>
                                <button type="submit" name="suaPhieuGG" class="btn btn-info">Cập nhật mã giảm giá
                                </button>
                            </form>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
