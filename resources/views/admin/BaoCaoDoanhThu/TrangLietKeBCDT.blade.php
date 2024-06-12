@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
         Liệt kê báo cáo doanh thu
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
              <th>Ngày tháng năm</th>
              <th>Doanh thu</th>
              <th>Lợi nhuận</th>
              <th>Số lượng sản phẩm</th>
              <th>Số lượng đơn hàng</th>
              <th style="width:100px;">Quản lý</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($baoCaoDoanhThu as $key => $value)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ date("d-M-Y", strtotime($value->order_date)) }}</td>
                <td>{{ number_format($value->sales, 0, '', '.') }} đ</td>
                <td>{{ number_format($value->profit, 0, '', '.') }} đ</td>
                <td>{{ $value->quantity }}</td>
                <td>{{ $value->total_order }}</td>
                <td></td>
            </tr>
            @endforeach
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
    <form action="{{ route('xuatFileBCDT') }}" method="GET">
        @csrf 
        <button type="submit" class="btn btn-info">Xuất file</button>
    </form>
</div>
@endsection