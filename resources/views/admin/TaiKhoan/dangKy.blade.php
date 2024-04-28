<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="{{ asset('/css/style_taiKhoan.css') }}">
</head>
<body>
    <div class="login-container">
        <h2>Đăng ký</h2>
        <form action="/xuLyDK" method="POST">
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
            <input type="text" name="tentaikhoan" placeholder="Tên tài khoản">
            <input type="text" name="email" placeholder="Email">
            <input type="password" name="matkhau" placeholder="Mật khẩu">
            <input type="submit" value="Đăng ký">
            
        </form>
        <a href="{{ route('/') }}" class="link-dn">Về trang chủ?</a>
        <a href="{{ route('dangNhap') }}" class="link-dn">Đăng nhập?</a>
        
    </div>
</body>
</html>
