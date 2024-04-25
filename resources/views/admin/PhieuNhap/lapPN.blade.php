<!DOCTYPE html>
<html>
<head>
    <title>Tạo mới Phiếu Nhập</title>
</head>
<body>
    <h1>Tạo mới Phiếu Nhập</h1>
    <form action="/xuLyLapPN" method="post">
        @csrf
        <label for="nguoiLap">Nguoi Lap:</label><br>
        <input type="text" id="nguoiLap" name="nguoiLap"><br>
        <label for="maNCC">MaNCC:</label><br>
        <input type="text" id="maNCC" name="maNCC"><br>
        <label for="tongTien">Tong tien:</label><br>
        <input type="text" id="tongTien" name="tongTien"><br>
        <label for="soTienTra">SoTienTra:</label><br>
        <input type="text" id="soTienTra" name="soTienTra"><br>
        <!-- Thêm các trường khác của phiếu nhập -->
        <button type="submit">Lưu</button>
    </form>
</body>
</html>