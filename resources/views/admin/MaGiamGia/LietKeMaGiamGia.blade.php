@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
         Liệt kê mã giảm giá
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
        <?php
            $message = Session::get('status');
            if ($message) {
                echo '<span style="font-size: 17px; width: 100%; text-align: center; font-weight: bold; color: red;" class="text-alert">'.$message.'</span>';
                Session::put('message', null);
            }
        ?>
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th>STT</th>
              <th>Tên Mã giảm giá</th>
              <th>Slug</th>
              <th>Hình ảnh</th>
              <th>Tính năng</th>
              <th>Mã Code</th>
              <th style="width:100px;">Quản lý</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($allMaGiamGia as $key => $maGiamGia)
            <tr>
              <td>{{ $key+1 }}</td>
              <td>{{ $maGiamGia->TenMaGiamGia }}</td>
              <td>{{ $maGiamGia->SlugMaGiamGia }}</td>
              <td><img src="{{ asset('upload/MaGiamGia/'.$maGiamGia->HinhAnh) }}" height="100px" width="150px"></td>
              <td><span class="text-ellipsis">
                @php
                    if($maGiamGia->TinhNang == 1)
                        echo 'Giảm theo phần trăm';
                    elseif ($maGiamGia->TinhNang == 2)
                        echo 'Giảm ththẳng giá';
                    else
                        echo 'Miễn phí giao hàng';
                @endphp
              </span></td>
              <td>{{ number_format($maGiamGia->SoTien, 0, '', '.') }} đ</td>
              <td>{{ $maGiamGia->MaCode }}</td>
              <td>
                <a href="{{ route('/TrangSuaMaGiamGia', $maGiamGia->MaGiamGia) }}"><i style="font-size: 20px; width: 100%; text-align: center; font-weight: bold; color: green;" class="fa fa-pencil-square-o text-success text-active"></i></a>
                <a onclick="return confirm('Bạn có muốn xóa Mã giảm giá {{ $maGiamGia->TenMaGiamGia }} không?')" href="{{ route('/XoaMaGiamGia', [$maGiamGia->MaGiamGia]) }}"><i style="font-size: 20px; width: 100%; text-align: center; font-weight: bold; color: red;" class="fa fa-times text-danger text"></i></a>
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
              {{ $allMaGiamGia->links('vendor.pagination.bootstrap-4') }}
            </ul>
          </div>
      </div>
      </footer>
    </div>
</div>
@endsection