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
                            <th>Thời gian lập</th>
                            <th>Tổng tiền</th>
                            <th>Số tiền nợ</th>
                            <th style="width:100px">Quản lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $pn)
                            <tr class="row-clickable" data-id="{{ $pn->MaPhieuNhap }}">
                                <td>{{ $pn->MaPhieuNhap }}</td>
                                <td>{{ $pn->TenTaiKhoan }}</td>
                                <td>{{ $pn->TenNhaCungCap }}</td>
                                <td>{{ $pn->ThoiGianTao }}</td>
                                <td>{{ $pn->TongTien }}</td>
                                <td>{{ $pn->TienNo }}</td>
                                <td>
                                    <a href="{{ route('xemCTPN', ['id' => $pn->MaPhieuNhap]) }}"><i style="font-size: 20px; width: 100%; text-align: center; font-weight: bold; color: green;" class="fa fa-pencil-square-o text-success text-active"></i></a>
                                    <a onclick="return confirm('Bạn có muốn xóa danh mục {{ $pn->MaPhieuNhap }} không?')" href="{{ route('xoaPN', [$pn->MaPhieuNhap]) }}"><i style="font-size: 20px; width: 100%; text-align: center; font-weight: bold; color: red;" class="fa fa-times text-danger text"></i></a>
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
