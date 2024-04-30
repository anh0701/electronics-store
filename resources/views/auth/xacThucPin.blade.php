<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác thực Pin</title>
    <link rel="stylesheet" href="{{ asset('/css/style_taiKhoan.css') }}">
</head>
<body>
    <div class="login-container">
        <h2>Xác thực Pin</h2>
        <form action="/xac-thuc-pin" method="POST">
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
            <input type="text" name="Pin" placeholder="Pin">
            <input type="submit" value="Gửi">

        </form>
        <a href="{{ route('/') }}" class="link-dn">Về trang chủ?</a>


    </div>
</body>
</html>
