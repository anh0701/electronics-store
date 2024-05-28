@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm nhà cung cấp
            </header>
            <div class="panel-body">
                <div class="position-center">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                @endif
                    <form role="form" id="from" action="/xuLyThemNCC" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="tennhacungcap">Tên nhà cung cấp:</label>
                            <input class="form-control" type="hidden" id="nccMoi" name="nccMoi" value="{{ $test }}" readonly>
                            <input class="form-control" type="text" id="tennhacungcap" name="tennhacungcap" value="{{ old('tennhacungcap') }}">
                        </div>
                        <div class="form-group">
                            <label for="diachi">Địa chỉ:</label>
                            <input class="form-control" type="text" id="diachi" name="diachi" value="{{ old('diachi') }}">
                        </div>
                        <div class="form-group">
                            <label for="sdt">Số điện thoại:</label>
                            <input class="form-control" type="text" id="sdt" name="sdt" value="{{ old('sdt') }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input class="form-control" type="text" id="email" name="email" value="{{ old('email') }}">
                        </div>
                        <button type="submit" class="btn btn-info">Lưu</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
