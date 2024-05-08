@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
         Liệt kê thông số kỹ thuật
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
            $status = Session::get('status');
            if ($status) {
                echo '<span style="font-size: 17px; width: 100%; text-align: center; font-weight: bold; color: red;" class="text-alert">'.$status.'</span>';
                Session::put('status', null);
            }
        ?>
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th>STT</th>
              <th>Tên thông số</th>
              <th>Slug</th>
              <th>Thuộc danh mục SP</th>
              <th>Thuộc danh mục TSKT</th>
              <th>Mô tả</th>
              <th style="width:100px;">Quản lý</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($allThongSoKyThuat as $key => $value)
            <tr>
              <td>{{ $key+1 }}</td>
              <td>{{ $value->TenTSKT }}</td>
              <td>{{ $value->SlugTSKT }}</td>
              <td>
                @foreach ($allDanhMucTSKT as $key => $danhMucTSKT)
                  @if ($danhMucTSKT->MaDMTSKT == $value->MaDMTSKT)
                    {{ $danhMucTSKT->DanhMuc->TenDanhMuc }}
                  @endif
                @endforeach
              </td>
              <td>{{ $value->DanhMucTSKT->TenDMTSKT }}</td>
              <td>{{ $value->MoTa }}</td>
              <td>
                <a href="{{ route('/TrangSuaTSKT', $value->MaTSKT) }}"><i style="font-size: 20px; width: 100%; text-align: center; font-weight: bold; color: green;" 
                    class="fa fa-pencil-square-o text-success text-active"></i></a>
                <a onclick="return confirm('Bạn có muốn xóa thông số kỹ thuật này không?')" href="{{ route('/XoaTSKT', [$value->MaTSKT]) }}">
                    <i style="font-size: 20px; width: 100%; text-align: center; font-weight: bold; color: red;" class="fa fa-times text-danger text"></i>
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
              {{ $allThongSoKyThuat->links('vendor.pagination.bootstrap-4') }}
            </ul>
          </div>
      </div>
      </footer>
    </div>
</div>
@endsection