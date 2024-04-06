@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
         Liệt kê tài khoản
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
              <th>Tên người dùng</th>
              <th>Email</th>
              <th>Khách hàng</th>
              <th>Nhân viên bán hàng</th>
              <th>Quản trị viên</th>
              <th>Quản trị viên cao cấp</th>
              <th>Nhân viên kho</th>
              <th>Nhân viên kế toán</th>
              <th style="width:100px;">Quản lý</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($allTaiKhoan as $key => $taiKhoan)
            <tr>
              <td>{{ $key+1 }}</td>
              <td>{{ $taiKhoan->TenTaiKhoan }}</td>
              <td>{{ $taiKhoan->Email }}</td>
              <td>
                @php
                  $trangThai = false;
                  $maPQND = '';
                  $maPhanQuyen = '1';
                @endphp
                @foreach ($allPQND as $key2 => $value)
                  @foreach ($allPhanQuyen as $key3 => $phanQuyen)
                    @if ($value->MaPhanQuyen == $phanQuyen->MaPhanQuyen && $value->MaTaiKhoan == $taiKhoan->MaTaiKhoan && $value->PhanQuyen->MaPhanQuyen == '1')
                    @php
                      $trangThai = true;
                      $maPQND = $value->MaPQND;
                    @endphp
                    @endif
                  @endforeach
                @endforeach
                @if ($trangThai)
                  <a href="{{ route('/XoaPQND', $maPQND) }}"><i class="fa-solid fa-square-check" style="color: green; font-size: 30px"></i></a>
                @else
                  <a href="{{ route('/ThemPQND', [$taiKhoan->MaTaiKhoan, $maPhanQuyen]) }}"><i class="fa-solid fa-square-xmark" style="color: red; font-size: 30px"></i></a>
                @endif  
              </td>
              <td>
                @php
                  $trangThai = false;
                  $maPQND = '';
                  $maPhanQuyen = '2';
                @endphp
                @foreach ($allPQND as $key2 => $value)
                  @foreach ($allPhanQuyen as $key3 => $phanQuyen)
                    @if ($value->MaPhanQuyen == $phanQuyen->MaPhanQuyen && $value->MaTaiKhoan == $taiKhoan->MaTaiKhoan && $value->PhanQuyen->MaPhanQuyen == '2')
                    @php
                      $trangThai = true;
                      $maPQND = $value->MaPQND;
                    @endphp
                    @endif
                  @endforeach
                @endforeach
                @if ($trangThai)
                  <a href="{{ route('/XoaPQND', $maPQND) }}"><i class="fa-solid fa-square-check" style="color: green; font-size: 30px"></i></a>
                @else
                  <a href="{{ route('/ThemPQND', [$taiKhoan->MaTaiKhoan, $maPhanQuyen]) }}"><i class="fa-solid fa-square-xmark" style="color: red; font-size: 30px"></i></a>
                @endif 
              </td>
              <td>
                @php
                $trangThai = false;
                  $maPQND = '';
                  $maPhanQuyen = '3';
                @endphp
                @foreach ($allPQND as $key2 => $value)
                  @foreach ($allPhanQuyen as $key3 => $phanQuyen)
                    @if ($value->MaPhanQuyen == $phanQuyen->MaPhanQuyen && $value->MaTaiKhoan == $taiKhoan->MaTaiKhoan && $value->PhanQuyen->MaPhanQuyen == '3')
                    @php
                      $trangThai = true;
                      $maPQND = $value->MaPQND;
                    @endphp
                    @endif
                  @endforeach
                @endforeach
                @if ($trangThai)
                  <a href="{{ route('/XoaPQND', $maPQND) }}"><i class="fa-solid fa-square-check" style="color: green; font-size: 30px"></i></a>
                @else
                  <a href="{{ route('/ThemPQND', [$taiKhoan->MaTaiKhoan, $maPhanQuyen]) }}"><i class="fa-solid fa-square-xmark" style="color: red; font-size: 30px"></i></a>
                @endif 
              </td>
              <td>
                @php
                $trangThai = false;
                  $maPQND = '';
                  $maPhanQuyen = '4';
                @endphp
                @foreach ($allPQND as $key2 => $value)
                  @foreach ($allPhanQuyen as $key3 => $phanQuyen)
                    @if ($value->MaPhanQuyen == $phanQuyen->MaPhanQuyen && $value->MaTaiKhoan == $taiKhoan->MaTaiKhoan && $value->PhanQuyen->MaPhanQuyen == '4')
                    @php
                      $trangThai = true;
                      $maPQND = $value->MaPQND;
                    @endphp
                    @endif
                  @endforeach
                @endforeach
                @if ($trangThai)
                  <a href="{{ route('/XoaPQND', $maPQND) }}"><i class="fa-solid fa-square-check" style="color: green; font-size: 30px"></i></a>
                @else
                  <a href="{{ route('/ThemPQND', [$taiKhoan->MaTaiKhoan, $maPhanQuyen]) }}"><i class="fa-solid fa-square-xmark" style="color: red; font-size: 30px"></i></a>
                @endif 
              </td>
              <td>
                @php
                $trangThai = false;
                  $maPQND = '';
                  $maPhanQuyen = '5';
                @endphp
                @foreach ($allPQND as $key2 => $value)
                  @foreach ($allPhanQuyen as $key3 => $phanQuyen)
                    @if ($value->MaPhanQuyen == $phanQuyen->MaPhanQuyen && $value->MaTaiKhoan == $taiKhoan->MaTaiKhoan && $value->PhanQuyen->MaPhanQuyen == '5')
                    @php
                      $trangThai = true;
                      $maPQND = $value->MaPQND;
                    @endphp
                    @endif
                  @endforeach
                @endforeach
                @if ($trangThai)
                  <a href="{{ route('/XoaPQND', $maPQND) }}"><i class="fa-solid fa-square-check" style="color: green; font-size: 30px"></i></a>
                @else
                  <a href="{{ route('/ThemPQND', [$taiKhoan->MaTaiKhoan, $maPhanQuyen]) }}"><i class="fa-solid fa-square-xmark" style="color: red; font-size: 30px"></i></a>
                @endif 
              </td>
              <td>
                @php
                $trangThai = false;
                  $maPQND = '';
                  $maPhanQuyen = '6';
                @endphp
                @foreach ($allPQND as $key2 => $value)
                  @foreach ($allPhanQuyen as $key3 => $phanQuyen)
                    @if ($value->MaPhanQuyen == $phanQuyen->MaPhanQuyen && $value->MaTaiKhoan == $taiKhoan->MaTaiKhoan && $value->PhanQuyen->MaPhanQuyen == '6')
                    @php
                      $trangThai = true;
                      $maPQND = $value->MaPQND;
                    @endphp
                    @endif
                  @endforeach
                @endforeach
                @if ($trangThai)
                  <a href="{{ route('/XoaPQND', $maPQND) }}"><i class="fa-solid fa-square-check" style="color: green; font-size: 30px"></i></a>
                @else
                  <a href="{{ route('/ThemPQND', [$taiKhoan->MaTaiKhoan, $maPhanQuyen]) }}"><i class="fa-solid fa-square-xmark" style="color: red; font-size: 30px"></i></a>
                @endif 
              </td>
              <td>
                <a href="{{ route('/XemChiTiet', $taiKhoan->MaTaiKhoan) }}">
                  <input type="submit" value="Xem chi tiết" placeholder="Assign roles" class="btn btn-primary">
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <footer class="panel-footer">
        <div class="row">
          <div class="col-sm-5 text-center">
          </div>
          <div class="col-sm-7 text-right text-center-xs">                
            <ul class="pagination pagination-sm m-t-none m-b-none">
            </ul>
          </div>
        </div>
      </footer>
    </div>
</div>
@endsection