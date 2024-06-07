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
                <div class="col-sm-8">
                    <form id="baoCao" role="form" action="{{ route('xuLyTaoBaoCao') }}" method="POST">
                    {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-4">
                                <label class="" for="">Thời gian bắt đầu: </label>
                                <input class="input-sm form-control" type="date" name="thoiGianDau">
                            </div>

                            <div class="col-md-4">
                                <label class="" for="">Thời gian kết thúc: </label>
                                <input class="input-sm form-control" type="date" name="thoiGianCuoi" id="" >
                            </div>

                            <div class="col-md-4">
                                <button  class="btn btn-info" type="submit" style="margin-top:10%;">Tạo báo cáo</button>
                            </div>
                        </div>
                    </form>
                </div>

        </div>
        <div class="table-responsive" style="margin-top: 6%">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên báo cáo</th>
                        <th>Tải xuống file</th>
                    </tr>
                </thead>
                <tbody>
                @php
                    $key = 0;
                @endphp
                @foreach ($file as $i)
                    <tr>
                        <td>{{$key = $key + 1}}</td>
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
