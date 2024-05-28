@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Sản phẩm trong phiếu trả hàng
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
                        <th>Lý do trả hàng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ctth as $key => $matHang)
                        <tr>
                            <td>{{ $matHang->TenSanPham }}</td>
                            <td>{{ $matHang->SoLuong }}</td>
                            <td>{{ $matHang->GiaSanPham }}</td>
                            <td>{{ $matHang->LyDoTraHang }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <p><strong>Trạng thái:</strong></p>
                </div>
                <div class="col-sm-6">
                    @php 
                        if($pth->TrangThai == 0){
                            $tt = "Chưa xác nhận";
                        }else{
                            $tt = "Đã xác nhận";
                        }
                    @endphp 
                    <p>{{ $tt }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <p><strong>Tổng tiền:</strong></p>
                </div>
                <div class="col-sm-6">
                    <p>{{ $pth->TongTien }}</p>
                </div>
            </div>
        </div>
        
    </div>
    <a href="{{ route('xemPTH') }}"><button class="btn btn-info">Trở lại</button></a>
    <a href="{{ route('suaPTH', ['id' => $pth->MaPhieuTraHang]) }}"><button class="btn btn-info">Sửa</button></a>
    @if ($pth->TrangThai == 0)
        <a href="{{ route('xoaPTH', ['id' => $pth->MaPhieuTraHang]) }}"><button class="btn btn-info">Xóa</button></a>
    @endif
</div>
@endsection
