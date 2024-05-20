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
                        <form action="{{ route('/taoChuongTrinhGiamGia') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="TenCTGG">Tên chương trình giảm giá:</label>
                                <input type="text" class="form-control @error('TenCTGG') is-invalid @enderror"
                                       onkeyup="ChangeToSlug();" id="slug" name="TenCTGG" value="{{old('TenCTGG')}}">
                            </div>
                            @error('TenCTGG')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label for="SlugCTGG">Slug:</label>
                                <input id="convert_slug" type="text"
                                       class="form-control @error('SlugCTGG') is-invalid @enderror" name="SlugCTGG"
                                       value="{{old('SlugCTGG')}}">
                            </div>
                            @error('SlugCTGG')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label for="HinhAnh">Hình ảnh:</label>
                                <input type="file" class="form-control @error('HinhAnh') is-invalid @enderror" name="HinhAnh" placeholder="Hình ảnh">
                            </div>
                            @error('HinhAnh')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label for="MoTa">Mô tả:</label>
                                <textarea id="MoTa" style="resize: none" rows="10"
                                          class="form-control @error('MoTa') is-invalid @enderror" name="MoTa"
                                          placeholder="Mô tả">{{ old('MoTa') }}</textarea>
                            </div>
                            @error('MoTa')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label for="TrangThai">Trạng thái:</label>
                                <select name="TrangThai" class="form-control input-lg m-bot15">
                                    <option value="">--Chọn trạng thái--</option>
                                    <option value="1" {{ old('TrangThai') == '1' ? 'selected' : '' }}>Hiển thị</option>
                                    <option value="0" {{ old('TrangThai') == '0' ? 'selected' : '' }}>Ẩn</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="MaSanPham">Sản phẩm:</label>
                                <select class="form-control  @error('MaSanPham') is-invalid @enderror" id="MaSanPham" name="MaSanPham[]" multiple="multiple"
                                >
                                </select>
                            </div>
                            @error('MaSanPham')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label for="PhamTranGiam">Số phần trăm giảm giá:</label>
                                <input type="text" class="form-control @error('PhamTranGiam') is-invalid @enderror"
                                       id="PhanTramGiam" name="PhanTramGiam" value="{{old('PhanTramGiam')}}">
                            </div>
                            @error('PhanTramGiam')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <button type="submit" class="btn btn-info">Thêm chương trình giảm giá</button>
                        </form>
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
                    url: '{{ route("api.san-pham") }}',
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
                    url: '{{ route("api.san-pham") }}',
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

