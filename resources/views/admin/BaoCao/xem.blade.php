@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Tạo báo cáo xuất nhập tồn
        </div>
        <div class="row w3-res-tb">
                <div class="col-sm-4 m-b-xs">
                </div>
                <div class="col-sm-3">
                    <form id="baoCao" role="form" action="{{ route('xuLyTaoBaoCao') }}" method="POST">
                    {{ csrf_field() }}
                        <p class="" for="">Thời gian bắt đầu: </p><input class="input-sm form-control" type="date" name="thoiGianDau">
                        <p class="" for="">Thời gian kết thúc: </p><input class="input-sm form-control" type="date" name="thoiGianCuoi" id="" >
                        <button  class="btn btn-sm btn-info" type="submit" style="margin:5px;">Tạo báo cáo</button>
                    </form>
                </div>
                <div class="col-sm-5">
                </div>

        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>Tên báo cáo</th>
                        <th>Tải xuống file</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($file as $i)
                    <tr>
                        <td><a href="{{ route('xemBaoCaoCT', ['fileName' => basename($i)]) }}"> {{ basename($i) }}</a></td>
                        <td><a href="{{ route('taiXuong', ['fileName' => basename($i)]) }}">Tải xuống {{ basename($i) }}</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>        
@endsection