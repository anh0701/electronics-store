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
                        <p class="" for="">Nhập thời gian bắt đầu: </p><input class="input-sm form-control" type="date" name="thoiGianDau">
                        <p class="" for="">Thời gian kết thúc: </p><input class="input-sm form-control" type="date" name="thoiGianCuoi" id="" value="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" readonly>
                        <button  class="btn btn-sm btn-default" type="submit" style="margin:5px;">Tạo báo cáo</button>
                    </form>
                </div>
                <div class="col-sm-5">
                </div>
            </div>
        </div>
    </div>
</div>        
@endsection