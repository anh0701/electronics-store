@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm mã giảm giá
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
                    <form role="form" action="{{ Route('/ThemMaGiamGia') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên mã giảm giá</label>
                            <input type="text" class="form-control" name="TenMaGiamGia" placeholder="Tên mã giảm giá" onkeyup="ChangeToSlug();" id="slug" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" class="form-control" name="SlugMaGiamGia" placeholder="Slug" id="convert_slug">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tính năng mã giảm giá</label>
                            <select name="TinhNang" class="form-control input-lg m-bot15">
                                <option value="" >--- Chọn tính năng của mã giảm giá ---</option>
                                <option value="1" >Giảm theo phần trăm</option>
                                <option value="2" >Giảm thẳng giá</option>
                                <option value="3" >Miễn phí giao hàng</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Số tiền giảm</label>
                            <input type="text" class="form-control" name="SoTien" placeholder="Số tiền giảm">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mã code</label>
                            <input type="text" class="form-control" name="MaCode" placeholder="Mã code">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Chọn hình ảnh</label>
                            <input type="file" class="form-control" name="HinhAnh" placeholder="Hình ảnh">
                        </div>
                        <button type="submit" name="ThemMaGianGia" class="btn btn-info">Thêm mã giảm giá</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection