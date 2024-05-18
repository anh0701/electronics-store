<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang quản lý</title>
    <link rel="stylesheet" href="{{ asset('/css/trangQuanLy.css')}}">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css')}}" >
    <link href="{{ asset('/css/style2.css')}}" rel='stylesheet' type='text/css' />
    <script src="{{ asset('/js/jquery2.0.3.min.js')}}"></script>
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
        <nav class="navbar1">
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
    <header class="header fixed-top clearfix">
    <aside>
        <div id="sidebar" class="nav-collapse">
            <!-- sidebar menu start-->
            <div class="leftside-navigation">
                <ul class="sidebar-menu" id="nav-accordion">  
                    <li class="sub-menu">
                        <a href="{{ route('/') }}"><span>Trang chủ</span></a>
                    </li>           
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <span>Quản lý tài khoản</span>
                        </a>
                        <ul class="sub">
                            <li><a href="{{ route('taoTK') }}">Tạo tài khoản</a></li>
                            <li><a href="{{ route('lietKeTK') }}">Liệt kê tài khoản</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <span>Quản lý nhà cung cấp</span>
                        </a>
                        <ul class="sub">
                            <li><a href="{{ route('themNCC') }}">Thêm nhà cung cấp</a></li>
                            <li><a href="{{ route('lietKeNCC') }}">Liệt kê nhà cung cấp</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <span>Quản lý phieu nhap</span>
                        </a>
                        <ul class="sub">
                            <li><a href="{{ route('xemPN') }}">Liet ke phieu nhap</a></li>
                            <li><a href="{{ route('lapPN') }}">Lap phieu nhap</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </aside>
    <section id="main-content">
        @yield('content')
    </section>
</body>
    <script src="{{ asset('/js/jquery.dcjqaccordion.2.7.js')}}"></script>
    <script src="{{ asset('/js/scripts.js')}}"></script>
</html>