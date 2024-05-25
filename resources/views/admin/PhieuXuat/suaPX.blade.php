@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật phiếu xuất
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
                    <form role="form" action="{{ Route('suaPXP') }}" method="POST" >
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="maPX">Mã phiếu:</label>
                            <input class="form-control" class="in1" type="text" id="maPX" name="maPX" value="{{ $px->MaPhieuXuat }}" readonly class="gray-background">
                        </div>
                        <div class="form-group">
                            <label for="nguoiLap">Người lập:</label>
                            <input class="form-control" type="text" id="nguoiLap" name="nguoiLap" value="{{ $px->TenTaiKhoan }}" readonly class="gray-background">
                        </div>
                        <div class="form-group">
                            <label for="tongTien">Tổng số lượng:</label>
                            <input class="form-control" type="text" id="tongTien" name="tongTien" value="{{ $px->TongSoLuong }}" readonly class="gray-background">
                        </div>
                        <div class="form-group">
                            <label for="trangThai">Trạng thái:</label>
                            <input type="hidden" class="form-control" name="trangThaiTruoc" value="{{ $px->TrangThai }}" readonly>
                            <select name="trangThai" class="form-control input-lg m-bot15">
                                <option value="0" >Chưa xác nhận</option>
                                <option value="1" >Xác nhận</option>
                            </select>
                        </div>
                        <button type="submit" name="" class="btn btn-info">Lưu</button>
                    </form>
                    @if ($px->TrangThai == 0)
                        <form role="form" action="{{ route('taoPXCT', ['id' => $px->MaPhieuXuat]) }}" method="POST" >
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="MaSanPham">Sản phẩm:</label>
                                <select class="form-control  @error('MaSanPham') is-invalid @enderror" id="MaSanPham" name="maSP" 
                                >
                                </select>
                            </div>
                            @error('maSP')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label for="">Số lượng</label>
                                <input type="text" class="form-control" name="soLuong" value="{{ old('soLuong') }}">
                                <input type="hidden" class="form-control" name="page" value="sua">
                            </div>
                            @error('soLuong')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <button type="submit" class="btn btn-info">Thêm sản phẩm</button>
                        </form>
                    @endif
                </div>
            </div>
        </section>
    </div>
</div>
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê sản phẩm trong phiếu xuất
        </div>
        <div class="row w3-res-tb">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-3">
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th style="width:100px">Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ct as $i)
                        <tr>
                            <td>{{ $i->TenSanPham }}</td>
                            <td>{{ $i->SoLuong }}</td>
                            <td>
                                <a href=""><i style="font-size: 20px; width: 100%; text-align: center; font-weight: bold; color: green;" class="fa fa-pencil-square-o text-success text-active"></i></a>
                                <a onclick="return confirm('Bạn có muốn xóa chi tiết phiếu {{ $i->MaCTPX }} không?')" href="{{ route('xoaCTS', ['id' => $i->MaCTPX]) }}"><i style="font-size: 20px; width: 100%; text-align: center; font-weight: bold; color: red;" class="fa fa-times text-danger text"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
        $(document).ready(function () {
            var selectedValues = {!! json_encode(old('MaSanPham')) !!};

            $('#MaSanPham').select2({
                placeholder: 'Chọn sản phẩm',
                allowClear: true,
                ajax: {
                    url: '{{ route("api.san-pham-px") }}',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term // từ khóa tìm kiếm
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            });

            // Khởi tạo lại giá trị đã chọn nếu có
            if (selectedValues) {
                $.ajax({
                    url: '{{ route("api.san-pham-px") }}',
                    dataType: 'json',
                    data: {
                        ids: selectedValues // gửi các ID của sản phẩm để lấy thông tin
                    },
                    success: function (data) {
                        var selectedOptions = [];
                        $.each(data, function (index, item) {
                            selectedOptions.push({
                                id: item.id,
                                text: item.text
                            });
                            $('#MaSanPham').append(new Option(item.text, item.id, true, true)).trigger('change');
                        });
                    }
                });
            }
        });
    </script>
@endsection
