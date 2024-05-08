@extends('layout.trangQL_header')
<link rel="stylesheet" href="{{ asset('/css/xem.css') }}">
@section('content')
    <div class="content">
        <h1>Danh sách nhà cung cấp</h1>
        <table>
            <thead>
                <tr>
                    <!-- <th>Mã NCC</th> -->
                    <th>Tên NCC</th>
                    <th>Địa chỉ</th>
                    <th>SDT</th>
                    <th>Email</th>
                    <th>Thời hạn hợp đồng</th>
                    <th>Thời gian tạo</th>
                    <th>Thời gian sua</th>
                    <th>Tuy chon</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $ncc)
                    <tr class="row-clickable" data-id="{{ $ncc->MaNhaCungCap }}">
                        <!-- <td>{{ $ncc->MaNhaCungCap }}</td> -->
                        <td>{{ $ncc->TenNhaCungCap }}</td>
                        <td>{{ $ncc->DiaChi }}</td>
                        <td>{{ $ncc->SoDienThoai }}</td>
                        <td>{{ $ncc->Email }}</td>
                        <td>{{ $ncc->ThoiHanHopDong }}</td>
                        <td>{{ $ncc->ThoiGianTao }}</td>
                        <td>{{ $ncc->ThoiGianSua }}</td>
                        <td><a href="{{ route('suaNCC', ['id' => $ncc->MaNhaCungCap]) }}">Sửa / </a><a href="{{ route('xoaNCC', ['id' => $ncc->MaNhaCungCap]) }}">Xóa</a>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection  