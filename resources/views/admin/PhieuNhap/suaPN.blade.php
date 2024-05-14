<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sua phieu nhap</title>
    <link rel="stylesheet" href="{{ asset('/css/xem.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css')}}" >
</head>
<body>
    <h1>Sua phieu nhap</h1>
    <form action="/xuLySuaPN" method="post">
        @csrf
        <label for="maPN">Ma phieu:</label><br>
        <input type="text" id="maPN" name="maPN" value="{{ $pn->MaPhieuNhap }}" readonly class="gray-background"><br>
        <label for="maNCC">Nha cung cap:</label><br>
        <input type="text" id="maNCC" name="maNCC" value="{{ $pn->MaNhaCungCap }}" readonly class="gray-background"><br>
        <label for="nguoiLap">Nguoi Lap:</label><br>
        <input type="text" id="nguoiLap" name="nguoiLap" value="{{ $pn->MaTaiKhoan }}" readonly class="gray-background"><br>
        <label for="tongTien">Tong tien:</label><br>
        <input type="text" id="tongTien" name="tongTien" value="{{ $pn->TongTien }}" readonly class="gray-background"><br>
        <label for="tienTra">Tien tra them:</label><br>
        <input type="text" id="tienTra" name="tienTra" value="0"><br>
        <label for="tienNo">Tien no:</label><br>
        <input type="text" id="tienNo" name="tienNo" value="{{ $pn->TienNo }}" readonly class="gray-background"><br>
        <label for="phuongThucThanhToan">Phuong thuc thanh toan:</label><br>
        <input type="text" id="phuongThucThanhToan" name="phuongThucThanhToan" value="{{ $pn->PhuongThucThanhToan }}" readonly class="gray-background"><br>
        <label for="trangThai">Trang thai: </label><br>
        <select id="trangThai" name="trangThai">
            <option value="">Chua xac nhan</option>
            <option value="DAXACNHAN">Da xac nhan</option>
            <option value="KHAC">Khac</option>
        </select><br>
        <br>
        <table class="table" style="width: auto;">
            <thead>
                <tr>
                    <th class="th1">Mã PNCT</th>
                    <th class="th1">Mã San Pham</th>
                    <th class="th1">Số Lượng</th>
                    <th class="th1">Đơn Giá</th>
                    <th class="th1">Thanh tien</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ctpn as $key => $matHang)
                    <tr>
                        <td><input type="text" id="maCTPN[]" name="maCTPN[]" value="{{ $matHang->MaCTPN }}" readonly class="gray-background"></td>
                        <td><input type="text" value = "{{ $matHang->MaSanPham }}" readonly class="gray-background"></td>
                        <td><input type="text" id="soluong[]" name="soluong[]" min="1" value="{{ $matHang->SoLuong }}"></td>
                        <td><input type="text" id="dongia[]" name="dongia[]" min="10000" step="1000" value="{{ $matHang->GiaSanPham }}"></td>
                        @php
                            $thanhTien = $matHang->SoLuong * $matHang->GiaSanPham;
                        @endphp
                        <td>{{ $thanhTien }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-warning">Luu</button>
    </form>
    <a href="{{ route('xemPN') }}"><button class="btn btn-primary">Trở lại</button></a>
    <a href="{{ route('suaPN', ['id' => $pn->MaPhieuNhap]) }}"><button class="btn btn-primary">Sua phieu nhap</button></a>
</body>

</html>