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
                    <form action="/xuLySuaPN" method="post">
                        <div class="form-group">
                            <label for="maPN">Mã phiếu:</label>
                            <input class="form-control" type="text" id="maPN" name="maPN" value="{{ $pn->MaPhieuNhap }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="maNCC">Nhà cung cấp:</label>
                            <input class="form-control" type="text" id="maNCC" name="maNCC" value="{{ $pn->MaNhaCungCap }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nguoiLap">Người lập:</label>
                            <input class="form-control" type="text" id="nguoiLap" name="nguoiLap" value="{{ $pn->MaTaiKhoan }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="tongTien">Tổng tiền:</label>
                            <input class="form-control" type="text" id="tongTien" name="tongTien" value="{{ $pn->TongTien }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="tienTra">Số tiền đã trả:</label>
                            <input class="form-control" type="text" id="tienTra" name="tienTra" value="{{ $pn->TienTra }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="tienNo">Số tiền còn nợ:</label>
                            <input class="form-control" type="text" id="tienNo" name="tienNo" value="{{ $pn->TienNo }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="phuongThucThanhToan">Phương thức thanh toán:</label>
                            <input class="form-control" type="text" id="phuongThucThanhToan" name="phuongThucThanhToan" value="{{ $pn->PhuongThucThanhToan }}" readonly>   
                        </div>
                        <div class="form-group">
                            <label for="thoiGianTao">Thời gian tạo:</label>
                            <input class="form-control" type="text" id="thoiGianTao" name="thoiGianTao" value="{{ $pn->ThoiGianTao }}" readonly>                          
                        </div>
                        <div class="form-group">
                            <label for="thoiGianSua">Thời gian sửa:</label>
                            <input class="form-control" type="text" id="thoiGianSua" name="thoiGianSua" value="{{ $pn->ThoiGianSua }}" readonly>
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="trangThai" name="trangThai">
                                <option value="">Chưa xác nhận</option>
                                <option value="DAXACNHAN">Đã xác nhận</option>
                                <option value="KHAC">Khác</option>
                            </select>
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
                                                <th>Mã phiếu nhập</th>
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
                                                    <td><input type="text" id="maCTPN[]" name="maCTPN[]" value="{{ $matHang->MaCTPN }}" readonly></td>
                                                    <td><input type="text" value = "{{ $matHang->MaSanPham }}" readonly></td>
                                                    <td><input type="text" id="soluong[]" name="soluong[]" min="1" value="{{ $matHang->SoLuong }}"></td>
                                                    <td><input type="text" id="dongia[]" name="dongia[]" min="10000" step="1000" value="{{ $matHang->GiaSanPham }}"></td>
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
                        <button type="submit" class="btn btn-info">Luu</button>
                    </form>    
                </div>
            </div>
        </section>
    </div>
</div>
@endsection