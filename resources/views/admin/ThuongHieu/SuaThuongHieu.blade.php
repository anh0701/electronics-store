@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật thương hiệu sản phẩm
            </header>
            @php
                $status = Session::get('status');
                if ($status) {
                    echo '<span style="font-size: 17px; width: 100%; text-align: center; font-weight: bold; color: red;" class="text-alert">'.$status.'</span>';
                    Session::put('status', null);
                }
            @endphp
            <div class="panel-body">
                <div class="position-center">
                    @foreach ($thuongHieu as $key => $value)
                    <form role="form" action="{{ Route('/SuaThuongHieu', [$value->MaThuongHieu]) }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên thương hiệu</label>
                            <input type="text" value="{{ $value->TenThuongHieu }}" class="form-control" name="TenThuongHieu" placeholder="Tên thương hiệu" onkeyup="ChangeToSlug();" id="slug">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Slug</label>
                          <input type="text" value="{{ $value->SlugThuongHieu }}" class="form-control" name="SlugThuongHieu" placeholder="Slug" id="convert_slug">
                      </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả</label>
                            <textarea id="editor2" style="resize: none" value="" rows="5" class="form-control" name="MoTa" placeholder="Mô tả thương hiệu">{{ $value->MoTa }}</textarea>
                        </div>
                        <div class="form-group">
                          <label>Hình ảnh</label>
                          <input type="file" class="form-control-file" name="HinhAnh">
                          <img src="{{ asset('upload/ThuongHieu/'.$value->HinhAnh) }}" height="100px" width="150px">
                      </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Trạng thái thương hiệu</label>
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
                        <button type="submit" name="SuaThuongHieu" class="btn btn-info">Cập nhật thương hiệu</button>
                    </form>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
</div>
@endsection