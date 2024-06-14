

@extends('admin_layout')
@section('admin_content')

@php
    if($loaiBaoCao == "baoCaoN"){
        $s1 = "BÁO CÁO NHẬP KHO";
        $s2 = "NHẬP TRONG KỲ";
    }elseif($loaiBaoCao == "baoCaoX"){
        $s1 = "BÁO CÁO XUẤT KHO";
        $s2 = "XUẤT TRONG KỲ";
    }else{
        $s1 = "BÁO CÁO TỒN KHO";
        $s2 = "TỒN TRONG KỲ";
    }
@endphp

<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            {{$s1}}
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
                        <th colspan="3" style="text-align:center;">THỜI GIAN: {{ date_format(date_create($tgDau), 'd/m/Y') }} - {{ date_format(date_create($tgCuoi), 'd/m/Y') }}</th>
                    </tr>
                    <tr >
                        <th rowspan="2" >MÃ SẢN PHẨM</th>
                        <th rowspan="2" style="text-align:center;">TÊN SẢN PHẨM</th>
                        <th colspan="3" style="text-align:center;">{{$s2}}</th>
                    </tr>
                    <tr>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Thành tiền</th
                    </tr>
                    
                </thead>
                <tbody>
                    @php
                        $tong = 0;
                        $tongSo = 0;
                    @endphp
                    @foreach($data as $item)
                        <tr>
                            <td>{{ $item['maSanPham'] }}</td> 
                            <td>{{ $item['tenSanPham'] }}</td> <!-- Giả sử tên mặt hàng là 'ten' -->
                            @php
                                $thanhTien = $item['tongSL'] * $item['gia'];
                                $tong += $thanhTien;
                                $tongSo += $item['tongSL'];    
                            @endphp
                            
                            <td>{{ $item['tongSL'] }}</td>
                            <td>{{ $item['gia'] }}</td>
                            <th>{{ $thanhTien }}</th>
                        </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        
                        <td>Cộng</td>
                        <td>{{ $tongSo }}</td>
                        <td></td>
                        <td>{{ $tong }}</td>
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
        <input type="hidden" name="loai" value="{{ $loaiBaoCao }}">
        <button type="submit" style="margin: 5px" class="btn btn-info">Xuất file</button>
    </form>
</div>



@endsection