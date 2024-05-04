<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang quản lý</title>
    <link rel="stylesheet" href="{{ asset('/css/trangQuanLy.css')}}">
</head>
<body>
    <header>
        <div>
            <!-- Hiển thị thông tin người dùng -->
            @if (session('user'))
                @php
                    $user = session('user');
                    $tenTK = $user['TenTaiKhoan'];
                @endphp  
            @endif
        </div>
        <nav class="navbar">
            <div class="logo">
                <a href="#">Logo</a>
            </div>
            <ul class="menu">
                <li><a href="">Hello, {{ $tenTK }}</a></li>
                <li><a href="{{ route('trangAdmin') }}">Trang quản lý</a></li>
                <li><a href="{{ route('dangXuat') }}">Đăng xuất</a></li>
                <li><a href="#">Lien he</a></li>
            </ul>
        </nav>
    </header>
    <div class = "container">
        <div class="menu-left">
            <ul>
                <li><a href="#">Trang chủ</a></li>
                <li class="dropdown">
                    <a href="#" class="dropbtn" onclick="toggleDropdown()">Quan ly tai khoan<span class="arrow">  v</span></a>
                    <div class="dropdown-content" id="dropdownContent">
                        <a href="{{ route('taoTK') }}">Tạo tài khoản</a>
                        <a href="{{ route('lietKeTK') }}">Liệt kê tài khoản</a>
                    </div>
                </li>
            </ul>
        </div>
        <div class="content">
            <h1>Chao mung ban den trang ho tro kinh doanh hang dien tu</h1>
        </div>
    </div>
</body>
</html>