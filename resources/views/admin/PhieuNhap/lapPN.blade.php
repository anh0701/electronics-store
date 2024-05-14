<!DOCTYPE html>
<html>
<head>
    <title>Tạo mới Phiếu Nhập</title>
    <link rel="stylesheet" href="{{ asset('/css/xem.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css')}}" >
    
</head>
<body>
    <h1>Tạo mới Phiếu Nhập</h1>
    <h2>Moi ban nhap thong tin trong phieu nhap:</h2>
    <form action="/xuLyLapPN" method="post">
        @csrf
        <div class="error-message">
            @if ($errors->has('maNCC') || $errors->has('tienTra') || $errors->has('matHang'))
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
        <label for="nguoiLap">Nguoi Lap:</label><br>
        <input type="text" id="nguoiLap" name="nguoiLap" value="{{ $nguoiLap }}" readonly class="gray-background"><br>
        <label for="maNCC">MaNCC:</label><br>
        <select id="maNCC" name="maNCC" onchange="redirectToNewNCC()">
            <option value="">Chọn một nhà cung cấp</option>
            @foreach($listNCC as $ncc)
                <option value="{{ $ncc->MaNhaCungCap }}">{{ $ncc->TenNhaCungCap }}</option>
            @endforeach
            <option value="new">Thêm nhà cung cấp mới</option>
        </select>
        <input type="hidden" id="tongTien" name="tongTien" value="{{ $tongTien }}"><br>
        <label for="soTienTra">SoTienTra:</label><br>
        <input type="number" id="soTienTra" name="soTienTra" value="0" min="0" step="10000"><br>
        <label for="pttt">Phuong thuc thanh toan:</label><br>
        <select id="pttt" name="pttt">
            <option value="CK">Chuyen khoan</option>
            <option value="TM">Tien mat</option>
            <option value="Khac">Khac</option>
        </select><br>
        <!-- Thêm các trường khác của phiếu nhập -->
        <button type="submit">Lưu</button>
    </form>
    <h2>Moi ban nhap thong tin cac mat hang trong phieu nhap:</h2>
    <form action="/xuLyThemMatHang" method="post">
        @csrf
        <div class="error-message">
            @if ($errors->has('maHang') || $errors->has('soLuong') || $errors->has('donGia'))
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
        <label for="maHang">Mã Hàng:</label><br>
        <input type="text" id="maHang" name="maHang"><br>
        <label for="soLuong">Số Lượng:</label><br>
        <input type="number" id="soLuong" name="soLuong" min="0" step="1"><br>
        <label for="donGia">Đơn Giá:</label><br>
        <input type="number" id="donGia" name="donGia" min="0" step="1000" placeholder="Nhập giá tiền"><br>
        <!-- Thêm nút để lưu mặt hàng này -->
        <button type="submit">Them Mặt Hàng</button>
    </form>
    <table class="table" style="width: auto;">
        <thead>
            <tr>
                <th class="th1">Mã San Pham</th>
                <th class="th1">Số Lượng</th>
                <th class="th1">Đơn Giá</th>
                <th class="th1">Thanh tien</th>
                <th class="th1">Tuy chon</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($matHangList as $key => $matHang)
                <tr>
                    <td>{{ $matHang['maHang'] }}</td>
                    <td>{{ $matHang['soLuong'] }}</td>
                    <td>{{ $matHang['donGia'] }}</td>
                    <td>{{ $matHang['thanhTien'] }}</td>
                    <td>
                        <a href="{{ route('xoaMatHang', ['id' => $key]) }}">Xóa</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h3>Tong so tien: {{ $tongTien }}</h3>
    <a href="{{ route('xemPN') }}"><button class="btn btn-primary">Trở lại</button></a>
    <script>
        function redirectToNewNCC() {
            var selectElement = document.getElementById("maNCC");
            var selectedValue = selectElement.options[selectElement.selectedIndex].value;

            if (selectedValue === "new") {
                // Thêm tham số điều hướng vào URL
                window.location.href = "/them-nha-cung-cap?source=NCCMoi"; 
            }
        }
    </script>
</body>
</html>