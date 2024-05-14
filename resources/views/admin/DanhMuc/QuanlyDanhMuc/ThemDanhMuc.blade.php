@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm danh mục sản phẩm
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
                    <form role="form" action="{{ Route('/ThemDanhMuc') }}" method="POST" >
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" class="form-control" name="TenDanhMuc" placeholder="Tên danh mục" onkeyup="ChangeToSlug();" id="slug" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" class="form-control" name="SlugDanhMuc" placeholder="Slug" id="convert_slug">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả</label>
                            <textarea id="editor1" style="resize: none" rows="5" class="form-control" name="MoTa" placeholder="Mô tả"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Thuộc danh mục</label>
                            <select name="DanhMucCha" class="form-control input-lg m-bot15">
                                <option value="0" >---Không thuộc danh mục nào---</option>
                                @foreach ($allDanhMuc as $key => $danhMuc)
                                    <option value="{{ $danhMuc->MaDanhMuc }}" >{{ $danhMuc->TenDanhMuc }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Trạng thái danh mục</label>
                            <select name="TrangThai" class="form-control input-lg m-bot15">
                                <option value="1" >Hiển thị</option>
                                <option value="0" >Ẩn</option>
                            </select>
                        </div>
                        <button type="submit" name="ThemDanhMuc" class="btn btn-info">Thêm danh mục</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection