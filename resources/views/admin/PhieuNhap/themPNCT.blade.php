@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Lập phiếu nhập chi tiết
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
                            $pn = Session::get('pn');
                            $listSP = Session::get('listSP');  

                        @endphp
                        <div class="form-group">
                            <label for="">Mã phiếu</label>
                            <input type="text" class="form-control" name="maPhieu" value="{{ $pn[0] }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Người lập phiếu</label>
                            <input type="text" class="form-control" name="nguoiLap" value="{{ $pn[1] }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Nhà cung cấp</label>
                            <input type="text" class="form-control" value="{{ $pn[2] }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Tổng tiền</label>
                            <input type="text" class="form-control" value="0" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Phương thức thanh toán</label>
                            <input type="text" class="form-control" value="{{ $pn[3] }}" readonly>
                        </div>
                            
                            
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
                                    <option value="">Chọn một sản phẩm</option>
                                    
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
                        <br>
                        <a href="{{ route('luuPN') }}"><button class="btn btn-info">Lưu</button></a>
                        <a href="{{ route('xoaPN', ['id' => $pn[0]]) }}"><button class="btn btn-info">Hủy</button></a>
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
                                    @foreach ($listPNCT as $pnct)
                                        <tr>
                                            <!-- <td>{{ $pnct->MaCTPN }}</td> -->
                                            <td>{{ $pnct->MaPhieuNhap }}</td>
                                            <td>{{ $pnct->TenSanPham }}</td>
                                            <td>{{ $pnct->SoLuong }}</td>
                                            <td>{{ $pnct->GiaSanPham }}</td>
                                            <td>{{ $pnct->SoLuong * $pnct->GiaSanPham }}</td>
                                            <td>
                                                <a href="{{ route('xoaCTPN', ['id' => $pnct->MaCTPN]) }}">Xóa</a>
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