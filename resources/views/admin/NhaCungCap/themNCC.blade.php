<!DOCTYPE html>
<html>
<head>
    <title>Thêm nhà cung cấp</title>
    <link rel="stylesheet" href="{{ asset('/css/table.css')}}">
</head>
<body>
    <h1>Thêm nhà cung cấp</h1>
    <form id="from" action="/xuLyThemNCC" method="post" enctype="multipart/form-data">
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
        <label for="tennhacungcap">Tên nhà cung cấp:</label>
        <input type="hidden" id="nccMoi" name="nccMoi" value="{{ $test }}" readonly>
        <input type="text" id="tennhacungcap" name="tennhacungcap" value="{{ old('tennhacungcap') }}">
        <label for="diachi">Địa chỉ:</label>
        <input type="text" id="diachi" name="diachi" value="{{ old('diachi') }}">
        <label for="sdt">Số điện thoại:</label>
        <input type="text" id="sdt" name="sdt" value="{{ old('sdt') }}">
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" value="{{ old('email') }}">
        <label for="thoihanhopdong">Thời hạn hợp đồng:</label>
        <input type="datetime-local" id="thoihanhopdong" name="thoihanhopdong" value="{{ old('thoihanhopdong') }}">
        <button type="submit" class="submit">Lưu</button>
        
    </form>
    <a href="{{ route('lietKeNCC') }}"><button class="submit">Trở lại</button></a>

</body>
</html>