<!DOCTYPE html>
<html>
<head>
    <title>Lập phiếu nhập</title>
    <link rel="stylesheet" href="{{ asset('/css/table.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    
</head>
<body>
    <h1 class="container" style="font-family: 'Times New Roman', Times, serif;">Lập phiếu nhập</h1>
    <div class="container" id="lapPN">
        
        <p>(Lưu ý: bạn nên nhập thông tin các sản phẩm nhập về trước khi nhập thông tin phiếu nhập)</p>
        <form action="/xuLyLapPN" method="post" class="pn">
            @csrf
            <div class="error-message">
                @if ($errors->has('maNCC') || $errors->has('tienTra') || $errors->has('matHang'))
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <div class="row">
                <div class="col-sm-2" >
                    <label class="lb1">Người Lập:</label>
                </div>
                <div class="col-sm-3" >
                    <input type="text" class="in1 gray-background" id="nguoiLap" name="nguoiLap" value="{{ $nguoiLap }}" readonly>
                </div>
                <div class="col-sm-2">
                    <label class="lb1">Nhà Cung Cấp:</label>
                </div>
                <div class="col-sm-3" >
                    <select class="in1" id="maNCC" name="maNCC" onchange="redirectToNewNCC()">
                        <option value="">Chọn một nhà cung cấp</option>
                        @foreach($listNCC as $ncc)
                            <option value="{{ $ncc->MaNhaCungCap }}">{{ $ncc->TenNhaCungCap }}</option>
                        @endforeach
                        <option value="new">Thêm nhà cung cấp mới</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2" >
                    <label class="lb1">Tiền Trả:</label>
                </div>
                <div class="col-sm-3" >
                    <input type="number" class="in1" id="soTienTra" name="soTienTra" value="0" min="0" step="10000">
                </div>
                <div class="col-sm-2" >
                    <label class="lb1">Phuong thuc thanh toan:</label>
                </div>
                <div class="col-sm-3" >
                    <select class="in1" id="pttt" name="pttt">
                        <option value="CK">Chuyen khoan</option>
                        <option value="TM">Tien mat</option>
                        <option value="Khac">Khac</option>
                    </select>
                </div>
            </div>
            <input type="number" class="in1" id="tongTien" name="tongTien" value="{{ $tongTien }}" hidden>
            @if(count($matHangList) > 0)
                <div class="col-sm-3" >
                    <button type="submit" class="submit2">Lập phiếu nhập</button>
                </div>
            @endif
            
            
        </form>
        <div style="width: 80%; margin-left:auto; margin-right: auto">
            <a href="{{ route('xemPN') }}"><button class="submit2" style="margin-top: -25px; margin-bottom:2px margin-left: -30px">Thoát</button></a>
        </div>
        
        <form action="/xuLyThemMatHang" method="post" style="margin-top: 2px;">
            @csrf
            
            <div class="row" id="pnct">
                <div class="error-message">
                    @if ($errors->has('maHang') || $errors->has('soLuong') || $errors->has('donGia'))
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <div class="col-sm-2" >
                    <label class="lb1">Mã Hàng:</label>            
                </div>
                <div class="col-sm-3" >
                    <input type="text" class="in1" id="maHang" name="maHang">
                </div>
                <div class="col-sm-2" >
                    <label class="lb1">Số Lượng:</label>          
                </div>
                <div class="col-sm-5" >
                    <input type="number" class="in1" id="soLuong" name="soLuong" min="1" step="1">
                </div>
                <div class="col-sm-2" >
                    <label class="lb1">Đơn Giá:</label>       
                </div>
                <div class="col-sm-3" >
                    <input type="number" class="in1" id="donGia" name="donGia" min="1000" step="1000" placeholder="Nhập giá tiền">
                </div>
                <button type="submit" class="submit">Thêm</button>

            </div>
        </form>
        <h2 style="text-align: center;">Danh sách sản phẩm nhập</h2>
        <div class="table1">            
            <table class="table">
                <thead>
                    <tr>
                        <th class="th1">Mã San Pham</th>
                        <th class="th1">Số Lượng</th>
                        <th class="th1">Đơn Giá</th>
                        <th class="th1">Thanh tien</th>
                        <th class="th1">Tuy chon</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($matHangList as $key => $matHang)
                        <tr>
                            <td>{{ $matHang['maHang'] }}</td>
                            <td>{{ $matHang['soLuong'] }}</td>
                            <td>{{ $matHang['donGia'] }}</td>
                            <td>{{ $matHang['thanhTien'] }}</td>
                            <td>
                                <a href="{{ route('xoaMatHang', ['id' => $key]) }}">Xóa</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <h3 class="tongTien">Tong so tien: {{ $tongTien }}</h3>
    </div>
    
    
    
    <script>
        function redirectToNewNCC() {
            var selectElement = document.getElementById("maNCC");
            var selectedValue = selectElement.options[selectElement.selectedIndex].value;

            if (selectedValue === "new") {
                // Thêm tham số điều hướng vào URL
                window.location.href = "/them-nha-cung-cap?source=NCCMoi"; 
            }
        }
    </script>
</body>
</html>