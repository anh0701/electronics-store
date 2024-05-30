@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
         Sản phẩm có trong chương trình giảm giá
      </div>
      <div class="table-responsive">
        <form action="{{ route('/ThemCTGG') }}" method="POST" enctype="multipart/form-data">
          <table class="table table-striped b-t b-light">
            <thead>
              <tr>
                  <th>Hình ảnh</th>
                  <th>Tên sản phẩm</th>
                  <th>Phần trăm giảm</th>
                  <th>Quản lý</th>
              </tr>
            </thead>
            <tbody>
              @if (Session('sanPham'))
              @foreach (Session('sanPham') as $key => $value)
                @foreach ($allSanPham as $key => $sanPham)
                  @if($sanPham->MaSanPham == $value['MaSanPham'])
                  <tr>
                    <td><img src="{{ asset('upload/sanPham/'.$sanPham->HinhAnh) }}" height="100px" width="150px"></td>
                    <td>{{ $sanPham->TenSanPham }}</td>
                    <td>
                      <form action="{{ route('/SuaPhanTramGiamSanPham', $value['session_id']) }}" method="POST">
                        {{ csrf_field() }}
                        <input type="number" name="PhanTramGiam" min="1" max="99" value="{{ $value['PhanTramGiam'] }}">
                        <button type="submit" class="btn btn-default">Cập nhật</button>
                      </form>
                    </td>
                    <td>
                      <a onclick="return confirm('Bạn có muốn xóa sản phẩm khỏi chương trình giảm giá không?')" href="{{ route('/XoaSanPhamKhoiSession', $value['session_id']) }}">
                          <i style="font-size: 28px; width: 100%; font-weight: bold; color: red;" class="fa fa-times text-danger text"></i>
                        </a>
                    </td>
                  </tr>
                  @endif
                @endforeach
              @endforeach
              @else
              <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
              </tr>
              @endif
            </tbody>
          </table>
          <div class="form-group">
            <label for="exampleInputEmail1">Chọn hình ảnh</label>
            <input type="file" class="form-control" name="HinhAnh" placeholder="Hình ảnh">
          </div>
          <button style="float: right; margin: 15px 0" type="submit" name="HienThiSanPham" class="btn btn-info ">Thêm sản phẩm vào chương trình giảm giá</button>          
      </form>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        Liệt kê các sản phẩm
      </div>
      @php
        $status = Session::get('status');
        if ($status) {
            echo '<span style="font-size: 17px; width: 100%; text-align: center; font-weight: bold; color: red;" class="text-alert">'.$status.'</span>';
            Session::put('status', null);
        }
      @endphp
      <div class="panel-body">
        <form action="{{ route('/HienThiSanPham') }}" method="post">
          {{ csrf_field() }}
            <div class="form-group row">
                <div class="col-lg-6">
                    <label for="exampleInputPassword1">Chọn danh mục cha</label>
                    <select name="DanhMucCha" id="DanhMucCha" class="form-control input-lg m-bot15 ThemTSKTChoSanPham DanhMucCha">
                        <option value="">--- Chọn danh mục cha ---</option>
                        @foreach ($allDanhMuc as $key => $danhMuc)
                            @if ($danhMuc->DanhMucCha == 0)
                                <option value="{{ $danhMuc->MaDanhMuc }}" >{{ $danhMuc->TenDanhMuc }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-6">
                    <label for="exampleInputPassword1">Chọn danh mục con</label>
                    <select name="DanhMucCon" id="DanhMucCon" class="form-control input-lg m-bot15 DanhMucCon">
                        <option value=""></option>
                    </select>
                </div>
            </div>
            <button type="submit" style="float: right;" name="HienThiSanPham" class="btn btn-info ">Hiển thị sản phẩm</button>
        </form>
      </div>
      <div class="table-responsive">
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
                <th>Hình ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Thương hiệu</th>
                <th>Giá tiền</th>
                <th>Quản lý</th>
            </tr>
          </thead>
          <tbody>
            @if (Empty($maDanhMuc))
              @foreach ($allSanPham as $key => $sanPham)
                <tr>
                  <td><img src="{{ asset('upload/sanPham/'.$sanPham->HinhAnh) }}" height="100px" width="150px"></td>
                  <td>{{ $sanPham->TenSanPham }}</td>
                  <td>{{ $sanPham->ThuongHieu->TenThuongHieu }}</td>
                  <td>{{ number_format($sanPham->GiaSanPham, 0, '', '.') }} đ</td>
                  <td>
                    <a href="{{ route('/ThemSanPhamVaoSession', $sanPham->MaSanPham) }}" ><span 
                      style="font-size: 28px; color: rgb(124, 124, 236); ; content: \f164" class="fa-solid fa-cart-plus"></span>
                    </a>
                  </td>
                </tr>
              @endforeach
            @else
              @foreach ($allSanPham as $key => $sanPham)
                @if ($sanPham->MaDanhMuc == $maDanhMuc)
                <tr>
                  <td><img src="{{ asset('upload/sanPham/'.$sanPham->HinhAnh) }}" height="100px" width="150px"></td>
                  <td>{{ $sanPham->TenSanPham }}</td>
                  <td>{{ $sanPham->ThuongHieu->TenThuongHieu }}</td>
                  <td>{{ number_format($sanPham->GiaSanPham, 0, '', '.') }} đ</td>
                  <td>
                      <a href="{{ route('/ThemSanPhamVaoSession', $sanPham->MaSanPham) }}" ><span 
                        style="font-size: 28px; color: rgb(124, 124, 236); ; content: \f164" class="fa-solid fa-cart-plus"></span>
                      </a>
                  </td>
                </tr>
                @endif
              @endforeach
            @endif
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