<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SuaPhieuNhap</title>
    <style>
        /* Thiết lập phần tử label */
        label {
            display: block; /* Hiển thị mỗi nhãn trên một dòng mới */
            margin-bottom: 5px; /* Khoảng cách giữa các nhãn */
        }

        /* Thiết lập phần tử input */
        input {
            width: 100%; /* Độ rộng của ô textbox */
            padding: 5px; /* Khoảng cách bên trong ô textbox */
            margin-bottom: 10px; /* Khoảng cách giữa các ô textbox */
            border: 1px solid #ccc; /* Đường viền của ô textbox */
            border-radius: 4px; /* Bo tròn các góc của ô textbox */
            box-sizing: border-box; /* Kích thước ô textbox bao gồm cả padding và border */
        }

        /* Thiết lập phần tử button */
        .edit-btn {
            padding: 8px 16px; /* Kích thước nút */
            background-color: #4CAF50; /* Màu nền của nút */
            color: white; /* Màu chữ của nút */
            border: none; /* Không có đường viền */
            border-radius: 4px; /* Bo tròn các góc */
            cursor: pointer; /* Con trỏ thành dạng bàn tay khi di chuột vào nút */
        }

        /* Thiết lập hover cho nút */
        .edit-btn:hover {
            background-color: #45a049; /* Màu nền khi di chuột vào */
        }
        .gray-background {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>SuaPhieuNhap</h1>
    <form action="/xuLySuaPN" method="post">
    @csrf <!-- Sử dụng token CSRF protection trong Laravel -->

        @foreach ($data as $item)
            <label for="maPN">Mã Phiếu Nhập:</label>
            <input type="text" id="maPN" name="maPN" value="{{ $item->maPN }}" readonly class="gray-background"><br>

            <label for="nguoiLap">Người Lập:</label>
            <input type="text" id="nguoiLap" name="nguoiLap" value="{{ $item->nguoiLap }}"><br>

            <label for="maNCC">Mã Nhà Cung Cấp:</label>
            <input type="text" id="maNCC" name="maNCC" value="{{ $item->maNCC }}"><br>

            <label for="thoiGianLap">Thời Gian Lập:</label>
            <input type="text" id="thoiGianLap" name="thoiGianLap" value="{{ $item->thoiGianLap }}" readonly class="gray-background"><br>

            <label for="tongTien">Tổng Tiền:</label>
            <input type="text" id="tongTien" name="tongTien" value="{{ $item->tongTien }}"><br>

            <label for="soTienTra">Số Tiền Trả:</label>
            <input type="text" id="soTienTra" name="soTienTra" value="{{ $item->soTienTra !== null ? $item->soTienTra : '0' }}"><br>

            <label for="soTienNo">Số Tiền Nợ:</label>
            <input type="text" id="soTienNo" name="soTienNo" value="{{ $item->soTienNo }}" readonly class="gray-background"><br>
        @endforeach

        <button type="submit" class="submit">Lưu</button>
    </form>
    
    
    
</body>

</html>