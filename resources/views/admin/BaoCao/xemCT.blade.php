@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Báo cáo {{ $fileName }}
        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>Mã sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th colspan="4" style="text-align:center;">{{ basename($fileName, ".xlsx") }}</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Tồn đầu kỳ</th>
                        <th>Số lượng nhập</th>
                        <th>Số lượng xuất</th>
                        <th>Tồn cuối kỳ</th>
                    </tr>                  
                </thead>
                <tbody>
                    @foreach ($data as $row)
                        <tr>
                            @foreach ($row as $cell)
                                <td>{{ $cell }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="row w3-res-tb">
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            Biểu đồ
                        </div>
                        <div class="card-body">
                            <canvas id="myChart2"></canvas>
                        </div>
                    </div>
                </div>

        </div>
    </div>
    <a href="{{ url()->previous() }}"><button class="btn btn-sm btn-info">Quay lại</button></a>
</div>   

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('myChart2').getContext('2d');
        var labels = {!! json_encode($labels) !!};
        var data = {!! json_encode($dataNhap) !!};
        var data2 = {!! json_encode($dataXuat) !!};
        var data3 = {!! json_encode($dataTon) !!};

        console.log(labels); 
        console.log(data); 
        console.log(data2);
        console.log(data3);

        var n = 3;
        var labelN = labels.slice(0, n);
        var dataN = data.slice(0, n);
        var data2N = data2.slice(0, n);
        var data3N = data3.slice(0, n);

        var labelNN = 'Khác';
        var dataNN = data.slice(n).reduce((a,b) => a + b, 0);
        var data2NN = data2.slice(n).reduce((a,b) => a + b, 0);
        var data3NN = data3.slice(n).reduce((a,b) => a + b, 0);
        
        labelN.push(labelNN);
        dataN.push(dataNN);
        data2N.push(data2NN);
        data3N.push(data3NN);

        var myChart = new Chart(ctx, {
            type: 'bar', // Hoặc 'doughnut'
            data: {
                labels: labelN,
                datasets: [
                    {
                        label: 'Số Lượng Nhập',
                        data: dataN,
                        backgroundColor: '#FFCCCC',
                        borderColor: '#FF3333',
                        borderWidth: 1
                    },
                    {
                        label: 'Số Lượng Xuất',
                        data: data2N,
                        backgroundColor: '#CCFFCC',
                        borderColor: '#00FF00',
                        borderWidth: 1
                    },
                    {
                        label: 'Số Lượng Tồn',
                        data: data3N,
                        backgroundColor: '#FFFFCC',
                        borderColor: '#FFFF00',
                        borderWidth: 1
                    }
                ]
            },
        });
    });
</script>  
@endsection