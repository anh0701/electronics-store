@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm thông số kỹ thuật cho sản phẩm
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
                    <form role="form" action="{{ Route('/ThemSanPhamTSKT') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label for="exampleInputPassword1">Chọn danh mục cha</label>
                                <select name="DanhMucCha" id="DanhMucCha" class="form-control input-lg m-bot15 ChangeTable chonDanhMucTSKT DanhMucCha">
                                    <option value="">--- Chọn danh mục cha ---</option>
                                    @foreach ($allDanhMuc as $key => $danhMuc)
                                        @if ($danhMuc->DanhMucCha == 0)
                                            <option value="{{ $danhMuc->MaDanhMuc }}" >{{ $danhMuc->TenDanhMuc }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label for="exampleInputPassword1">Chọn danh mục con</label>
                                <select name="DanhMucCon" id="DanhMucCon" class="form-control input-lg m-bot15 ChangeTable chonDanhMucTSKT DanhMucCon">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label for="exampleInputPassword1">Chọn danh mục Thông số kỹ thuật</label>
                                <select name="DanhMucTSKT" id="DanhMucTSKT" class="form-control input-lg m-bot15 chonDanhMucTSKT DanhMucTSKT">
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label for="exampleInputPassword1">Chọn thông số kỹ thuật</label>
                                <select name="ThongSoKyThuat" id="ThongSoKyThuat" class="form-control input-lg m-bot15 ThongSoKyThuat">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        {{-- <div class="form-group row">
                            <div class="col-lg-12">
                                <label for="exampleInputPassword1">Chọn sản phẩm</label>
                                <select name="SanPham" id="SanPham" class="form-control input-lg m-bot15 SanPham">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div> --}}
                        <div class="form-group row">
                            <label for="exampleInputPassword1">Bảng sản phẩm dựa theo danh mục</label>
                            <table name="SanPham" id="SanPham" class="table table-striped b-t b-light SanPham">
                                {{-- <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th style="width: 100px">Tên sản phẩm</th>
                                        <th>Tên thương hiệu</th>
                                        <th>Hình ảnh</th>
                                        <th style="width:100px;">Quản lý</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allSanPham as $key => $sanPham)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $sanPham->TenSanPham }}</td>
                                        <td>{{ $sanPham->ThuongHieu->TenThuongHieu }}</td>
                                        <td><img src="{{ asset('upload/SanPham/'.$sanPham->HinhAnh) }}" height="100px" width="150px"></td>
                                        <td>
                                            <a href="{{ route('/ThemSanPhamTSKT', $sanPham->MaSanPham) }}" type="button" class="btn btn-default add-to-cart">
                                                Thêm thông số kỹ thuật
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody> --}}
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection