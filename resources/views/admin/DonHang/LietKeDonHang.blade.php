@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
         Liệt kê đơn hàng
      </div>
      <div class="row w3-res-tb">
        <div class="col-sm-4">
        </div>
        <div class="col-sm-3">
          <div class="input-group">
            <input type="text" class="input-sm form-control" placeholder="Search">
            <span class="input-group-btn">
              <button class="btn btn-sm btn-default" type="button">Tìm kiếm</button>
            </span>
          </div>
        </div>
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
              <th>Email</th>
              <th>Tên người nhận</th>
              <th>Phiếu giảm giá</th>
              <th>Địa chỉ giao hàng</th>
              <th>Thời gian</th>
              <th>Trạng thái</th>
              <th style="width:100px;">Quản lý</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($allDonHang as $key => $donHang)
            <tr>
              <td>{{ $key+1 }}</td>
              <td>{{ $donHang->Email }}</td>
              <td>{{ $donHang->GiaoHang->TenNguoiNhan }}</td>
              <td>{{ $donHang->PhieuGiamGia->TenMaGiamGia ?? 'Không có phiếu giảm giá' }}</td>
              <td>{{ $donHang->GiaoHang->DiaChi }}</td>
              <td>{{ $donHang->ThoiGianTao }}</td>
              <td><span class="text-ellipsis">
                @php
                if ($donHang->TrangThai == 1){
                @endphp
                  'Đơn hàng vừa được tạo'
                @php
                }elseif($donHang->TrangThai == 2){
                @endphp
                  'Nhân viên giao hàng đã lấy đơn hàng'
                @php
                }elseif($donHang->TrangThai == 3){
                @endphp
                  'Khách hàng thanh toán đơn hàng'
                @php
                }elseif($donHang->TrangThai == 4){
                @endphp
                  'Khách hàng không nhận đơn hàng'
                @php
                }
                @endphp
              </span></td>
              <td>
                <a href="{{ route('/TrangChiTietDonHang', $donHang->order_code) }}">
                  <i style="font-size: 20px; width: 100%; text-align: center; font-weight: bold; color: purple; margin-bottom: 15px" class="fa-solid fa-eye"></i>
                </a>
                <a onclick="return confirm('Bạn có muốn xóa đơn hàng này không?')" href="{{ route('/XoaDonHang', [$donHang->MaDonHang, $donHang->order_code]) }}">
                  <i style="font-size: 28px; width: 100%; text-align: center; font-weight: bold; color: red;" class="fa fa-times text-danger text"></i>
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <footer class="panel-footer">
        <div class="row">
          <div class="col-sm-7 text-right text-center-xs">                
            <ul class="pagination pagination-sm m-t-none m-b-none">
              {{ $allDonHang->links('vendor.pagination.bootstrap-4') }}
            </ul>
          </div>
      </div>
      </footer>
    </div>
</div>
@endsection