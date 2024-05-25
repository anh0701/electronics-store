@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Lập phiếu xuất
            </header>
            <div class="panel-body">
                <div class="position-center">
                        <form role="form" action="{{ route('taoPXCT', ['id' => $maPX]) }}" method="POST" >
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
                                <input type="hidden" class="form-control" name="page" value="tao">
                            </div>
                            @error('soLuong')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <button type="submit" class="btn btn-info">Thêm sản phẩm</button>
                        </form>
                        <br>
                        <a href="{{ route('luuPX', ['id' => $maPX]) }}"><button class="btn btn-info">Lưu</button></a>
                        <a href="{{ route('xoaPX', ['id' => $maPX]) }}"><button class="btn btn-info">Hủy</button></a>
                        <div class="table-responsive">
                            <table class="table table-striped b-t b-light">
                                <thead>
                                    <tr>
                                        <!-- <th>Mã phiếu nhập chi tiết</th> -->
                                        <th>Mã phiếu xuất</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th style="width:100px">Quản lý</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </section>
    </div>
</div>

<!-- Tải các tệp thư viện -->
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