@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật chi tiết phiếu nhập 
            </header>
            <div class="panel-body">
                <div class="position-center">
                <form role="form" action="{{ route('xuLyLapPNCT') }}" method="POST" >
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="">Mã phiếu nhập:</label>
                        <input type="text" class="form-control" name="maPNSua" value="{{$maPN}}" readonly>
                    </div>
                    
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
                    </div>
                    @error('soLuong')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="">Giá sản phẩm</label>
                        <input type="text" class="form-control" name="gia" value="{{ old('gia') }}">
                    </div>
                    @error('gia')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <button type="submit" class="btn btn-info">Thêm sản phẩm</button>
                </form>
                
                <div class="table-responsive">
                    <table class="table table-striped b-t b-light">
                        <thead>
                            <tr>
                                <!-- <th>Mã phiếu nhập chi tiết</th> -->
                                <th>Mã phiếu nhập</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Giá sản phẩm</th>
                                <th>Thành tiền</th>
                                <!-- <th style="width:100px">Quản lý</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ctpn as $key => $ct)
                                <tr>
                                    <!-- <td>{{ $ct->MaCTPN }}</td> -->
                                    <td>{{ $ct->MaPhieuNhap }}</td>
                                    <td>{{ $ct->TenSanPham }}</td>
                                    <td>{{ $ct->SoLuong }}</td>
                                    <td>{{ $ct->GiaSanPham }}</td>
                                    <td>{{ $ct->SoLuong * $ct->GiaSanPham }}</td>
                                    <!-- <td>
                                        <a href="{{ route('suaCT', ['id' => $ct->MaCTPN]) }}"><i style="font-size: 20px; width: 100%; text-align: center; font-weight: bold; color: green;" class="fa fa-pencil-square-o text-success text-active"></i></a>
                                        <a onclick="return confirm('Bạn có muốn xóa danh mục {{ $ct->MaCTPN }} không?')" href="{{ route('xoaCTPN', ['id' => $ct->MaCTPN]) }}"><i style="font-size: 20px; width: 100%; text-align: center; font-weight: bold; color: red;" class="fa fa-times text-danger text"></i></a>
                                    </td> -->
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <a href="{{ route('suaPN', ['id' => $maPN]) }}"><button class="btn btn-info">Trở lại</button></a>
            </div>
        </section>
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
                    url: '{{ route("api.san-pham-pn") }}',
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
                    url: '{{ route("api.san-pham-pn") }}',
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