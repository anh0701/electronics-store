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

        $dataDM = DB::table('tbl_sanpham')
                ->join('tbl_danhmuc', 'tbl_danhmuc.MaDanhMuc', '=', 'tbl_sanpham.MaDanhMuc')
                ->select('tbl_danhmuc.MaDanhMuc', 'tbl_danhmuc.TenDanhMuc', 
                DB::raw('SUM(tbl_sanpham.SoLuongTrongKho) as tongSLTK'))
                ->groupBy('tbl_danhmuc.MaDanhMuc')
                ->orderByDesc('tongSLTK');

        $labels = $dataDM ->pluck('TenDanhMuc');
        
        $data = $dataDM ->pluck('tongSLTK');
//        dd($data);
//        dd($labels);
        return view('admin.TonKho.lietKeTK', compact('data', 'labels', 'dataTK' ));
    }

}
