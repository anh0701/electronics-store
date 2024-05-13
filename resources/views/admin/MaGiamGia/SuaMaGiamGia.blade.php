@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật mã giảm giá
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
                    @foreach ($MaGiamGia as $key => $value)
                    <form role="form" action="{{ Route('/SuaMaGiamGia', [$value->MaGiamGia]) }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên Mã giảm giá</label>
                            <input type="text" value="{{ $value->TenMaGiamGia }}" class="form-control" name="TenMaGiamGia" placeholder="Tên Mã giảm giá" onkeyup="ChangeToSlug();" id="slug">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Slug</label>
                          <input type="text" value="{{ $value->SlugMaGiamGia }}" class="form-control" name="SlugMaGiamGia" placeholder="Slug" id="convert_slug">
                        </div>
                        <div class="form-group">
                          <label>Hình ảnh</label>
                          <input type="file" class="form-control-file" name="HinhAnh">
                          <img src="{{ asset('upload/MaGiamGia/'.$value->HinhAnh) }}" height="100px" width="150px">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Trạng thái Mã giảm giá</label>
                            <select name="TinhNang" class="form-control input-lg m-bot15">
                            @if ($value->TinhNang == 1)
                                <option value="1" selected>Giảm theo phần trăm</option>
                                <option value="2" >Giảm thẳng giá</option>
                                <option value="3" >Miễn phí giao hàng</option>
                            @elseif ( $value->TinhNang == 2)
                                <option value="1" >Giảm theo phần trăm</option>
                                <option value="2" selected>Giảm thẳng giá</option>
                                <option value="3" >Miễn phí giao hàng</option>
                            @elseif ( $value->TinhNang == 3)
                                <option value="1" >Giảm theo phần trăm</option>
                                <option value="2" >Giảm thẳng giá</option>
                                <option value="3" selected>Miễn phí giao hàng</option>
                            @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Số tiền</label>
                            <input type="text" value="{{ number_format($value->SoTien, 0, '', '.') }} đ" class="form-control" name="SoTien" placeholder="Số tiền">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mã code</label>
                            <input type="text" value="{{ $value->MaCode }}" class="form-control" name="MaCode" placeholder="Mã code">
                        </div>
                        <button type="submit" name="SuaMaGiamGia" class="btn btn-info">Cập nhật Mã giảm giá</button>
                    </form>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
</div>
@endsection