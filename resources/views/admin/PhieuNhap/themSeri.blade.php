@extends('admin_layout')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm Seri sản phẩm 
            </header>
            <div class="panel-body">
                <div class="position-center">
                    @if (!empty($ctsp))
                    <form id="" role="form" action="{{ Route('themSeri') }}" method="POST">
                        {{ csrf_field() }}
                        
                        
                        <div class="form-group">
                            <label for="">Chọn sản phẩm</label>
                            <select class="form-control input-lg m-bot15" id="" name="sanPham">
                                @foreach($ctsp as $i)
                                    <option value="{{ $i['maSP'] }}">{{ $i['tenSP'] }} - (Còn {{ $i['notSeri'] }} sản phẩm chưa nhập seri)</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="maPNSeri" value="{{$maPN}}">
                            <input type="text" class="form-control" name="tenSeri">
                        </div>
                        @error('tenSeri')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <button type="submit" class="btn btn-info">Thêm seri sản phẩm</button>
                    </form>
                    @endif
                    <div class="table-responsive">
                        <p class="head1">Danh sách seri sản phẩm nhập</p>
                        <table class="table table-striped b-t b-light">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Số Seri</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($seri as $key => $s)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $s->TenSanPham }}</td>
                                <td>{{ $s->MaSeri }}</td>
                            </tr>
                                
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <a href="{{ route('xemCTPN', ['id' => $maPN]) }}">
                        <button class="btn btn-info">Quay lại</button>
                    </a>
                </div>
            </div>
        </section>
    </div>
</div>

@endsection