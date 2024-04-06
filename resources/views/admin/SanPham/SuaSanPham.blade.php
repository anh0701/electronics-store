@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật sản phẩm
            </header>
            <?php
                $status = Session::get('status');
                if ($status) {
                    echo '<span style="font-size: 17px; width: 100%; text-align: center; font-weight: bold; color: red;" class="text-alert">'.$status.'</span>';
                    Session::put('status', null);
                }
            ?>
            <div class="panel-body">
                <div class="position-center">
                    @foreach ($sanPham as $key => $value)
                    <form role="form" action="{{ Route('/SuaSanPham', [$value->MaSanPham]) }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input type="text" value="{{ $value->TenSanPham }}" class="form-control" name="TenSanPham" placeholder="Tên sản phẩm" onkeyup="ChangeToSlug();" id="slug" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" value="{{ $value->SlugSanPham }}" class="form-control" name="SlugSanPham" placeholder="Slug" id="convert_slug">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả</label>
                            <textarea id="editor2" style="resize: none" value="" rows="5" class="form-control" name="MoTa" placeholder="Mô tả sản phẩm">{{ $value->MoTa }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <input type="file" class="form-control-file" name="HinhAnh">
                            <img src="{{ asset('upload/SanPham/'.$value->HinhAnh) }}" height="100px" width="150px">
                        </div>
                        <div class="form-group" style="display: inline">
                            <label for="exampleInputEmail1">Danh mục sản phẩm</label>
                            <select name="MaDanhMuc" class="form-control input-lg m-bot15">
                                @foreach ($allDanhMuc as $key => $valueDanhMuc)
                                @if ($value->MaDanhMuc  == $valueDanhMuc->MaDanhMuc)
                                    <option selected value="{{ $valueDanhMuc->MaDanhMuc }}" >{{ $valueDanhMuc->TenDanhMuc }}</option>
                                @else
                                    <option value="{{ $valueDanhMuc->MaDanhMuc }}" >{{ $valueDanhMuc->TenDanhMuc }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Thương hiệu sản phẩm</label>
                            <select name="MaThuongHieu" class="form-control input-lg m-bot15">
                                @foreach ($allThuongHieu as $key => $valueThuongHieu)
                                @if ($value->MaThuongHieu  == $valueThuongHieu->MaThuongHieu)
                                    <option selected value="{{ $valueDanhMuc->MaThuongHieu }}" >{{ $valueThuongHieu->TenThuongHieu }}</option>
                                @else
                                    <option value="{{ $valueThuongHieu->MaThuongHieu }}" >{{ $valueThuongHieu->TenThuongHieu }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Trạng thái sản phẩm</label>
                            <select name="TrangThai" class="form-control input-lg m-bot15">
                            @if ($value->TrangThai == '1')
                                <option value="1" selected>Hiển thị</option>
                                <option value="0" >Không hiển thị</option>
                            @else
                                <option value="1" >Hiển thị</option>
                                <option value="0" selected>Không hiển thị</option>
                            @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá sản phẩm</label>
                            <input type="text" value="{{ $value->GiaSanPham }}" class="form-control" name="GiaSanPham" >
                        </div>
                        <button type="submit" name="SuaSanPham" class="btn btn-info">Cập nhật sản phẩm</button>
                    </form>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
</div>
@endsection