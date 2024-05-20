@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật nhà cung cấp
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
                @foreach ($data as $item)
                    <form role="form" id="from" action="/xuLySuaNCC" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="maNCC">Mã nhà cung cấp</label>  
                            <input class="form-control" type="text" id="maNCC" name="maNCC" value="{{ $item->MaNhaCungCap }}" readonly class="gray-background">
                        </div>
                        <div class="form-group">
                            <label for="tennhacungcap">Tên nhà cung cấp</label>
                            <input class="form-control" type="text" id="tennhacungcap" name="tennhacungcap" value="{{ $item->TenNhaCungCap }}">
                        </div>
                        <div class="form-group">
                            <label for="diachi">Địa chỉ</label>  
                            <input class="form-control" type="text" id="diachi" name="diachi" value="{{ $item->DiaChi }}" >    
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>                   
                            <input class="form-control" type="text" id="email" name="email" value="{{ $item->Email }}">
                        </div>
                        <div class="form-group">
                            <label for="sdt">Số điện thoại</label>                 
                            <input class="form-control" type="text" id="sdt" name="sdt" value="{{ $item->SoDienThoai }}">
                        </div>
                        <div class="form-group">
                            <label for="thoigiansua">Thời gian sửa</label>             
                            <input class="form-control" type="text" id="thoigiansua" name="thoigiansua" value="{{ $item->ThoiGianSua }}" readonly class="gray-background">
                        </div>
                        <button type="submit" class="btn btn-info">Lưu</button>
                    </form>
                @endforeach
                </div>
            </div>
        </section>
    </div>
</div>
@endsection