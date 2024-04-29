<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xem phieu nhap</title>
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    
</head>
<body>
  <div class="container">
    <div class="sidebar">
      <!-- Thanh menu bên tay phải -->
      <ul>
        <li><a href="#">Trang chủ</a></li>
        <li><a href="#">Giới thiệu</a></li>
        <li><a href="#">Dịch vụ</a></li>
        <li><a href="#">Liên hệ</a></li>
        <li class="dropdown">
          <a href="#" class="dropbtn" onclick="toggleDropdown()">Quan ly phieu nhap<span class="arrow"><img src="{{ asset('/upload/muiten.png') }}" alt=""></span></a>
          <div class="dropdown-content" id="dropdownContent">
            <a href="{{ route('lapPN') }}">Lap phieu nhap</a>
            <a href="#">Link 2</a>
            <a href="#">Link 3</a>
          </div>
        </li>
      </ul>
    </div>
    <div class="main-content">
      <!-- Phần nội dung trung tâm -->
      <h1>Danh sach phieu nhap</h1>
      <table>
        <thead>
            <tr>
                <th>MaPN</th>
                <th>NguoiLap</th>
                <th>MaNCC</th>
                <th>ThoiGianLap</th>
                <th>TongTien</th>
                <th>SoTienTra</th>
                <th>SoTienNo</th>
                <th>TuyChon</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $pn)
            <tr class="row-clickable" data-id="{{ $pn->maPN }}">
                <td>{{ $pn->maPN }}</td>
                <td>{{ $pn->nguoiLap }}</td>
                <td>{{ $pn->maNCC }}</td>
                <td>{{ $pn->thoiGianLap }}</td>
                <td>{{ number_format($pn->tongTien) }}<span class="currency">đ</span></td>
                <td>{{ $pn->soTienTra !== null ? number_format($pn->soTienTra) : '0' }} <span class="currency">đ</span></td>
                <td>{{ number_format($pn->soTienNo) }}<span class="currency">đ</span></td>
                <td><a href="{{ route('xem.CT', ['id' => $pn->maPN]) }}">Xem chi tiết</a></td>
            </tr>
            @endforeach
        </tbody>
      </table>
    </div>
  </div>
  <script src="{{ asset('/js/script.js') }}"></script>
</body>
</html>