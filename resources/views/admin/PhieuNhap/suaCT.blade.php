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
                <form role="form" action="{{ route('suaCT2') }}" method="POST" >
                    {{ csrf_field() }}
                    @foreach ($ct as $i)
                        <div class="form-group">
                            <label for="">Mã CTPN</label>
                            <input type="text" class="form-control" name="maCT" value="{{ $i->MaCTPN }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Mã phiếu nhập</label>
                            <input type="text" class="form-control" name="maPN" value="{{ $i->MaPhieuNhap }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Tên sản phẩm</label>
                            <input type="text" class="form-control" name="tenSP" value="{{ $i->TenSanPham }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Số lượng</label>
                            <input type="text" class="form-control" name="soLuong" value="{{ $i->SoLuong }}">
                        </div>
                        <div class="form-group">
                            <label for="">Giá sản phẩm</label>
                            <input type="text" class="form-control" name="gia" value="{{ $i->GiaSanPham }}">
                        </div>
                    @endforeach
                    
                    <button type="submit" class="btn btn-info">Lưu</button>
                </form>

            </div>
        </section>
    </div>
</div>
@endsection