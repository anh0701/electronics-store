@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liêt kê mã giảm giá
            </div>
            <div class="row w3-res-tb">
                <div class="col-sm-5 m-b-xs">
                </div>
                <div class="col-sm-2">
                </div>
                <div class="col-sm-5">
                    <form action="{{ Route('/timKiem') }}" method="get">
                        <div class="input-group">
                            <input type="text" class="input-sm form-control" placeholder="Tìm kiếm" name="timKiem">
                            <span class="input-group-btn">
              <button class="btn btn-sm btn-default" type="submit">Tìm kiếm</button>
            </span>
                            <span class="input-group-btn">
                                <a class="btn btn-sm btn-default" href="{{ Route('/liet-ke-phieu-giam-gia') }}">Xem tất cả</a>
                            </span>
                        </div>
                    </form>

                </div>
            </div>
            <div class="table-responsive">
                <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<span style="font-size: 17px; width: 100%; text-align: center; font-weight: bold; color: red;" class="text-alert">' . $message . '</span>';
                    Session::put('message', null);
                }
                ?>
                <table class="table table-striped b-t b-light">
                    <thead>
                    <tr>
                        <th style="width:20px;">
                            <label class="i-checks m-b-none">
                                <input type="checkbox"><i></i>
                            </label>
                        </th>
                        <th>STT</th>
                        <th>Tên phiếu giảm giá</th>
                        <th>Mã code phiếu giảm giá</th>
                        <th>Slug</th>
                        <th>Số tiền | Phần trămm giảm</th>
                        <th>Trị giá</th>
                        <th style="width:100px;">Quản lý</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($phieuGiamGia as $key => $phieu)
                        <tr>
                            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label>
                            </td>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $phieu->TenMaGiamGia }}</td>
                            <td>{{ $phieu->MaCode }}</td>
                            <td>{{$phieu->SlugMaGiamGia}}</td>
                            <td>
                                @if($phieu->DonViTinh == 1)
                                    Giảm theo tiền
                                @else
                                    Giảm theo %
                                @endif
                            </td>
                            </td>
                            <td>
                                @if($phieu->DonViTinh == 1)
{{--                                    Giảm {{ number_format($phieu->TriGia).''.''.'' }}đ--}}
{{--                                    Giảm {{$phieu->TriGia}}đ--}}
                                    Giảm {{ strpos($phieu->TriGia, ',') === false ? number_format($phieu->TriGia, 0, '', ',') : $phieu->TriGia }}đ
                                @else
                                    Giảm {{ strpos($phieu->TriGia, ',') === false ? number_format($phieu->TriGia, 0, '', ',') : $phieu->TriGia }}%
                                    {{--                                    Giảm {{ number_format($phieu->TriGia)}}%--}}
{{--                                    Giảm {{$phieu->TriGia}}%--}}
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('/sua-phieu-giam-gia', $phieu->MaGiamGia) }}"><i
                                        style="font-size: 20px; width: 100%; text-align: center; font-weight: bold; color: green;"
                                        class="fa fa-pencil-square-o text-success text-active"></i></a>
                                <a onclick="return confirm('Bạn có muốn xóa mã giảm giá {{ $phieu->TenMaGiamGia }} này không?')"
                                   href="{{ route('/xoa-phieu-giam-gia', [$phieu->MaGiamGia]) }}"><i
                                        style="font-size: 20px; width: 100%; text-align: center; font-weight: bold; color: red;"
                                        class="fa fa-times text-danger text"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <footer class="panel-footer">
                <div class="row">
                    <div class="col-sm-5 text-center">
                    </div>
                    <div class="col-sm-7 text-right text-center-xs">
                        <ul class="pagination pagination-sm m-t-none m-b-none">
                            @if ($phieuGiamGia instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                {{ $phieuGiamGia->links('vendor.pagination.bootstrap-4') }}
                            @endif
                        </ul>
                    </div>
                </div>
            </footer>
        </div>
    </div>
@endsection