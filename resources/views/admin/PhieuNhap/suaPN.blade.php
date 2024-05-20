@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật phiếu nhập 
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
                    <form role="form" action="{{ Route('xuLySuaPN') }}" method="POST" >
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="">Mã phiếu</label>
                            <input type="text" class="form-control" name="maPN" value="{{ $pn->MaPhieuNhap }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Người lập phiếu</label>
                            <input type="text" class="form-control" name="nguoiLap" value="{{ $pn->MaTaiKhoan }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Nhà cung cấp</label>
                            <input type="text" class="form-control" name="ncc" value="{{ $pn->MaNhaCungCap }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Tổng tiền</label>
                            <input type="text" class="form-control" name="tongTien" value="{{ $pn->TongTien }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Tiền đã trả</label>
                            <input type="text" class="form-control" name="tienTra" value="{{ $pn->TienTra }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Tiền trả thêm</label>
                            <input type="text" class="form-control" name="tienTraMoi" value="0">
                        </div>
                        <div class="form-group">
                            <label for="">Tiền nợ</label>
                            <input type="text" class="form-control" name="tienNo" value="{{ $pn->TienNo }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Thời gian sửa</label>
                            <input type="text" class="form-control" name="tgSua" value="{{ $pn->ThoiGianSua }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Phương thức thanh toán</label>
                            <select name="thanhToan" class="form-control input-lg m-bot15">
                                <option value="0" >Chuyển khoản</option>
                                <option value="1" >Tiền mặt</option>
                                <option value="2" >Khác</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Trạng thái</label>
                            <input type="text" class="form-control" name="trangThaiTruoc" value="{{ $pn->TrangThai }}" readonly>
                            <select name="trangThai" class="form-control input-lg m-bot15">
                                <option value="0" >Chưa xác nhận</option>
                                <option value="1" >Xác nhận</option>
                            </select>
                        </div>

                        <button type="submit" name="" class="btn btn-info">Lưu</button>
                        
                    </form>
                    @if ($pn->TrangThai == 0)
                        <a href="{{ route('suaPNCT', ['id' => $pn->MaPhieuNhap]) }}"><button type="sua" name="" class="btn btn-info" style="margin-top:5px">Thêm sản phẩm</button></a>
                    @endif
                    
                    <div class="table-responsive">
                        <table class="table table-striped b-t b-light">
                            <thead>
                                <tr>
                                    <!-- <th>Mã phiếu nhập chi tiết</th> -->
                                    <th>Mã phiếu nhập</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Giá sản phẩm</th>
                                    <th>Thành tiền</th>                                    
                                    <th style="width:100px">Quản lý</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    
                                @endphp
                                @foreach ($ctpn as $ct)
                                    <tr>
                                        <!-- <td>{{ $ct->MaCTPN }}</td> -->
                                        <td>{{ $ct->MaPhieuNhap }}</td>
                                        <td>{{ $ct->TenSanPham }}</td>
                                        <td>{{ $ct->SoLuong }}</td>
                                        <td>{{ $ct->GiaSanPham }}</td>
                                        <td>{{ $ct->SoLuong * $ct->GiaSanPham }}</td>
                                        <td>
                                            <a href="{{ route('suaCT', ['id' => $ct->MaCTPN]) }}"><i style="font-size: 20px; width: 100%; text-align: center; font-weight: bold; color: green;" class="fa fa-pencil-square-o text-success text-active"></i></a>
                                            <a onclick="return confirm('Bạn có muốn xóa danh mục {{ $ct->MaCTPN }} không?')" href="{{ route('xoaCTPN', ['id' => $ct->MaCTPN]) }}"><i style="font-size: 20px; width: 100%; text-align: center; font-weight: bold; color: red;" class="fa fa-times text-danger text"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection