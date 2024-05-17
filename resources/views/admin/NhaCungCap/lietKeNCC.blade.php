@extends('layout.trangQL_header')
<link rel="stylesheet" href="{{ asset('/css/xem.css') }}">
@section('content')
    <div class="content">
        <form action="{{ route('timkiemNCC') }}" method="GET">
            <input type="text" name="keyword" placeholder="Nhập từ khóa...">
            Từ: <input type="date" name="start_date">
            Đến: <input type="date" name="end_date">
            <button type="submit">Tìm kiếm</button>
        </form>
        <h1>Danh sách nhà cung cấp</h1>
        <table class="table">
            <thead>
                <tr>
                    <!-- <th>Mã NCC</th> -->
                    <th class="th1">Tên NCC</th>
                    <th class="th1">Địa chỉ</th>
                    <th class="th1">SDT</th>
                    <th class="th1">Email</th>
                    <th class="th1">Thời hạn hợp đồng</th>
                    <th class="th1">Thời gian tạo</th>
                    <!-- <th>Thời gian sua</th> -->
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
                        <!-- <td>{{ $ncc->ThoiGianSua }}</td> -->
                        <td><a href="{{ route('suaNCC', ['id' => $ncc->MaNhaCungCap]) }}">Sửa</a><span> / </span><a href="{{ route('xoaNCC', ['id' => $ncc->MaNhaCungCap]) }}">Xóa</a>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection  