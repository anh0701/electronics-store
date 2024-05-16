@extends('admin_layout')
@section('admin_content')
<div class="row">
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
                        <input class="form-control" type="text" id="phuongThucThanhToan" name="phuongThucThanhToan" value="{{ $pn->PhuongThucThanhToan }}" readonly class="gray-background">   
                    </div>
                    <div class="form-group">
                        <label for="thoiGianTao">Thời gian tạo:</label>
                        <input class="form-control" type="text" id="thoiGianTao" name="thoiGianTao" value="{{ $pn->ThoiGianTao }}" readonly class="gray-background">                          
                    </div>
                    <div class="form-group">
                        <label for="thoiGianSua">Thời gian sửa:</label>
                        <input class="form-control" type="text" id="thoiGianSua" name="thoiGianSua" value="{{ $pn->ThoiGianSua }}" readonly class="gray-background">
                    </div>
                    <div class="form-group">
                        <label for="trangThai">Trạng thái:</label>
                        @php
                            if ($pn->TrangThai == "DAXACNHAN"){
                                $trangthai = "Đã xác nhận";
                            }else{
                                $trangthai = "Chưa xác nhận";
                            }
                        @endphp
                        
                        <input class="form-control" type="text" id="trangThai" name="trangThai" value="{{ $trangthai }}" readonly class="gray-background">
                    </div>
                    <a href="{{ route('xemPN') }}"><button class="btn btn-info">Trở lại</button></a>
                    <a href="{{ route('suaPN', ['id' => $pn->MaPhieuNhap]) }}"><button class="btn btn-info">Sua phieu nhap</button></a>
                    <a href="{{ route('xoaPN', ['id' => $pn->MaPhieuNhap]) }}"><button class="btn btn-info">Xoa phieu nhap</button></a>

                </div>
            </div>
        </section>
    </div>
</div>
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê sản phẩm trong phiếu nhập
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
                        <th style="width:100px">Quản lý</th>
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
    </div>
</div>
@endsection
