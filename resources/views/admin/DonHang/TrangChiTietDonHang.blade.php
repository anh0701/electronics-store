@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
         Thông tin giao hàng
      </div>
      <div class="table-responsive">
        @php
            $status = Session::get('status');
            if ($status) {
                echo '<span style="font-size: 17px; width: 100%; text-align: center; font-weight: bold; color: red;" class="text-alert">'.$status.'</span>';
                Session::put('status', null);
            }
        @endphp
        @php
          $total = 0;
          $total_after = 0;
          $total_after_coupon = 0;
        @endphp
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th>Tên người nhận</th>
              <th>Email</th>
              <th>Tiền giao hàng</th>
              <th>Địa chỉ</th>
              <th>Số điện thoại</th>
              <th>Ghi chú</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>{{ $allDonHang->GiaoHang->TenNguoiNhan }}</td>
              <td>{{ $allDonHang->Email }}</td>
              <td>{{ number_format($allDonHang->GiaoHang->TienGiaoHang, 0, '', '.') }} đ</td>
              <td>{{ $allDonHang->GiaoHang->DiaChi }}</td>
              <td>{{ $allDonHang->GiaoHang->SoDienThoai }}</td>
              <td>{{ $allDonHang->GiaoHang->GhiChu ?? 'Không có ghi chú nào' }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
         Thông tin phiếu giảm giá
      </div>
      <div class="table-responsive">
        @php
            $status = Session::get('status');
            if ($status) {
                echo '<span style="font-size: 17px; width: 100%; text-align: center; font-weight: bold; color: red;" class="text-alert">'.$status.'</span>';
                Session::put('status', null);
            }
        @endphp
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th>Tên Phiếu giảm giá</th>
              <th>Số tiền | Phần trămm giảm</th>
              <th>Trị giá</th>
              <th>Mã code</th>
            </tr>
          </thead>
          @if ($allDonHang->MaGiamGia != 0)
            <tbody>
              <tr>
                <td>{{ $allDonHang->PhieuGiamGia->TenMaGiamGia }}</td>
                @if ($allDonHang->PhieuGiamGia->DonViTinh == 1)
                  <td>Phiếu giảm giá theo số tiền</td>
                  <td>{{ number_format($allDonHang->PhieuGiamGia->TriGia, 0, '', '.') }} đ</td>
                @elseif ($allDonHang->PhieuGiamGia->DonViTinh == 2)
                  <td>Phiếu giảm giá theo phần trăm</td>
                  <td>{{ $allDonHang->PhieuGiamGia->TriGia }} %</td>
                @endif
                <td>{{ $allDonHang->PhieuGiamGia->MaCode }}</td>
              </tr>
            </tbody>
          @elseif ($allDonHang->MaGiamGia == 0)
            <tr>
              <td colspan="4">Không dùng mã giảm giá trong đơn hàng này</td>
            </tr>       
          @endif
        </table>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
         Liệt kê chi tiết đơn hàng
      </div>
      <div class="table-responsive">
        @php
            $status = Session::get('status');
            if ($status) {
                echo '<span style="font-size: 17px; width: 100%; text-align: center; font-weight: bold; color: red;" class="text-alert">'.$status.'</span>';
                Session::put('status', null);
            }
        @endphp
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th>STT</th>
              <th>Tên sản phẩm</th>
              <th>Loại sản phẩm</th>
              <th>Thương hiệu</th>
              <th>Hình ảnh</th>
              <th>Số lượng</th>
              <th>Giá sản phẩm</th>
              <th>Quản lý</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($allChiTietDonHang as $key => $value)
            @php
              $total += $value->GiaSanPham * $value->SoLuong;
            @endphp
            <tr>
              <td>{{ $key+1 }}</td>
              <td>{{ $value->SanPham->TenSanPham }}</td>
              <td>{{ $value->SanPham->DanhMuc->TenDanhMuc }}</td>
              <td>{{ $value->SanPham->ThuongHieu->TenThuongHieu }}</td>
              <td><img src="{{ asset('upload/sanPham/'.$value->SanPham->HinhAnh) }}" height="100px" width="150px"></td>
              <td><input type="number" size="5" min="1" value="{{ $value->SoLuong }}" name="product_sales_quantity"></td>
              <td>{{ number_format($value->GiaSanPham, 0, '', '.') }} đ</td>
              <td>
                <a onclick="return confirm('Bạn có muốn sản phẩm {{ $value->SanPham->TenSanPham }} thuộc đơn hàng này không?')" href="{{ route('/XoaChiTietDonHang', [$value->MaCTDH]) }}">
                  <i style="font-size: 28px; width: 100%; text-align: center; font-weight: bold; color: red;" class="fa fa-times text-danger text"></i>
                </a>
              </td>
            </tr>
            @endforeach
            <tr>
              <td colspan="7">
                Tiền giỏ hàng: {{ number_format($total, 0,',','.').'đ' }}<br>         
                Phí ship: {{ number_format($allDonHang->GiaoHang->TienGiaoHang, 0,',','.').'đ' }}<br>
                @php
                $total_coupon = 0;
                @endphp
                @if ($allDonHang->MaGiamGia != 0 && $allDonHang->PhieuGiamGia->DonViTinh == 1 )
                  @php
                    echo 'Mã giảm giá theo tiền: '.number_format($allDonHang->PhieuGiamGia->TriGia, 0,',','.').'đ'.'<br>';
                    $total_after = $total - $allDonHang->PhieuGiamGia->TriGia + $allDonHang->GiaoHang->TienGiaoHang;
                  @endphp
                @elseif ($allDonHang->MaGiamGia != 0 && $allDonHang->PhieuGiamGia->DonViTinh == 2)
                  @php
                    $total_after_coupon = $total*$allDonHang->PhieuGiamGia->DonViTinh/100;
                    echo 'Mã giảm giá '.$allDonHang->PhieuGiamGia->TriGia.'%: '   .number_format($total_after_coupon, 0,',','.').'đ'.'<br>';
                    $total_after = $total - $total_after_coupon + $allDonHang->GiaoHang->TienGiaoHang;
                  @endphp
                @elseif ($allDonHang->MaGiamGia == 0)
                  @php
                    echo 'Đơn hàng không áp dụng phiếu giảm giá'.'<br>';
                    $total_after = $total + $allDonHang->GiaoHang->TienGiaoHang;
                  @endphp
                @endif
                Thanh toán: {{ number_format($total_after, 0,',','.').'đ' }}<br>           
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
</div>
@endsection