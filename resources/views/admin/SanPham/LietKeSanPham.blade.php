@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
         Liệt kê sản phẩm
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
              <th>Tên sản phẩm</th>
              <th>Thuộc thương hiệu</th>
              <th>Thuộc danh mục</th>
              <th>Hình ảnh</th>
              <th>Trạng thái</th>
              <th>Giá</th>
              <th style="width:100px;">Quản lý</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($allSanPham as $key => $sanPham)
            <tr>
              <td>{{ $key+1 }}</td>
              <td>{{ $sanPham->TenSanPham }}</td>
              <td>{{ $sanPham->ThuongHieu->TenThuongHieu ?? 'None' }}</td>
              <td>{{ $sanPham->DanhMuc->TenDanhMuc }}</td>
              <td><img src="{{ asset('upload/sanPham/'.$sanPham->HinhAnh) }}" height="100px" width="150px"></td>
              <td><span class="text-ellipsis">
                <?php
                if ($sanPham->TrangThai == 1){
                ?>
                  <a href="{{ route('/KoKichHoatSanPham', $sanPham->MaSanPham) }}" ><span 
                    style="font-size: 28px; color: green; content: \f164" class="fa-solid fa-thumbs-up"></span></a>
                <?php
                }else{
                ?>
                  <a href="{{ route('/KichHoatsanPham', $sanPham->MaSanPham) }}" ><span 
                    style="font-size: 28px; color: red; ; content: \f164" class="fa-thumb-styling-down fa fa-thumbs-down"></span></a>
                <?php
                }
                ?>
              </span></td>
              <td>{{ $sanPham->GiaSanPham }}</td>
              <td>
                <a href="{{ route('/TrangSuaSanPham', $sanPham->MaSanPham) }}"><i style="font-size: 20px; width: 100%; text-align: center; font-weight: bold; color: green;" class="fa fa-pencil-square-o text-success text-active"></i></a>
                <a onclick="return confirm('Bạn có muốn xóa {{ $sanPham->TenSanPham }} không?')" href="{{ route('/XoaSanPham', [$sanPham->MaSanPham]) }}"><i style="font-size: 20px; width: 100%; text-align: center; font-weight: bold; color: red;" class="fa fa-times text-danger text"></i></a>
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
              {{ $allSanPham->links('vendor.pagination.bootstrap-4') }}
            </ul>
          </div>
      </div>
      </footer>
    </div>
</div>
@endsection