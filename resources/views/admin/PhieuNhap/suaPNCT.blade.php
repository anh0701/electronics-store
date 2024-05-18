@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật chi tiết phiếu nhập 
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
    
                @php
                    $maPN = Session::get('maPN');
                    $listSP = Session::get('listSP');  
                @endphp
                <form role="form" action="/timKiemSP" method="get">
                    <div class="form-group">
                        <input type="text" class="form-control" name="tkSP" placeholder="Nhập từ khóa">
                        <button type="submit" class="btn btn-info">Tìm kiếm</button>
                    </div>
                </form>
                <form role="form" action="{{ route('xuLyLapPNCT') }}" method="POST" >
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="">Tên sản phẩm</label>
                        <select class="form-control input-lg m-bot15" id="maSP" name="maSP">
                            <!-- <option value="">Chọn một sản phẩm</option> -->
                            
                            @if(!is_null($listSP))
                                @foreach($listSP as $sp)
                                    <option value="{{ $sp->MaSanPham }}">{{ $sp->TenSanPham }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Số lượng</label>
                        <input type="text" class="form-control" name="soLuong" value="{{ old('soLuong') }}">
                    </div>
                    <div class="form-group">
                        <label for="">Giá sản phẩm</label>
                        <input type="text" class="form-control" name="gia" value="{{ old('gia') }}">
                    </div>
                    <button type="submit" class="btn btn-info">Thêm sản phẩm</button>
                </form>
                
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
                            @foreach ($ctpn as $key => $ct)
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
                <a href="{{ route('suaPN', ['id' => $maPN]) }}"><button class="btn btn-info">Trở lại</button></a>
            </div>
        </section>
    </div>
</div>
@endsection