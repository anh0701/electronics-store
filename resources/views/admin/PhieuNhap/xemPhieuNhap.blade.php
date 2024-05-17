@extends('layout.trangQL_header')
<link rel="stylesheet" href="{{ asset('/css/xem.css') }}">
@section('content')
    <div class="content">
      <!-- Phần nội dung trung tâm -->
      <h1>Danh sach phieu nhap</h1>
      <table class="table">
        <thead>
            <tr>
                <th class="th1">MaPN</th>
                <th class="th1">NguoiLap</th>
                <th class="th1">MaNCC</th>
                <th class="th1">ThoiGianLap</th>
                <th class="th1">TongTien</th>
                <th class="th1">TienNo</th>
                <th class="th1">TuyChon</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $pn)
            <tr class="row-clickable" data-id="{{ $pn->MaPhieuNhap }}">
                <td>{{ $pn->MaPhieuNhap }}</td>
                <td>{{ $pn->TenTaiKhoan }}</td>
                <td>{{ $pn->MaNhaCungCap }}</td>
                <td>{{ $pn->ThoiGianTao }}</td>
                <td>{{ $pn->TongTien }}</td>
                <td>{{ $pn->TienNo }}</td>
                <td><a href="{{ route('xemCTPN', ['id' => $pn->MaPhieuNhap]) }}">Xem chi tiet</a><span> / </span><a href="{{ route('/', ['id' => $pn->MaPhieuNhap]) }}">Xóa</a></td>
            </tr>
            @endforeach
        </tbody>
      </table>
    </div>
@endsection  