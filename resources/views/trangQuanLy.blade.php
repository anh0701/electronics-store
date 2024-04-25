<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Website</title>
</head>
<body>
    <header>
        <div>
            <!-- Hiển thị thông tin người dùng -->
            @if (session('user'))
                <p>Hello, {{ session('user') }}</p>
                <form action="{{ route('dangXuat') }}" method="POST">
                    @csrf
                    <button type="submit">DangXuat</button>
                </form>
            @else
                <p>Welcome Guest</p>
            @endif
        </div>
        <nav>
            <!-- Thêm các liên kết menu -->
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/about">About</a></li>
                <li><a href="/contact">Contact</a></li>
                <!-- Thêm các liên kết menu bổ sung -->
            </ul>
        </nav>
    </header>

    <div class="container">
        <!-- Nội dung chính của trang sẽ được đặt ở đây -->
        @yield('content')
    </div>

    <aside>
        <!-- Thêm các menu bên tay phải -->
        <div>
            <h3>Menu</h3>
            <ul>
                <li><a href="{{ route('taoTK') }}">TaoTaiKhoanNhanVien</a></li>
                <li><a href="#">Option 2</a></li>
                <li><a href="#">Option 3</a></li>
                <!-- Thêm các mục menu bổ sung -->
            </ul>
        </div>
    </aside>

    <footer>
        <!-- Footer của trang web -->
    </footer>
</body>
</html>