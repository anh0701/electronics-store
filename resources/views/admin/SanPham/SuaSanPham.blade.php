@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật sản phẩm
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
                            <label for="exampleInputEmail1">Thương hiệu sản phẩm</label>
                            <select name="MaThuongHieu" class="form-control input-lg m-bot15">
                                @foreach ($allThuongHieu as $key => $valueThuongHieu)
                                @if ($value->MaThuongHieu  == $valueThuongHieu->MaThuongHieu)
                                    <option selected value="{{ $valueThuongHieu->MaThuongHieu }}" >{{ $valueThuongHieu->TenThuongHieu }}</option>
                                @else
                                    <option value="{{ $valueThuongHieu->MaThuongHieu }}" >{{ $valueThuongHieu->TenThuongHieu }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group row">
                            @if ($danhMuc->DanhMucCha == 0)
                                <div class="col-lg-6">
                                    <label for="exampleInputPassword1">Chọn danh mục cha</label>
                                    <select name="DanhMucCha" id="DanhMucCha" class="form-control input-lg m-bot15 SuaTSKTChoSanPham DanhMucCha">
                                        @foreach ($allDanhMuc as $key => $valueDanhMuc)
                                            @if ($value->MaDanhMuc == $valueDanhMuc->MaDanhMuc)
                                                <option selected value="{{ $valueDanhMuc->MaDanhMuc }}" >---{{ $valueDanhMuc->TenDanhMuc }}---</option>
                                            @elseif ($valueDanhMuc->DanhMucCha == 0)
                                                <option value="{{ $valueDanhMuc->MaDanhMuc }}" >{{ $valueDanhMuc->TenDanhMuc }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <label for="exampleInputPassword1">Chọn danh mục con</label>
                                    <select name="DanhMucCon" id="DanhMucCon" class="form-control input-lg m-bot15 SuaTSKTChoSanPham DanhMucCon">
                                        <option value="">--- Không có danh mục con ---</option>
                                    </select>
                                </div>
                            @elseif ($danhMuc->DanhMucCha != 0)
                                <div class="col-lg-6">
                                    <label for="exampleInputPassword1">Chọn danh mục cha</label>
                                    <select name="DanhMucCha" id="DanhMucCha" class="form-control input-lg m-bot15 SuaTSKTChoSanPham DanhMucCha">
                                        @foreach ($allDanhMuc as $key => $valueDanhMuc)
                                            @if ($valueDanhMuc->DanhMucCha == 0 && $valueDanhMuc->MaDanhMuc == $danhMuc->DanhMucCha )
                                                <option selected value="{{ $valueDanhMuc->MaDanhMuc }}" >---{{ $valueDanhMuc->TenDanhMuc }}---</option>
                                            @elseif ($valueDanhMuc->DanhMucCha == 0)
                                                <option value="{{ $valueDanhMuc->MaDanhMuc }}" >{{ $valueDanhMuc->TenDanhMuc }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <label for="exampleInputPassword1">Chọn danh mục con</label>
                                    <select name="DanhMucCon" id="DanhMucCon" class="form-control input-lg m-bot15 SuaTSKTChoSanPham DanhMucCon">
                                        <option value="">--- Chọn danh mục con ---</option>
                                        @foreach ($allDanhMuc as $key => $valueDanhMuc)
                                            @if ($valueDanhMuc->DanhMucCha != 0 && $valueDanhMuc->MaDanhMuc == $danhMuc->MaDanhMuc)
                                                <option selected value="{{ $valueDanhMuc->MaDanhMuc }}" >---{{ $valueDanhMuc->TenDanhMuc }}---</option>
                                            @elseif($valueDanhMuc->DanhMucCha != 0 && $valueDanhMuc->DanhMucCha == $danhMuc->DanhMucCha)
                                                <option value="{{ $valueDanhMuc->MaDanhMuc }}" >{{ $valueDanhMuc->TenDanhMuc }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            @foreach ($allDanhMucTSKT as $key => $valueDMTSKT)
                            <label for="exampleInputPassword1">Chọn {{ $valueDMTSKT->TenDMTSKT }}</label>
                                <select name="ThongSoKyThuat{{ $key }}" class="form-control input-lg m-bot15" style="margin-bottom: 15px">
                                    @foreach ($allTSKT as $key => $valueTSKT)
                                        @if ($valueTSKT->MaDMTSKT == $valueDMTSKT->MaDMTSKT)
                                            @foreach ($allSanPhamTSKT as $key => $valueSPTSKT)
                                                @if ($valueSPTSKT->MaTSKT == $valueTSKT->MaTSKT)
                                                    <option selected value="{{ $valueTSKT->MaTSKT }}">---{{ $valueTSKT->TenTSKT }}---</option>
                                                @elseif ($valueSPTSKT->ThongSoKyThuat->DanhMucTSKT->MaDMTSKT == $valueTSKT->MaDMTSKT)
                                                    <option value="{{ $valueTSKT->MaTSKT }}">{{ $valueTSKT->TenTSKT }}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </select>
                            @endforeach
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-3">
                                <label for="exampleInputPassword1">Chiều cao (Đơn vị cm)</label>
                                <input type="text" class="form-control" value="{{ $value->ChieuCao }}" name="ChieuCao" placeholder="Chiều cao">
                            </div>
                            <div class="col-lg-3">
                                <label for="exampleInputPassword1">Chiều ngang (Đơn vị cm)</label>
                                <input type="text" class="form-control" value="{{ $value->ChieuNgang }}" name="ChieuNgang" placeholder="Chiều ngang">
                            </div>
                            <div class="col-lg-3">
                                <label for="exampleInputPassword1">Chiều dày (Đơn vị cm)</label>
                                <input type="text" class="form-control" value="{{ $value->ChieuDay }}" name="ChieuDay" placeholder="Chiều dày">
                            </div>
                            <div class="col-lg-3">
                                <label for="exampleInputPassword1">Cân nặng (Đơn vị kg)</label>
                                <input type="text" class="form-control" value="{{ $value->CanNang }}" name="CanNang" placeholder="Cân nặng">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả</label>
                            <textarea id="MoTa" style="resize: none" value="" rows="10" class="form-control" name="MoTa" placeholder="Mô tả sản phẩm">{{ $value->MoTa }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <input type="file" class="form-control-file" name="HinhAnh">
                            <img src="{{ asset('upload/SanPham/'.$value->HinhAnh) }}" height="100px" width="150px">
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
                        <div class="form-group">
                            <label for="exampleInputEmail1">Thời gian bảo hành (theo tháng)</label>
                            <input type="text" class="form-control" value="{{ $value->ThoiGianBaoHanh }}" name="ThoiGianBaoHanh" placeholder="Thời hạn bảo hành (Theo tháng)">
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
@section('js-custom')
    <script>
        ClassicEditor
        .create(document.querySelector('#MoTa'))
        .catch(error => {
            console.error(error);
        })
    </script>
@endsection