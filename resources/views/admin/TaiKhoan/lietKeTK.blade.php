
@extends('layout.trangQL_header')
<link rel="stylesheet" href="{{ asset('/css/xem.css') }}">
@section('content')
        <div class="content">
            <form action="{{ route('timkiemTK') }}" method="GET">
                <input type="text" name="keyword" placeholder="Nhập từ khóa...">
                Từ: <input type="date" name="start_date">
                Đến: <input type="date" name="end_date">
                Quyền:
                <select id="quyen" name="quyen">
                    <option value="">Tat ca</option>
                    <option value="NV">Nhan vien</option>
                    <option value="QTVCC">Quan tri vien cap cao</option>
                    <option value="QTV">Quan tri vien</option>
                    <option value="NVBH">Nhan vien ban hang</option>
                    <option value="NVK">Nhan vien kho</option>
                    <option value="NVKT">Nhan vien ke toan</option>
                    <option value="KH">Khach hang</option>
                </select>
                <button type="submit">Tìm kiếm</button>
            </form>
            <h1>Danh sách tài khoản nhân viên</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th class="th1">Mã TK</th>
                        <th class="th1">Tên TK</th>
                        <th class="th1">Email</th>
                        <th class="th1">SDT</th>
                        <th class="th1">Thời gian tạo</th>
                        <th class="th1">Quyền</th>
                        <th class="th1">Tùy chọn</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $tk)
                    <tr class="row-clickable" data-id="{{ $tk->MaTaiKhoan }}">
                        <td>{{ $tk->MaTaiKhoan }}</td>
                        <td>{{ $tk->TenTaiKhoan }}</td>
                        <td>{{ $tk->Email }}</td>
                        <td>{{ $tk->SoDienThoai }}</td>
                        <td>{{ $tk->ThoiGianTao }}</td>
                        <td>{{ $tk->Quyen }}</td>
                        @if ($tk->Quyen != 'KH')
                            <td><a href="{{ route('suaTK', ['id' => $tk->MaTaiKhoan]) }}">Sửa</a><span> / </span><a href="{{ route('xoaTK', ['id' => $tk->MaTaiKhoan]) }}">Xóa</a></td>
                        @else
                            <td><a href="{{ route('xoaTK', ['id' => $tk->MaTaiKhoan]) }}">Xóa</a></td>
                        @endif
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
@endsection   
    