@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê nhà cung cấp
            </div>
            <div class="row w3-res-tb">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-3">
                    <div class="input-group">
                        <form action="{{ route('timkiemNCC') }}" method="GET">
                            <input type="text" name="keyword" placeholder="Nhập từ khóa..."><br>

                            <button type="submit">Tìm kiếm</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th>Tên nhà cung cấp</th>
                            <th>Địa chỉ</th>
                            <th>SDT</th>
                            <th>Email</th>
                            <th>Trạng thái</th>
                            <th>Thời gian tạo</th>
                            <th style="width:100px">Quản lý</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $ncc)
                            <tr class="row-clickable" data-id="{{ $ncc->MaNhaCungCap }}">
                                <!-- <td>{{ $ncc->MaNhaCungCap }}</td> -->
                                <td>{{ $ncc->TenNhaCungCap }}</td>
                                <td>{{ $ncc->DiaChi }}</td>
                                <td>{{ $ncc->SoDienThoai }}</td>
                                <td>{{ $ncc->Email }}</td>
                                @php
                                    if($ncc->TrangThai == 1){
                                        $tt = 'Hợp tác';
                                    }else $tt = 'Ngừng hợp tác';
                                @endphp
                                <td>{{ $tt }}</td>
                                <td>{{ $ncc->ThoiGianTao }}</td>
                                <!-- <td>{{ $ncc->ThoiGianSua }}</td> -->
                                <td>
                                    <a href="{{ route('suaNCC', ['id' => $ncc->MaNhaCungCap]) }}"><i style="font-size: 20px; width: 100%; text-align: center; font-weight: bold; color: green;" class="fa fa-pencil-square-o text-success text-active"></i></a>
                                    <a onclick="return confirm('Bạn có muốn xóa nhà cung cấp {{ $ncc->TenNhaCungCap }} không?')" href="{{ route('xoaNCC', ['id' => $ncc->MaNhaCungCap]) }}"><i style="font-size: 20px; width: 100%; text-align: center; font-weight: bold; color: red;" class="fa fa-times text-danger text"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        

    </div>
@endsection  