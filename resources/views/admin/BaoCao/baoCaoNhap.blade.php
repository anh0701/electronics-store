

@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Báo cáo nhập kho
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
            <table class="table table-striped b-t b-light table-bordered" style="text-align:center;">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th colspan="3" style="text-align:center;">Thời gian: {{ date_format(date_create($tgDau), 'd/m/Y') }} - {{ date_format(date_create($tgCuoi), 'd/m/Y') }}</th>
                    </tr>
                    <tr >
                        <th rowspan="2" >Mã sản phẩm</th>
                        <th rowspan="2" style="text-align:center;">Tên sản phẩm</th>
                        <th colspan="3" style="text-align:center;">Nhập trong kỳ</th>
                    </tr>
                    <tr>
                        <th>Số lượng</th>
                        <th>Giá nhập</th>
                        <th>Thành tiền</th
                    </tr>
                    
                </thead>
                <tbody>
                    @php
                        $tongNhap = 0;
                        $tongXuat = 0;
                        $tongSoNhap = 0;
                        $tongSoXuat = 0;
                        $tongSoTon = 0;
                        $tongGiaTri = 0;
                    @endphp
                    @foreach($data as $item)
                        <tr>
                            <td>{{ $item['maSanPham'] }}</td> 
                            <td>{{ $item['tenSanPham'] }}</td> <!-- Giả sử tên mặt hàng là 'ten' -->
                            @php
                                $thanhTienN = $item['tongSLNhap'] * $item['giaNhap'];
                                $tongNhap += $thanhTienN;
                                $tongSoNhap += $item['tongSLNhap'];    
                            @endphp
                            
                            <td>{{ $item['tongSLNhap'] }}</td>
                            <td>{{ $item['giaNhap'] }}</td>
                            <th>{{ $thanhTienN }}</th>
                        </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        
                        <td>Cộng</td>
                        <td>{{ $tongSoNhap }}</td>
                        <td></td>
                        <td>{{ $tongNhap }}</td>
                    </tr>
                </tbody>
            </table>

        </div>
        
    </div>
    <a href="{{ route('xemBaoCao') }}" style="margin: 5px"><button class="btn btn-info">Quay lại</button></a>
    <form action="{{ route('luuFileNhap') }}" method="POST">
        @csrf 
        <input type="hidden" name="dataSP" value="{{ $data }}">
        <input type="hidden" name="tgDau" value="{{ $tgDau }}">
        <input type="hidden" name="tgCuoi" value="{{ $tgCuoi }}">
        <button type="submit" style="margin: 5px" class="btn btn-info">Xuất file</button>
    </form>
</div>



@endsection