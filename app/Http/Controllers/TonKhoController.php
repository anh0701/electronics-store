<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TonKhoController extends Controller
{
    public function lietKe(){

        $dataTK = DB::table('tbl_sanpham')
                ->orderByDesc('tbl_sanpham.SoLuongTrongKho')
                ->paginate(10);

        $labels = $dataTK ->pluck('TenSanPham');
        $data = $dataTK ->pluck('SoLuongTrongKho');
//        dd($data);
//        dd($labels);
        return view('admin.TonKho.lietKeTK', compact('data', 'labels', 'dataTK' ));
    }

}
