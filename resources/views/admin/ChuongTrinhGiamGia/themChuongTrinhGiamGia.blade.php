@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm chương trình giảm giá
                </header>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="panel-body">
                    <div class="position-center">
                        <form action="{{ route('/taoChuongTrinhGiamGia') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="TenCTGG">Tên chương trình giảm giá:</label>
                                <input type="text" class="form-control" onkeyup="ChangeToSlug();" id="slug" name="TenCTGG" required>
                            </div>
                            <div class="form-group">
                                <label for="SlugCTGG">Slug:</label>
                                <input id="convert_slug" type="text" class="form-control" name="SlugCTGG" required>
                            </div>
                            <div class="form-group">
                                <label for="HinhAnh">Hình ảnh:</label>
                                <input type="file" class="form-control" name="HinhAnh" placeholder="Hình ảnh">
                            </div>
                            <div class="form-group">
                                <label for="MoTa">Mô tả:</label>
                                <textarea id="MoTa" style="resize: none" rows="10" class="form-control" name="MoTa" placeholder="Mô tả"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="TrangThai">Trạng thái:</label>
                                <select name="TrangThai" class="form-control input-lg m-bot15">
                                    <option value="" >--Chọn trạng thái--</option>
                                    <option value="1" >Hiển thị</option>
                                    <option value="0" >Ẩn</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="MaSanPham">Sản phẩm:</label>
                                <select class="form-control" id="MaSanPham" name="MaSanPham" required></select>
                            </div>
                            <div class="form-group">
                                <label for="PhamTramGiam">Số phần trăm giảm giá:</label>
                                <input type="text" class="form-control" id="PhamTramGiam" name="PhamTramGiam" required>
                            </div>
                            <button type="submit" class="btn btn-info">Thêm chương trình giảm giá</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- Tải các tệp thư viện -->
    <script src="https://code.jquery.com/jquery-2.0.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#MaSanPham').select2({
                placeholder: 'Chọn sản phẩm',
                allowClear: true,
                ajax: {
                    url: '{{ route("api.san-pham") }}',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term // search term
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
        });
    </script>
@endsection

