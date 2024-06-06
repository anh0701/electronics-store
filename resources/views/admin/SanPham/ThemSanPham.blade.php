@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm sản phẩm
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
                    <form role="form" action="{{ Route('/ThemSanPham') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input type="text" class="form-control" name="TenSanPham" placeholder="Tên sản phẩm" onkeyup="ChangeToSlug();" id="slug" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" class="form-control" name="SlugSanPham" placeholder="Slug" id="convert_slug">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Thương hiệu sản phẩm</label>
                            <select name="MaThuongHieu" class="form-control input-lg m-bot15">
                                <option value="" >--Chọn thương hiệu--</option>
                                @foreach ($allThuongHieu as $key => $thuongHieu)
                                    <option value="{{ $thuongHieu->MaThuongHieu }}" >{{ $thuongHieu->TenThuongHieu }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label for="exampleInputPassword1">Chọn danh mục cha</label>
                                <select name="DanhMucCha" id="DanhMucCha" class="form-control input-lg m-bot15 ThemTSKTChoSanPham DanhMucCha">
                                    <option value="">--Chọn danh mục cha--</option>
                                    @foreach ($allDanhMuc as $key => $danhMuc)
                                        @if ($danhMuc->DanhMucCha == 0)
                                            <option value="{{ $danhMuc->MaDanhMuc }}" >{{ $danhMuc->TenDanhMuc }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label for="exampleInputPassword1">Chọn danh mục con</label>
                                <select name="DanhMucCon" id="DanhMucCon" class="form-control input-lg m-bot15 ThemTSKTChoSanPham DanhMucCon">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-3">
                                <label for="exampleInputPassword1">Chiều cao</label>
                                <input type="text" class="form-control" name="ChieuCao" placeholder="Chiều cao">
                            </div>
                            <div class="col-lg-3">
                                <label for="exampleInputPassword1">Chiều ngang</label>
                                <input type="text" class="form-control" name="ChieuNgang" placeholder="Chiều ngang">
                            </div>
                            <div class="col-lg-3">
                                <label for="exampleInputPassword1">Chiều dày</label>
                                <input type="text" class="form-control" name="ChieuDay" placeholder="Chiều dày">
                            </div>
                            <div class="col-lg-3">
                                <label for="exampleInputPassword1">Cân nặng</label>
                                <input type="text" class="form-control" name="CanNang" placeholder="Cân nặng">
                            </div>
                        </div>
                        <div class="form-group DanhMucTSKT" id="DanhMucTSKT" name="DanhMucTSKT">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả</label>
                            <textarea id="MoTa" style="resize: none" rows="10" class="form-control" name="MoTa" placeholder="Mô tả"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Chọn hình ảnh</label>
                            <input type="file" class="form-control" name="HinhAnh" placeholder="Hình ảnh">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Trạng thái sản phẩm</label>
                            <select name="TrangThai" class="form-control input-lg m-bot15">
                                <option value="" >--Chọn trạng thái--</option>
                                <option value="1" >Hiển thị</option>
                                <option value="0" >Ẩn</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá sản phẩm</label>
                            <input type="text" class="form-control" name="SoTien" placeholder="Giá sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Thời gian bảo hành (theo tháng)</label>
                            <input type="text" class="form-control" name="ThoiGianBaoHanh" placeholder="Thời hạn bảo hành (Theo tháng)">
                        </div>
                        <button type="submit" name="ThemSanPham" class="btn btn-info">Thêm sản phẩm</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
@section('js-custom')
    <script>
        ClassicEditor
        .create(document.querySelector('#MoTa'))
        .catch(error => {
            console.error(error);
        })
    </script>
@endsection