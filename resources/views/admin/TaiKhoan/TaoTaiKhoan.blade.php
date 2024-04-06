@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Tạo tài khoản
            </header>
            @php
              $status = Session::get('status');
                if ($status) {
                    echo '<span style="margin-left: 5px;font-size: 17px; width: 100%; text-align: center; font-weight: bold; color: red;" class="text-alert">'.$status.'</span>';
                    Session::put('status', null);
                }
            @endphp
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{ Route('/TaoTaiKhoan') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên tài khoản</label>
                            <input type="text" class="form-control" name="TenTaiKhoan" placeholder="Tên tài khoản" value="{{ old('TenTaiKhoan') }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="text" class="form-control" name="Email" placeholder="Email" value="{{ old('Email') }}">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Số điện thoại</label>
                          <input type="text" class="form-control" name="SoDienThoai" placeholder="Số điện thoại" value="{{ old('SoDienThoai') }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh đại diện</label>
                            <input type="file" class="form-control" name="HinhAnh" placeholder="Hình ảnh" value="{{ old('HinhAnh') }}">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Mật khẩu</label>
                          <input type="text" class="form-control" name="MatKhau" placeholder="Mật khẩu">
                        </div>
                        <button type="submit" name="TaoTaiKhoan" class="btn btn-info">Tạo tài khoản</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection