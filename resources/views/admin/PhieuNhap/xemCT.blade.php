<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Detail</title>
    <link rel="stylesheet" href="{{ asset('/css/xem.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css')}}" >
</head>
<body>
    <h1>Data Detail</h1>
    <label for="maPN">Ma phieu:</label><br>
    <input type="text" id="maPN" name="maPN" value="{{ $pn->MaPhieuNhap }}" readonly class="gray-background"><br>
    <label for="maNCC">Nha cung cap:</label><br>
    <input type="text" id="maNCC" name="maNCC" value="{{ $pn->MaNhaCungCap }}" readonly class="gray-background"><br>
    <label for="nguoiLap">Nguoi Lap:</label><br>
    <input type="text" id="nguoiLap" name="nguoiLap" value="{{ $pn->MaTaiKhoan }}" readonly class="gray-background"><br>
    <label for="tongTien">Tong tien:</label><br>
    <input type="text" id="tongTien" name="tongTien" value="{{ $pn->TongTien }}" readonly class="gray-background"><br>
    <label for="tienTra">Tien tra:</label><br>
    <input type="text" id="tienTra" name="tienTra" value="{{ $pn->TienTra }}" readonly class="gray-background"><br>
    <label for="tienNo">Tien no:</label><br>
    <input type="text" id="tienNo" name="tienNo" value="{{ $pn->TienNo }}" readonly class="gray-background"><br>
    <label for="phuongThucThanhToan">Phuong thuc thanh toan:</label><br>
    <input type="text" id="phuongThucThanhToan" name="phuongThucThanhToan" value="{{ $pn->PhuongThucThanhToan }}" readonly class="gray-background"><br>
    <label for="thoiGianTao">Thoi gian tao:</label><br>
    <input type="text" id="thoiGianTao" name="thoiGianTao" value="{{ $pn->ThoiGianTao }}" readonly class="gray-background"><br>
    <label for="thoiGianSua">Thoi gian sua:</label><br>
    <input type="text" id="thoiGianSua" name="thoiGianSua" value="{{ $pn->ThoiGianSua }}" readonly class="gray-background"><br>
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
            @foreach ($ctpn as $key => $matHang)
                <tr>
                    <td>{{ $matHang->MaSanPham }}</td>
                    <td>{{ $matHang->SoLuong }}</td>
                    <td>{{ $matHang->GiaSanPham }}</td>
                    @php
                        $thanhTien = $matHang->SoLuong * $matHang->GiaSanPham;
                    @endphp
                    <td>{{ $thanhTien }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('xemPN') }}"><button class="btn btn-primary">Trở lại</button></a>
</body>

</html>