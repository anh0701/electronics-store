@extends('admin_layout')
@section('admin_content')
<!-- <div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thông tin phiếu nhập
            </header>
            <div class="panel-body">
                <div class="position-center">


                    <div class="form-group">
                        <label for="maPN">Mã phiếu:</label>
                        <input class="form-control" class="in1" type="text" id="maPN" name="maPN" value="{{ $pn->MaPhieuNhap }}" readonly class="gray-background">
                    </div>
                    <div class="form-group">
                        <label for="maNCC">Nhà cung cấp:</label>
                        <input class="form-control" class="in1" type="text" id="maNCC" name="maNCC" value="{{ $pn->TenNhaCungCap }}" readonly class="gray-background">
                    </div>
                    <div class="form-group">
                        <label for="nguoiLap">Người lập:</label>
                        <input class="form-control" type="text" id="nguoiLap" name="nguoiLap" value="{{ $pn->TenTaiKhoan }}" readonly class="gray-background">
                    </div>
                    <div class="form-group">
                        <label for="tongTien">Tổng tiền:</label>
                        <input class="form-control" type="text" id="tongTien" name="tongTien" value="{{ $pn->TongTien }}" readonly class="gray-background">
                    </div>
                    <div class="form-group">
                        <label for="tienTra">Số tiền đã trả:</label>
                        <input class="form-control" type="text" id="tienTra" name="tienTra" value="{{ $pn->TienTra }}" readonly class="gray-background">
                    </div>
                    <div class="form-group">
                        <label for="tienNo">Số tiền còn nợ:</label>
                        <input class="form-control" type="text" id="tienNo" name="tienNo" value="{{ $pn->TienNo }}" readonly class="gray-background">
                    </div>
                    <div class="form-group">
                        <label for="phuongThucThanhToan">Phương thức thanh toán:</label>
                        @php
                            if($pn->PhuongThucThanhToan == 0){
                                $tt = "Chuyển khoản";
                            }elseif($pn->PhuongThucThanhToan == 1){
                                $tt = "Tiền mặt";
                            }else{
                                $tt = "Khác";
                            }
                        @endphp
                        <input class="form-control" type="text" id="phuongThucThanhToan" name="phuongThucThanhToan" value="{{ $tt }}" readonly class="gray-background">   
                    </div>
                    <div class="form-group">
                        <label for="trangThai">Trạng thái:</label>
                        @php
                            if ($pn->TrangThai == 1){
                                $trangthai = "Đã xác nhận";
                            }else{
                                $trangthai = "Chưa xác nhận";
                            }
                        @endphp
                        
                        <input class="form-control" type="text" id="trangThai" name="trangThai" value="{{ $trangthai }}" readonly class="gray-background">
                    </div>
                    
                    
                </div>
            </div>
        </section>
    </div>
</div> -->
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Sản phẩm trong phiếu nhập
        </div>
        <div class="row w3-res-tb">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-3">
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ctpn as $key => $matHang)
                        <tr>
                            <td>{{ $matHang->TenSanPham }}</td>
                            <td>{{ $matHang->SoLuong }}</td>
                            <td>{{ $matHang->GiaSanPham }}</td>
                            @php
                                $thanhTien = $matHang->SoLuong * $matHang->GiaSanPham;
                            @endphp
                            <td>{{ $thanhTien }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <p><strong>Tổng tiền:</strong></p>
                </div>
                <div class="col-sm-6">
                    <p>{{ $pn->TongTien }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <p><strong>Phương thức thanh toán:</strong></p>
                </div>
                <div class="col-sm-6">
                    <p>{{ $tt }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <p><strong>Tiền trả:</strong></p>
                </div>
                <div class="col-sm-6">
                    <p>{{ $pn->TienTra }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <p><strong>Tiền nợ:</strong></p>
                </div>
                <div class="col-sm-6">
                    <p>{{ $pn->TienNo }}</p>
                </div>
            </div>
        </div>
        
    </div>
    <a href="{{ route('xemPN') }}"><button class="btn btn-info">Trở lại</button></a>
    <a href="{{ route('suaPN', ['id' => $pn->MaPhieuNhap]) }}"><button class="btn btn-info">Sửa</button></a>
    @if ($pn->TrangThai == 0)
        <a href="{{ route('xoaPN', ['id' => $pn->MaPhieuNhap]) }}"><button class="btn btn-info">Xóa</button></a>
    @elseif($pn->TrangThai == 1)
        <a href="{{ route('lapTH', ['id' => $pn->MaPhieuNhap, 'maNCC' => $pn->MaNhaCungCap]) }}"><button class="btn btn-info">Lập phiếu trả hàng</button></a>
    @endif
</div>
@endsection
