@extends('admin_layout')
@section('admin_content')
@php 
    if($px->TrangThai == 0){
        $tt = "Chưa xác nhận";
    }else{
        $tt = "Đã xác nhận";
    }
@endphp 
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Chi tiết phiếu xuất
        </div>
        <div class="container">
            <div class="row r1">
                <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
                    <p><strong>Mã phiếu xuất:</strong></p>
                </div>
                <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9">
                    <p>{{$px->MaPhieuXuat}}</p>
                </div>
                <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
                    <p><strong>Người lập:</strong></p>
                </div>
                <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9">
                    <p> {{$px->TenTaiKhoan}}</p>
                </div>
                <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
                    <p><strong>Lý do xuất:</strong></p>
                </div>
                <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9">
                    <p> {{$px->LyDoXuat}}</p>
                </div>
                @if (!empty($px->MaDonHang))
                <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
                    <p><strong>Mã đơn hàng:</strong></p>
                </div>
                <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9">
                    <p> {{$px->MaDonHang}} </p>
                </div>
                @endif
                
                <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
                    <p><strong>Trạng thái:</strong></p>
                </div>
                <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9">
                    <p>{{$tt}}</p>
                </div>
                <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
                    <p><strong>Thời gian tạo:</strong></p>
                </div>
                <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9">
                    <p> {{$px->ThoiGianTao}}</p>
                </div>
                <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
                    <p><strong>Thời gian sửa:</strong></p>
                </div>
                <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9">
                    <p> {{$px->ThoiGianSua}}</p>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ct as $i)
                        <tr>
                            <td>{{ $i->TenSanPham }}</td>
                            <td>{{ $i->SoLuong }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="table-responsive">
            <p class="head1">Danh sách seri sản phẩm xuất</p>
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Số Seri</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ctsp as $key => $sp)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $sp->TenSanPham }}</td>
                            <td>{{ $sp->MaSeri }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="container">
            <div class="row r1">
                <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
                    <p><strong>Tổng số lượng:</strong></p>
                </div>
                <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9">
                    <p>{{ $px->TongSoLuong }}</p>
                </div>
            </div>
        </div>
        
    </div>
    <!-- <a href="{{ route('xemPX') }}"><button class="btn btn-info">Quay lại danh sách</button></a> -->
    <a href="{{ route('suaPX', ['id' => $px->MaPhieuXuat]) }}"><button class="btn btn-info">Sửa</button></a>
</div>
@endsection
