@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Sửa chương trình giảm giá
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form action="{{ route('/suaChuongTrinhGiamGia', [$suaCT->MaCTGG]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="TenCTGG">Tên chương trình giảm giá:</label>
                                <input type="text" class="form-control @error('TenCTGG') is-invalid @enderror"
                                       onkeyup="ChangeToSlug();" id="slug" name="TenCTGG" value="{{ old('TenCTGG', $suaCT->TenCTGG) }}">
                            </div>
                            @error('TenCTGG')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group">
                                <label for="SlugCTGG">Slug:</label>
                                <input id="convert_slug" type="text"
                                       class="form-control @error('SlugCTGG') is-invalid @enderror" name="SlugCTGG"
                                       value="{{ old('SlugCTGG', $suaCT->SlugCTGG) }}">
                            </div>
                            @error('SlugCTGG')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group">
                                <label for="HinhAnh">Hình ảnh:</label>
                                <input type="file" class="form-control @error('HinhAnh') is-invalid @enderror" id="HinhAnh" name="HinhAnh">
                                @if($suaCT->HinhAnh)
                                    <img src="{{ asset($suaCT->HinhAnh) }}" alt="{{ $suaCT->TenCTGG }}" width="100">
                                @endif
                            </div>
                            @error('HinhAnh')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group">
                                <label for="MoTa">Mô tả:</label>
                                <textarea id="MoTa" style="resize: none" rows="10"
                                          class="form-control @error('MoTa') is-invalid @enderror" name="MoTa"
                                          placeholder="Mô tả">{{ old('MoTa', $suaCT->MoTa) }}</textarea>
                            </div>
                            @error('MoTa')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group">
                                <label for="TrangThai">Trạng thái:</label>
                                <select name="TrangThai" class="form-control @error('TrangThai') is-invalid @enderror" required>
                                    <option value="1" {{ old('TrangThai', $suaCT->TrangThai) == '1' ? 'selected' : '' }}>Hiển thị</option>
                                    <option value="0" {{ old('TrangThai', $suaCT->TrangThai) == '0' ? 'selected' : '' }}>Ẩn</option>
                                </select>
                            </div>
                            @error('TrangThai')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label for="exampleInputPassword1">Thời gian có hiệu lực</label>
                                <input type="datetime-local" class="form-control @error('ThoiGianBatDau') is-invalid @enderror"
                                       name="ThoiGianBatDau" value="{{old('ThoiGianBatDau', $suaCT->ThoiGianBatDau)}}">
                            </div>
                            @error('ThoiGianBatDau')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label for="exampleInputPassword1">Thời gian hết hiệu lực</label>
                                <input type="datetime-local" class="form-control @error('ThoiGianKetThuc') is-invalid @enderror"
                                       name="ThoiGianKetThuc" value="{{old('ThoiGianKetThuc', $suaCT->ThoiGianKetThuc)}}">
                            </div>
                            @error('ThoiGianKetThuc')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group">
                                <label for="MaSanPham">Sản phẩm:</label>
                                <select class="form-control select2  @error('MaSanPham') is-invalid @enderror" id="MaSanPham" name="MaSanPham[]"  multiple="multiple">
                                    @foreach($suaCT->chuongTrinhGiamGiaSPs as $sp)
                                        <option value="{{ $sp->SanPham->MaSanPham }}" selected>{{ $sp->SanPham->TenSanPham }}</option>
                                    @endforeach
                                </select>
                                @error('MaSanPham')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="PhanTramGiam">Số phần trăm giảm giá:</label>
                                <input type="text" class="form-control @error('PhanTramGiam') is-invalid @enderror"
                                       id="PhanTramGiam" name="PhanTramGiam" value="{{old('PhanTramGiam', $ChuongTrinhGiamGiaSP->PhanTramGiam)}}">
                            </div>
                            @error('PhanTramGiam')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <button type="submit" class="btn btn-info">Sửa chương trình giảm giá</button>
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
        $(document).ready(function() {
            $('.select2').select2({
                ajax: {
                    url: '{{ route('sanpham.list') }}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    id: item.MaSanPham,
                                    text: item.TenSanPham
                                };
                            })
                        };
                    },
                    cache: true
                },
                minimumInputLength: 2,
                placeholder: 'Chọn sản phẩm',
                allowClear: true
            });
        });
    </script>


@endsection

