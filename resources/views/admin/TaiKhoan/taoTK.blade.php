<!DOCTYPE html>
<html>
<head>
    <title>Tạo tai khoan nhan vien moi</title>
    <style>
        #hinhAnhWrapper {
            width: 400px; /* Độ rộng của div chứa hình ảnh */
            height: 200px; /* Chiều cao của div chứa hình ảnh */
            overflow: hidden; /* Đảm bảo kích thước hình ảnh không vượt quá kích thước div */
        }

        #hinhAnhHienThi {
            max-width: 100%; /* Kích thước tối đa của hình ảnh là 100% của độ rộng div */
            max-height: 100%; /* Kích thước tối đa của hình ảnh là 100% của chiều cao div */
            object-fit:cover;
        }
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
        select {
        padding: 5px; /* Khoảng cách bên trong của combobox */
        border: 1px solid #ccc; /* Đường viền của combobox */
        border-radius: 4px; /* Bo góc combobox */
        font-size: 16px; /* Cỡ chữ */
        width: 200px; /* Độ rộng của combobox */
        }

        /* Thiết lập kiểu cho các tùy chọn trong combobox */
        option {
            font-size: 16px; /* Cỡ chữ */
        }
        .submit{
            margin:5px;
            padding: 10px 12px;
            background-color: #fff;
        }
        .submit:hover{
            color:#fff;
            background-color:#333;
        }

    </style>
</head>
<body>
    <h1>Tạo tài khoản mới</h1>
    <form id="formTaoTK" action="/xuLyTaoTK" method="post" enctype="multipart/form-data">
        @csrf
        <label for="email">Email:</label>
        <input type="text" id="email" name="email">
        <label for="tentaikhoan">Tên tài khoản:</label>
        <input type="text" id="tentaikhoan" name="tentaikhoan">
        <label for="sdt">Số điện thoại:</label>
        <input type="text" id="sdt" name="sdt">
        <label for="matkhau">Mật khẩu:</label>
        <input type="text" id="matkhau" name="matkhau">
        <label for="quyen">Chọn quyền:</label>
        <select id="quyen" name="quyen">
            <option value="NV">Khong chon</option>
            <option value="QTVCC">Quan tri vien cap cao</option>
            <option value="QTV">Quan tri vien</option>
            <option value="NVBH">Nhan vien ban hang</option>
            <option value="NVK">Nhan vien kho</option>
            <option value="NVKT">Nhan vien ke toan</option>
        </select>
        <div id="hinhAnhWrapper">
            <!-- Trường input để chọn hình ảnh -->
            <label for="hinhanh">Chọn hình ảnh:</label>
            <input type="file" id="hinhanh" name="hinhanh" onchange="hienThiHinhAnh(this)">
            <!-- Hiển thị hình ảnh đã chọn -->
            <img id="hinhAnhHienThi" src="#" alt="Hình ảnh đã chọn" style="display: none;">
        </div>
        <button type="submit" class="submit">Lưu</button>
        
    </form>
    <a href="{{ route('lietKeTK') }}"><button class="submit">Trở lại</button></a>
    <script>
        function hienThiHinhAnh(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    // Hiển thị hình ảnh đã chọn
                    document.getElementById('hinhAnhHienThi').style.display = 'block';
                    document.getElementById('hinhAnhHienThi').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>