@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm thương hiệu sản phẩm
            </header>
            <?php
                $status = Session::get('status');
                if ($status) {
                    echo '<span style="margin-left: 5px;font-size: 17px; width: 100%; text-align: center; font-weight: bold; color: red;" class="text-alert">'.$status.'</span>';
                    Session::put('status', null);
                }
            ?>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{ Route('/ThemThuongHieu') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên thương hiệu</label>
                            <input type="text" class="form-control" name="TenThuongHieu" placeholder="Tên thương hiệu" onkeyup="ChangeToSlug();" id="slug" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" class="form-control" name="SlugThuongHieu" placeholder="Slug" id="convert_slug">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả</label>
                            <textarea id="editor1" style="resize: none" rows="5" class="form-control" name="MoTa" placeholder="Mô tả"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Chọn hình ảnh</label>
                            <input type="file" class="form-control" name="HinhAnh" placeholder="Hình ảnh">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Trạng thái thương hiệu</label>
                            <select name="TrangThai" class="form-control input-lg m-bot15">
                                <option value="1" >Hiển thị</option>
                                <option value="0" >Ẩn</option>
                            </select>
                        </div>
                        <button type="submit" name="ThemThuongHieu" class="btn btn-info">Thêm thương hiệu</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection