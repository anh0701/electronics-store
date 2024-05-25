@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thông tin phiếu xuất
            </header>
            <div class="panel-body">
                <div class="position-center">

                    <div class="form-group">
                        <label for="maPX">Mã phiếu:</label>
                        <input class="form-control" class="in1" type="text" id="maPX" name="maPX" value="{{ $px->MaPhieuXuat }}" readonly class="gray-background">
                    </div>
                    <div class="form-group">
                        <label for="nguoiLap">Người lập:</label>
                        <input class="form-control" type="text" id="nguoiLap" name="nguoiLap" value="{{ $px->TenTaiKhoan }}" readonly class="gray-background">
                    </div>
                    <div class="form-group">
                        <label for="tongTien">Tổng số lượng:</label>
                        <input class="form-control" type="text" id="tongTien" name="tongTien" value="{{ $px->TongSoLuong }}" readonly class="gray-background">
                    </div>
                    <div class="form-group">
                        <label for="trangThai">Trạng thái:</label>
                        @php
                            if ($px->TrangThai == 1){
                                $trangthai = "Đã xác nhận";
                            }else{
                                $trangthai = "Chưa xác nhận";
                            }
                        @endphp
                        
                        <input class="form-control" type="text" id="trangThai" name="trangThai" value="{{ $trangthai }}" readonly class="gray-background">
                    </div>
                    <a href="{{ route('xemPX') }}"><button class="btn btn-info">Trở lại</button></a>
                    <a href="{{ route('suaPX', ['id' => $px->MaPhieuXuat]) }}"><button class="btn btn-info">Sửa</button></a>
                    <a href="{{ route('xoaPX', ['id' => $px->MaPhieuXuat]) }}"><button class="btn btn-info">Xóa</button></a>

                </div>
            </div>
        </section>
    </div>
</div>
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê sản phẩm trong phiếu xuất
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
    </div>
</div>
@endsection
