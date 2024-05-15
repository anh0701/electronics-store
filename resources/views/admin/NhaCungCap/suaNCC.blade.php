<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sửa tài khoản</title>
    <link rel="stylesheet" href="{{ asset('/css/table.css')}}">
</head>
<body>
    <h1>Sửa tài khoản</h1>
    <form id="from" action="/xuLySuaNCC" method="post">
        @csrf <!-- Sử dụng token CSRF protection trong Laravel -->
        <div class="error-message">
            @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
        @foreach ($data as $item)
            <label for="maNCC">Mã nha cung cap:</label>
            <input type="text" id="maNCC" name="maNCC" value="{{ $item->MaNhaCungCap }}" readonly class="gray-background"><br>

            <label for="tennhacungcap">Tên nha cung cap:</label>
            <input type="text" id="tennhacungcap" name="tennhacungcap" value="{{ $item->TenNhaCungCap }}" ><br>

            <label for="diachi">Dia Chi:</label>
            <input type="text" id="diachi" name="diachi" value="{{ $item->DiaChi }}" ><br>

            <label for="email">Email:</label>
            <input type="text" id="email" name="email" value="{{ $item->Email }}"><br>

            <label for="sdt">Số điện thoại:</label>
            <input type="text" id="sdt" name="sdt" value="{{ $item->SoDienThoai }}"><br>

            <label for="thoihanhopdong">Thời han hop dong:</label>
            <input type="datetime-local" id="thoihanhopdong" name="thoihanhopdong" value="{{ $item->ThoiHanHopDong }}"><br>

            <label for="thoigiansua">Thoi gian sua:</label>
            <input type="text" id="thoigiansua" name="thoigiansua" value="{{ $item->ThoiGianSua }}" readonly class="gray-background"><br>

        @endforeach

        <button type="submit" class="submit">Lưu</button>
    </form>
    <a href="{{ route('lietKeNCC') }}"><button class="submit">Trở lại</button></a>
    
    
</body>

</html>