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
                                <label for="exampleInputEmail1">Tên mã giảm giá</label>
                                <input type="text" class="form-control" name="TenMaGiamGia"
                                       placeholder="Tên phiếu giảm giá">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mã giảm giá</label>
                                <input type="text" class="form-control" name="MaCode" placeholder="Mã phiếu giảm giá">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Slug phiếu giảm giá</label>
                                <input type="text" class="form-control" name="SlugMaGiamGia" placeholder="Slug phiếu giảm giá">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Tính năng mã giảm giá</label>
                                <select name="DonViTinh" class="form-control input-lg m-bot15">
                                    <option value="0">--Chọn--</option>
                                    <option value="2">Giảm theo %</option>
                                    <option value="1">Giảm theo tiền</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nhập số % | số tiền giảm</label>
                                <input type="text" class="form-control" name="TriGia">
                            </div>
                            <button type="submit" name="add_coupon" class="btn btn-info">Thêm mã giảm giá</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
