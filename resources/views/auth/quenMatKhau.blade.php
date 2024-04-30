<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên Mật Khẩu</title>
    <link rel="stylesheet" href="{{ asset('/css/style_taiKhoan.css') }}">
</head>
<body>
    <div class="login-container">
        <h2>Quên mật khẩu</h2>
        <form action="/quen-mat-khau" method="POST">
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
            <input type="text" name="Email" placeholder="Email">
            <input type="submit" value="Gửi mã Pin">

        </form>
        <a href="{{ route('dangKy') }}" class="link-dn">Chưa có tài khoản? Đăng ký!</a>
        <a href="{{ route('dangNhap') }}" class="link-dn">Quên mật khẩu?</a>
        <a href="{{ route('/') }}" class="link-dn">Về trang chủ?</a>


    </div>
</body>
</html>
