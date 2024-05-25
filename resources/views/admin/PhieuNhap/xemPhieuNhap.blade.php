@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê phiếu nhập
            </div>
            <div class="row w3-res-tb">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-3">
                    <div class="input-group">
                        <form action="" method="GET">
                            <input type="text" name="keyword" placeholder="Nhập từ khóa...">
                            <button type="submit">Tìm kiếm</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th>Mã phiếu nhập</th>
                            <th>Người lập phiếu</th>
                            <th>Nhà cung cấp</th>
                            
                            <th>Tổng tiền</th>
                            <th>Số tiền nợ</th>
                            <th>Trạng thái</th>
                            <th style="width:100px">Quản lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $pn)
                            <tr class="row-clickable" data-id="{{ $pn->MaPhieuNhap }}">
                                <td>{{ $pn->MaPhieuNhap }}</td>
                                <td>{{ $pn->TenTaiKhoan }}</td>
                                <td>{{ $pn->TenNhaCungCap }}</td>
                                
                                <td>{{ $pn->TongTien }}</td>
                                <td>{{ $pn->TienNo }}</td>
                                @php 
                                    if($pn->TrangThai == 0){
                                        $trangthai = "Chưa xác nhận";
                                    }elseif($pn->TrangThai == 1){
                                        $trangthai = "Đã xác nhận";
                                    }else{
                                        $trangthai = "";
                                    }

                                @endphp 
                                <td>{{ $trangthai }}</td>
                                <td>
                                    <a href="{{ route('xemCTPN', ['id' => $pn->MaPhieuNhap]) }}">
                                    <i style="font-size: 20px; width: 100%; text-align: center; font-weight: bold; color: purple; margin-bottom: 15px" class="fa-solid fa-eye"></i>
                                    </a>
                                    <a href="{{ route('suaPN', ['id' => $pn->MaPhieuNhap]) }}"><i style="font-size: 20px; width: 100%; text-align: center; font-weight: bold; color: green;" class="fa fa-pencil-square-o text-success text-active"></i></a>
                                    @if ($pn->TrangThai == 0)
                                        <a onclick="return confirm('Bạn có muốn xóa danh mục {{ $pn->MaPhieuNhap }} không?')" href="{{ route('xoaPN', [$pn->MaPhieuNhap]) }}"><i style="font-size: 20px; width: 100%; text-align: center; font-weight: bold; color: red;" class="fa fa-times text-danger text"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <footer class="panel-footer">
                    <div class="row">
                    <div class="col-sm-5 text-center">
                    </div>
                    <div class="col-sm-7 text-right text-center-xs">                
                        <ul class="pagination pagination-sm m-t-none m-b-none">
                        {{ $data->links('vendor.pagination.bootstrap-4') }}
                        </ul>
                    </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
@endsection  
