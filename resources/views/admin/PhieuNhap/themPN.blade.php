@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Lập phiếu nhập 
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
                    <form role="form" action="{{ Route('xuLyLapPN') }}" method="POST" >
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="">Người lập phiếu</label>
                            <input type="text" class="form-control" name="nguoiLap" value="{{ $nguoiLap }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Nhà cung cấp</label>
                            <select class="form-control input-lg m-bot15" id="maNCC" name="maNCC">
                                <option value="">Chọn một nhà cung cấp</option>
                                @foreach($listNCC as $ncc)
                                    <option value="{{ $ncc->MaNhaCungCap . '/' . $ncc->TenNhaCungCap }}">{{ $ncc->TenNhaCungCap }}</option>
                                @endforeach
                                <option value="new">Thêm nhà cung cấp mới</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Tổng tiền</label>
                            <input type="text" class="form-control" name="tongTien" value="0" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Phương thức thanh toán</label>
                            <select name="thanhToan" class="form-control input-lg m-bot15">
                                <option value="0" >Chuyển khoản</option>
                                <option value="1" >Tiền mặt</option>
                                <option value="2" >Khác</option>
                            </select>
                        </div>

                        <button type="submit" name="" class="btn btn-info">Lập phiếu nhập</button>
                       
                    </form>
                    <div>
                        
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection