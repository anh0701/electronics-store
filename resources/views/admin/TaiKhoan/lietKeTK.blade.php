<link rel="stylesheet" href="{{ asset('/css/xem.css') }}">
@extends('layout.trangQL_header')

@section('content')
        <div class="content">
            <h1>Danh sách tài khoản nhân viên</h1>
            <table>
                <thead>
                    <tr>
                        <th>Mã TK</th>
                        <th>Tên TK</th>
                        <th>Email</th>
                        <th>SDT</th>
                        <th>Thời gian tạo</th>
                        <th>Quyền</th>
                        <th>Tùy chọn</th>
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
                        <td><a href="{{ route('suaTK', ['id' => $tk->MaTaiKhoan]) }}">Sửa / </a><a href="{{ route('xoaTK', ['id' => $tk->MaTaiKhoan]) }}">Xóa</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
@endsection   
    