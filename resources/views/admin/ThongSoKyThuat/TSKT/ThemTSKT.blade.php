@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm thông số kỹ thuật
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
                    <form role="form" action="{{ Route('/ThemTSKT') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên Thông số kỹ thuật</label>
                            <input type="text" class="form-control" name="TenTSKT" placeholder="Tên Thông số kỹ thuật" onkeyup="ChangeToSlug();" id="slug" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" class="form-control" name="SlugTSKT" placeholder="Slug" id="convert_slug">
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label for="exampleInputPassword1">Chọn danh mục cha</label>
                                <select name="DanhMucCha" id="DanhMucCha" class="form-control input-lg m-bot15 chonDanhMucTSKT DanhMucCha">
                                    <option value="">--- Chọn danh mục cha ---</option>
                                    @foreach ($allDanhMuc as $key => $danhMuc)
                                        @if ($danhMuc->DanhMucCha == 0)
                                            <option value="{{ $danhMuc->MaDanhMuc }}" >{{ $danhMuc->TenDanhMuc }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <label for="exampleInputPassword1">Chọn danh mục con</label>
                                <select name="DanhMucCon" id="DanhMucCon" class="form-control input-lg m-bot15 chonDanhMucTSKT DanhMucCon">
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <label for="exampleInputPassword1">Chọn danh mục TSKT</label>
                                <select name="DanhMucTSKT" id="DanhMucTSKT" class="form-control input-lg m-bot15 DanhMucTSKT">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả</label>
                            <textarea id="editor1" style="resize: none" rows="5" class="form-control" name="MoTa" placeholder="Mô tả"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Trạng thái Thông số kỹ thuật</label>
                            <select name="TrangThai" class="form-control input-lg m-bot15">
                                <option value="" >--Chọn trạng thái--</option>
                                <option value="1" >Hiển thị</option>
                                <option value="0" >Ẩn</option>
                            </select>
                        </div>
                        <button type="submit" name="ThemTSKT" class="btn btn-info">Thêm Thông số kỹ thuật</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection