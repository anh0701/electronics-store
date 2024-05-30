@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm chương trình giảm giá
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
                    <form role="form" action="{{ Route('/ThemCTGGVaoSession') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên chương trình giám giá</label>
                            <input type="text" class="form-control" name="TenCTGG" placeholder="Tên chương trình giám giá"
                             onkeyup="ChangeToSlug();" id="slug"  value="{{old('TenCTGG')}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug chương trình giảm giá</label>
                            <input type="text" class="form-control" name="SlugCTGG" placeholder="Slug" id="convert_slug" value="{{old('SlugCTGG')}}" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả</label>
                            <textarea id="editor1" style="resize: none" rows="5" class="form-control" value="{{old('MoTa')}}" name="MoTa" placeholder="Mô tả"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Trạng thái chương trình giám giá</label>
                            <select name="TrangThai" value="{{old('TrangThai')}}" class="form-control input-lg m-bot15">
                                <option value="1" >Hiển thị</option>
                                <option value="0" >Ẩn</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Thời gian có hiệu lực</label>
                            <input type="datetime-local" value="{{old('ThoiGianBatDau')}}" class="form-control" name="ThoiGianBatDau" placeholder="Chọn thời gian bắt đầu" value="{{old('ThoiGianBatDau')}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Thời gian hết hiệu lực</label>
                            <input type="datetime-local" value="{{old('ThoiGianKetThuc')}}" class="form-control" name="ThoiGianKetThuc" placeholder="Chọn thời gian kết thúc" value="{{old('ThoiGianKetThuc')}}">
                        </div>
                        <button type="submit" name="ThemCTGGVaoSession" class="btn btn-info">Thêm sản phẩm thuộc chương trình giám giá</button>
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