@extends('admin_layout')
@section('admin_content')
<div class="container-fluid">
    <style type="text/css">
        p.title_thongke {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
        }
    </style>
    <div class="row">
        <p class="title_thongke">Thống kê đơn hàng doanh số</p>
        <form autocomplete="off">
            {{ csrf_field() }}
            <div class="col-md-2">
                <p>Từ ngày: <input type="text" id="datepicker" class="form-control" ></p>
                <input style="margin-top: 5px" type="submit" id="btn-dashboard-filter" class="btn btn-primary btn-sm" value="Lọc kết quả">
            </div>
            <div class="col-md-2">
                <p>Date: <input type="text" id="datepicker2" class="form-control"></p>
            </div>
            <div class="col-md-2">
                <p>
                    Lọc theo:
                    <select class="dashoard-fillter form-control">
                        <option value="">---Chọn---</option>
                        <option value="7ngay">7 ngày qua</option>
                        <option value="thangtruoc">tháng trước</option>
                        <option value="thangnay">tháng ngày</option>
                        <option value="365ngayqua">365 ngày qua</option>
                    </select>
                </p>
            </div>
        </form>

        <div class="col-md-12" style="height: 400px">
            <div id="chart" class="chart" style="height:250px;"></div>
        </div>
    </div>
</div>
@endsection