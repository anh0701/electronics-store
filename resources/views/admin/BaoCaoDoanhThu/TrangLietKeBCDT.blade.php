@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
         Liệt kê báo cáo doanh thu
      </div>
      <div class="row w3-res-tb">
        <div class="col-sm-12">
          <div class="input-group">
            <form autocomplete="off">
              {{ csrf_field() }}
              <div class="col-md-3">
                  <p>Từ ngày: <input type="text" id="datepicker" class="form-control" ></p>
                  <input style="margin-top: 5px" type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm" value="Lọc kết quả">
              </div>
              <div class="col-md-3">
                  <p>Date: <input type="text" id="datepicker2" class="form-control"></p>
              </div>
              <div class="col-md-3">
                  <p>
                    Lọc theo:
                    <select class="dashoard-filter form-control">
                        <option value="">---Chọn---</option>
                        <option value="7ngay">7 ngày qua</option>
                        <option value="thangtruoc">tháng trước</option>
                        <option value="thangnay">tháng ngày</option>
                        <option value="3thangtruoc">3 tháng trước</option>
                        <option value="365ngayqua">365 ngày qua</option>
                    </select>
                  </p>
              </div>
            </form>
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
              <th>Hình ảnh</th>
              <th>Tên sản phẩm</th>
              <th>Số lượng bán</th>
              <th>Giá sản phẩm</th>
              <th>Doanh thu</th>
              <th>Lợi nhuận</th>
              <th style="width:100px;">Quản lý</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
      <footer class="panel-footer">
        <div class="row">
          <div class="col-sm-7 text-right text-center-xs">                
            <ul class="pagination pagination-sm m-t-none m-b-none">
              {{ $baoCaoDoanhThu->links('vendor.pagination.bootstrap-4') }}
            </ul>
          </div>
      </div>
      </footer>
    </div>
</div>
@endsection