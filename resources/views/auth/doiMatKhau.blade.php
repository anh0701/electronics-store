<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đổi mật khẩu</title>
    <link rel="stylesheet" href="{{ asset('/css/style_taiKhoan.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css') }}" >
</head>
<body>
<div class="login-container">
    <h2>Đổi mật khẩu</h2>
    <form action="/doi-mat-khau" method="POST">
        @csrf
        {{--            error--}}
        {{--            <div class="error-message">--}}
        {{--                @if ($errors->any())--}}
        {{--                    <ul>--}}
        {{--                        @foreach ($errors->all() as $error)--}}
        {{--                            <li>{{ $error }}</li>--}}
        {{--                        @endforeach--}}
        {{--                    </ul>--}}
        {{--                @endif--}}
        {{--            </div>--}}

        <input type="password" class="@error('MatKhauCu') is-invalid @enderror" name="MatKhauCu"
               placeholder="Mật khẩu cũ" value="{{ old('MatKhauCu') }}">
        @error('MatKhauCu')
        <div class="alert alert-danger">
            {{$message}}
        </div>
        @enderror
        <input type="password" name="MatKhauMoi" placeholder="Mật khẩu mới" value="{{ old('MatKhauMoi') }}">
        @error('MatKhauMoi')
        <div class="alert alert-danger">
            {{$message}}
        </div>
        @enderror
        <input type="password" name="MatKhauMoi2" placeholder="Nhập lại mật khẩu mới" value="{{ old('MatKhauMoi2') }}">
        @error('MatKhauMoi2')
        <div class="alert alert-danger">
            {{$message}}
        </div>
        @enderror
        <input type="submit" value="Đổi mật khẩu">
    </form>
    {{--        <a href="{{ route('dangKy') }}" class="link-dn">Chưa có tài khoản? Đăng ký!</a>--}}
    {{--        <a href="{{ route('dangNhap') }}" class="link-dn">Quên mật khẩu?</a>--}}
    <a href="{{ route('/') }}" class="link-dn">Về trang chủ?</a>


</div>
</body>
</html>
