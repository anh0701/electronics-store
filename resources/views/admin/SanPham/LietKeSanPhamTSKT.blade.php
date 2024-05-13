@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
         Liệt kê thông số kỹ thuật sản phẩm
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
              <th>Thuộc danh mục TSKT</th>
              <th>Tên thông số kỹ thuật</th>
              <th>Cập nhật</th>
            </tr>
          </thead>
          <tbody>
            <form action="{{ Route('/SuaSanPhamTSKT') }}" method="POST">
              @foreach ($allDanhMucTSKT as $key => $valueDanhMucTSKT)
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td>{{ $valueDanhMucTSKT->TenDMTSKT }}</td>
                  <td>
                    <select name="ThongSoKyThuat{{ $key }}" class="form-control input-lg m-bot15">
                      @foreach ($allTSKT as $key => $valueTSKT)
                        @if ($valueTSKT->MaDMTSKT == $valueDanhMucTSKT->MaDMTSKT)
                          @foreach ($allSanPhamTSKT as $key => $valueSanPhamTSKT)
                            @if ($valueSanPhamTSKT->MaTSKT == $valueTSKT->MaTSKT)
                            <option selected value="{{ $valueSanPhamTSKT->ThongSoKyThuat->MaTSKT }}">---{{ $valueSanPhamTSKT->ThongSoKyThuat->TenTSKT }}---</option>
                            @elseif ($valueTSKT->MaDMTSKT == $valueSanPhamTSKT->ThongSoKyThuat->MaDMTSKT)
                            <option value="{{ $valueTSKT->MaTSKT }}">{{ $valueTSKT->TenTSKT }}</option>
                            @endif
                          @endforeach
                        @endif
                      @endforeach
                    </select>
                  </td>
                  <td>
                    <a href="{{ route('/SuaSanPhamTSKT', $valueTSKT) }}">
                      <i style="font-size: 20px; width: 100%; text-align: center; font-weight: bold; color: green; margin-bottom: 15px" class="fa fa-pencil-square-o text-success text-active"></i>
                    </a>
                  </td>
                </tr>
              @endforeach
            </form>
          </tbody> 
        </table>
      </div>
    </div>
</div>
@endsection