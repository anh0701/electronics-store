@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật tài khoản
            </header>
            <div class="panel-body">
                <div class="position-center">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                @endif
                @php 
                    $user = session(('user'));
                    $quyen = $user['Quyen'];

                @endphp 
                @foreach ($data as $item)
                    <form role="form" id="from" action="{{Route('xuLySuaTK')}}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="maTK">Mã tài khoản</label>  
                            <input class="form-control" type="text" id="maTK" name="maTK" value="{{ $item->MaTaiKhoan }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="tentaikhoan">Tên nhà cung cấp</label>
                            <input class="form-control" type="text" id="tentaikhoan" name="tentaikhoan" value="{{ $item->TenTaiKhoan }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>                   
                            <input class="form-control" type="text" id="email" name="email" value="{{ $item->Email }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="sdt">Số điện thoại</label>                 
                            <input class="form-control" type="text" id="sdt" name="sdt" value="{{ $item->SoDienThoai }}">
                        </div>
                        <div class="form-group">
                            <label for="">Quyền hạn</label>             
                            <select id="quyen" class="form-control input-lg m-bot15" name="quyen">
                                <option value="Nhân viên" {{ $item->Quyen === 'Nhân viên' ? 'selected' : '' }}>Nhân viên</option>
                                <option value="Nhân viên kho" {{ $item->Quyen === 'Nhân viên kho' ? 'selected' : '' }}>Nhân viên kho</option>
                                <option value="Nhân viên bán hàng" {{ $item->Quyen === 'Nhân viên bán hàng' ? 'selected' : '' }}>Nhân viên bán hàng</option>
                                <option value="Nhân viên kế toán" {{ $item->Quyen === 'Nhân viên kế toán' ? 'selected' : '' }}>Nhân viên kế toán</option>
                                <option value="Quản trị viên" {{ $item->Quyen === 'Quản trị viên' ? 'selected' : '' }}>Quản trị viên</option>
                                <option value="Quản trị viên cấp cao" {{ $item->Quyen === 'Quản trị viên cấp cao' ? 'selected' : '' }}>Quản trị viên cấp cao</option>
                            </select>
                        </div>
                        <div class="form-group" style="{{ $quyen != 'Quản trị viên cấp cao' ? 'display: none;' : '' }}">
                            <label for="">Trạng thái</label>
                            <select name="trangThai" class="form-control input-lg m-bot15">
                                <option value="0" {{ $item->TrangThai == '0' ? 'selected' : '' }}>Vô hiệu hóa</option>
                                <option value="1" {{ $item->TrangThai == '1' ? 'selected' : '' }}>Kích hoạt</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-info">Lưu</button>
                    </form>
                @endforeach
                </div>
            </div>
        </section>
    </div>
</div>
@endsection