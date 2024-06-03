@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Báo cáo {{ $fileName }}
        </div>
        <div class="row w3-res-tb">
                <div class="col-sm-4 m-b-xs">
                </div>
                <div class="col-sm-3">

                </div>
                <div class="col-sm-5">
                </div>

        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
            @foreach ($data as $row)
                <tr>
                    @foreach ($row as $cell)
                        <td>{{ $cell }}</td>
                    @endforeach
                </tr>
            @endforeach
            </table>
        </div>
    </div>
    <a href="{{ url()->previous() }}"><button class="btn btn-sm btn-info">Quay lại</button></a>
</div>        
@endsection