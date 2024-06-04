

@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Báo cáo xuất nhập tồn
        </div>
        <div class="row w3-res-tb">
                <div class="col-sm-4 m-b-xs">
                </div>
                <div class="col-sm-7">
                
                </div>
                <div class="col-sm-1">
                    
                </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th colspan="4" style="text-align:center;">Thời gian: {{ date_format(date_create($tgDau), 'd/m/Y') }} - {{ date_format(date_create($tgCuoi), 'd/m/Y') }}</th>
                    </tr>
                    <tr>
                        <th>Mã sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Tồn đầu kỳ</th>
                        <th>Số lượng nhập</th>
                        <th>Số lượng xuất</th>
                        <th>Tồn cuối kỳ</th>
                    </tr>
                        
                    
                </thead>
                <tbody>
                    @foreach($data as $item)
                        <tr>
                            <td>{{ $item['maSanPham'] }}</td> 
                            <td>{{ $item['tenSanPham'] }}</td> <!-- Giả sử tên mặt hàng là 'ten' -->
                            @php 
                                $sltd = $item['soLuongSP'] + $item['tongSLXuat'] - $item['tongSLNhap'];
                            @endphp
                            <td>{{ $sltd }}</td>
                            <td>{{ $item['tongSLNhap'] }}</td>
                            <td>{{ $item['tongSLXuat'] }}</td>
                            <td>{{ $item['soLuongSP'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        
    </div>
    <a href="{{ route('xemBaoCao') }}" style="margin: 5px"><button class="btn btn-info">Quay lại</button></a>
    <form action="{{ route('luuFile') }}" method="POST">
        @csrf 
        <input type="hidden" name="dataSP" value="{{ $data }}">
        <input type="hidden" name="tgDau" value="{{ $tgDau }}">
        <input type="hidden" name="tgCuoi" value="{{ $tgCuoi }}">
        <button type="submit" style="margin: 5px" class="btn btn-info">Xuất file</button>
    </form>
</div>



@endsection