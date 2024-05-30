@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê phiếu xuất
            </div>
            <div class="row w3-res-tb">
                <div class="col-sm-5 m-b-xs">
                </div>
                <div class="col-sm-2">
                </div>
                <div class="col-sm-5">
                    <form action="{{ Route('timKiemPX') }}" method="get">
                        <div class="input-group">
                            <input type="text" class="input-sm form-control" placeholder="Tìm kiếm" name="timKiem">
                            <span class="input-group-btn">
                                <button class="btn btn-sm btn-default" type="submit">Tìm kiếm</button>
                            </span>
                            <span class="input-group-btn">
                                <a class="btn btn-sm btn-default" href="{{ Route('xemPX') }}">Xem tất cả</a>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th>Mã phiếu xuất</th>
                            <th>Người lập phiếu</th>
                            <th>Tổng số lượng xuất</th>
                            <th>Trạng thái</th>
                            <th>Thời gian lập</th>

                            <th style="width:100px">Quản lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $i)
                            <tr>
                                <td>{{ $i->MaPhieuXuat }}</td>
                                <td>{{ $i->TenTaiKhoan }}</td>
                                <td>{{ $i->TongSoLuong }}</td>
                                @php 
                                    if($i->TrangThai == 0){
                                        $trangthai = "Chưa xác nhận";
                                    }elseif($i->TrangThai == 1){
                                        $trangthai = "Đã xác nhận";
                                    }else{
                                        $trangthai = "";
                                    }

                                @endphp 
                                <td>{{ $trangthai }}</td>
                                <td>{{ $i->ThoiGianTao }}</td>

                                <td>
                                    <a href="{{ route('xemCT', ['id' => $i->MaPhieuXuat]) }}">
                                    <i style="font-size: 20px; width: 100%; text-align: center; font-weight: bold; color: purple; margin-bottom: 15px" class="fa-solid fa-eye"></i>
                                    </a>
                                    <a href="{{ route('suaPX', ['id' => $i->MaPhieuXuat]) }}"><i style="font-size: 20px; width: 100%; text-align: center; font-weight: bold; color: green;" class="fa fa-pencil-square-o text-success text-active"></i></a>
                                    @if ($i->TrangThai == 0)
                                        <a onclick="return confirm('Bạn có muốn xóa phiếu xuất {{ $i->MaPhieuXuat }} không?')" href="{{ route('xoaPX', [$i->MaPhieuXuat]) }}"><i style="font-size: 20px; width: 100%; text-align: center; font-weight: bold; color: red;" class="fa fa-times text-danger text"></i></a>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Thành công',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 1500
            });
            @endif
        });
    </script>
@endsection  
