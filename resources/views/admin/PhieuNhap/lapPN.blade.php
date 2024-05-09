<!DOCTYPE html>
<html>
<head>
    <title>Tạo mới Phiếu Nhập</title>
</head>
<body>
    <h1>Tạo mới Phiếu Nhập</h1>
    <h2>Moi ban nhap thong tin cac mat hang trong phieu nhap:</h2>
    <form action="/xuLyThemMatHang" method="post">
        @csrf
        <div class="error-message">
            @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
        <label for="maHang">Mã Hàng:</label><br>
        <input type="text" id="maHang" name="maHang" value="{{ old('maHang') }}"><br>
        <label for="soLuong">Số Lượng:</label><br>
        <input type="text" id="soLuong" name="soLuong" value="{{ old('soLuong') }}"><br>
        <label for="donGia">Đơn Giá:</label><br>
        <input type="text" id="donGia" name="donGia" value="{{ old('donGia') }}"><br>
        <!-- Thêm nút để lưu mặt hàng này -->
        <button type="submit">Lưu Mặt Hàng</button>
    </form>
    <table>
        <thead>
            <tr>
                <th>Mã San Pham</th>
                <th>Số Lượng</th>
                <th>Đơn Giá</th>
                <th>Thanh tien</th>
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
    <h2>Moi ban nhap thong tin trong phieu nhap:</h2>
    <form action="/xuLyLapPN" method="post">
        @csrf
        <div class="error-message">
            @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
        <label for="nguoiLap">Nguoi Lap:</label><br>
        <input type="text" id="nguoiLap" name="nguoiLap" value="{{ old('nguoiLap') }}"><br>
        <label for="maNCC">MaNCC:</label><br>
        <input type="text" id="maNCC" name="maNCC" value="{{ old('maNCC') }}"><br>
        <label for="tongTien">Tong tien:</label><br>
        <input type="text" id="tongTien" name="tongTien" value="{{ $tongTien }}"><br>
        <label for="soTienTra">SoTienTra:</label><br>
        <input type="text" id="soTienTra" name="soTienTra" value="{{ old('soTienTra') }}"><br>
        <label for="pttt">Phuong thuc thanh toan:</label><br>
        <select id="pttt" name="pttt">
            <option value="CK">Chuyen khoan</option>
            <option value="TM">Tien mat</option>
            <option value="Khac">Khac</option>
        </select><br>
        <!-- Thêm các trường khác của phiếu nhập -->
        <button type="submit">Lưu</button>
    </form>
</body>
</html>