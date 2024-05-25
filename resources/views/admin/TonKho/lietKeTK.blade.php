@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê sản phẩm trong kho
        </div>
        <div class="row w3-res-tb">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-3">
            </div>
        </div>
        <a href="{{ route('xemPN')}}"><button class="btn btn-info">Xem phiếu nhập</button></a>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng hiện tại</th>
                        <th>Số lượng bán</th>
                        <th>Số lượng trong kho</th>                       
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $sp)
                        <tr>
                            <td>{{ $sp->TenSanPham }}</td>
                            <td>{{ $sp->SoLuongHienTai }}</td>
                            <td>{{ $sp->SoLuongBan }}</td>
                            <td>{{ $sp->SoLuongTrongKho }}</td>

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
