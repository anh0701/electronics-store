<!DOCTYPE html>
<html>
<head>
    <title>Tạo tai khoan nhan vien moi</title>
    <style>
        #hinhAnhWrapper {
            width: 200px; /* Độ rộng của div chứa hình ảnh */
            height: 200px; /* Chiều cao của div chứa hình ảnh */
            overflow: hidden; /* Đảm bảo kích thước hình ảnh không vượt quá kích thước div */
        }

        #hinhAnhHienThi {
            max-width: 100%; /* Kích thước tối đa của hình ảnh là 100% của độ rộng div */
            max-height: 100%; /* Kích thước tối đa của hình ảnh là 100% của chiều cao div */
            object-fit:cover;
        }

        

    </style>
</head>
<body>
    <h1>Tạo tài khoản mới</h1>
    <form id="formTaoTK" action="/xuLyTaoTK" method="post" enctype="multipart/form-data">
        @csrf
        <label for="email">Email:</label><br>
        <input type="text" id="email" name="email"><br>
        <label for="tentaikhoan">Tên tài khoản:</label><br>
        <input type="text" id="tentaikhoan" name="tentaikhoan"><br>
        <label for="sdt">Số điện thoại:</label><br>
        <input type="text" id="sdt" name="sdt"><br>
        <label for="matkhau">Mật khẩu:</label><br>
        <input type="text" id="matkhau" name="matkhau"><br>
        <label for="quyen">Chọn quyền:</label><br>
        <select id="quyen" name="quyen">
            <option value="QTV">Quan tri vien</option>
            <option value="NVBH">Nhan vien ban hang</option>
            <option value="NVK">Nhan vien kho</option>
            <option value="NVKT">Nhan vien ke toan</option>
        </select><br>
        <div id="hinhAnhWrapper">
            <!-- Trường input để chọn hình ảnh -->
            <label for="hinhanh">Chọn hình ảnh:</label><br>
            <input type="file" id="hinhanh" name="hinhanh" onchange="hienThiHinhAnh(this)"><br>
            <!-- Hiển thị hình ảnh đã chọn -->
            <img id="hinhAnhHienThi" src="#" alt="Hình ảnh đã chọn" style="display: none;">
        </div>
        <button type="submit">Lưu</button>
    </form>

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