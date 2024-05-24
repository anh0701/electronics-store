<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class TonKhoController extends Controller
{
    //
    public function lietKe(){
        $kho = DB::table('tbl_sanpham')
                ->orderByDesc('tbl_sanpham.SoLuongTrongKho')
                ->paginate(10);
        return view('admin.TonKho.lietKeTK', ['data' => $kho]);
    }

}
