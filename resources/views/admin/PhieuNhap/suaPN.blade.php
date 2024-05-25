@extends('admin_layout')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật phiếu nhập 
            </header>
            <div class="panel-body">
                <div class="position-center">

                @php 
                    $user = session(('user'));
                    $quyen = $user['Quyen'];

                @endphp 
                    <form role="form" action="{{ Route('xuLySuaPN') }}" method="POST" >
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="">Mã phiếu</label>
                            <input type="text" class="form-control" name="maPN" value="{{ $pn->MaPhieuNhap }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Người lập phiếu</label>
                            <input type="text" class="form-control" name="nguoiLap" value="{{ $pn->TenTaiKhoan }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Nhà cung cấp</label>
                            <input type="text" class="form-control" name="ncc" value="{{ $pn->TenNhaCungCap }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Tổng tiền</label>
                            <input type="text" class="form-control" name="tongTien" value="{{ $pn->TongTien }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Tiền đã trả</label>
                            <input type="text" class="form-control" name="tienTra" value="{{ $pn->TienTra }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Tiền trả thêm</label>
                            <input type="text" class="form-control" name="tienTraMoi" value="0">
                        </div>
                        <div class="form-group">
                            <label for="">Tiền nợ</label>
                            <input type="text" class="form-control" name="tienNo" value="{{ $pn->TienNo }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Phương thức thanh toán</label>
                            <select name="thanhToan" class="form-control input-lg m-bot15">
                                <option value="0" >Chuyển khoản</option>
                                <option value="1" >Tiền mặt</option>
                                <option value="2" >Khác</option>
                            </select>
                        </div>
                        
                        
                        <div class="form-group" style="{{ $quyen != 'Quản trị viên cấp cao' ? 'display: none;' : '' }}">
                            <label for="">Trạng thái</label>
                            <input type="hidden" id="mySelect1" class="form-control" name="trangThaiTruoc" value="{{ $pn->TrangThai }}">
                            <select name="trangThai" id="mySelect" class="form-control input-lg m-bot15">
                                <option value="0" {{ $pn->TrangThai == '0' ? 'selected' : '' }}>Chưa xác nhận</option>
                                <option value="1" {{ $pn->TrangThai == '1' ? 'selected' : '' }}>Xác nhận</option>
                            </select>
                        </div>
                        
                        
                        
                        
                        

                        <button type="submit" name="" class="btn btn-info">Lưu</button>
                        
                    </form>
                    <form id="myLink3" role="form" action="{{ route('xuLyLapPNCT') }}" method="POST" style="border: 1px solid #333; padding:2px 3px;">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="">Mã phiếu nhập:</label>
                            <input type="text" class="form-control" name="maPNSua" value="{{$pn->MaPhieuNhap}}" readonly>
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
                            <input type="number" class="form-control" name="soLuong" value="{{ old('soLuong') }}">
                        </div>
                        @error('soLuong')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="">Giá sản phẩm</label>
                            <input type="number" class="form-control" name="gia" value="{{ old('gia') }}">
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

                                    <th style="width:100px" id="myLink4">Quản lý</th>                  
                                    
                                </tr>
                            </thead>
                            <tbody>
                               
                                @foreach ($ctpn as $ct)

                                    <tr>
                                        <td>{{ $ct->MaPhieuNhap }}</td>
                                        <td>{{ $ct->TenSanPham }}</td>
                                        <td><input type="number" value="{{ $ct->SoLuong }}" id="soLuong_{{ $ct->MaCTPN }}"></td>
                                        <td><input type="number" value="{{ $ct->GiaSanPham }}" id="giaSanPham_{{ $ct->MaCTPN }}"></td>
                                        <td id="thanhTien_{{ $ct->MaCTPN }}">{{ $ct->SoLuong * $ct->GiaSanPham }}</td>

                                        <td id = "myLink">
                                            <a href="javascript:void(0);" class="update-btn" data-id="{{ $ct->MaCTPN }}">Cập nhật</a>
                                            <a onclick="return confirm('Bạn có muốn xóa danh mục {{ $ct->MaCTPN }} không?')" href="{{ route('xoaCTS', ['id' => $ct->MaCTPN]) }}">
                                                <i style="font-size: 20px; width: 100%; text-align: center; font-weight: bold; color: red;" class="fa fa-times text-danger text"></i>
                                            </a>
                                        </td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div id="responseMessage"></div>
                </div>
            </div>
        </section>
    </div>
</div>
<script>

function handleChange() {
    if ($('#mySelect').val() == '1') {
        $('[id^="myLink"]').hide();
    } else {
        if ($('#mySelect1').val() == '0'){
            $('[id^="myLink"]').show();
        }
        
    }
}

// Sử dụng sự kiện change và gọi hàm onChange
$(document).ready(function() {
    handleChange();
    $('#mySelect').change(handleChange);
});
</script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
$(document).ready(function() {
    $('.update-btn').on('click', function() {
        var MaCTPN = $(this).data('id');
        var soLuong = $('#soLuong_' + MaCTPN).val();
        var giaSanPham = $('#giaSanPham_' + MaCTPN).val();

        $.ajax({
            url: '{{ route('update.soluong') }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                MaCTPN: MaCTPN,
                soLuong: soLuong,
                giaSanPham: giaSanPham
            },
            success: function(data) {
                if (data.success) {
                    var thanhTien = soLuong * giaSanPham;
                    
                    // Cập nhật thành tiền trên giao diện
                    $('#thanhTien_' + MaCTPN).text(thanhTien);
                    $('#responseMessage').text('Cập nhật thành công').css('color', 'green');
                } else {
                    $('#responseMessage').text('Cập nhật thất bại: ' + data.message).css('color', 'red');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                $('#responseMessage').text('Có lỗi xảy ra: ' + error).css('color', 'red');
            }
        });
    });
});
</script>

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