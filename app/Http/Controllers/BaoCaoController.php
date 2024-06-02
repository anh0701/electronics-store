<?php

namespace App\Http\Controllers;

use App\Models\ChiTietPhieuNhap;
use App\Models\ChiTietPhieuXuat;
use App\Models\PhieuNhap;
use App\Models\PhieuXuat;
use App\Models\SanPham;
use Illuminate\Http\Request;

class BaoCaoController extends Controller
{
    //
    public function xem(){
        return view('admin.BaoCao.xem', ['data' => '']);
    }

    public function xuLyTaoBaoCao(Request $request){
        $tgDau = $request->thoiGianDau;
        $tgCuoi = $request->thoiGianCuoi;

        $sp = SanPham::all()->keyBy('MaSanPham');

        $pns = PhieuNhap::whereBetween('ThoiGianTao', [$tgDau, $tgCuoi])
                        ->where('TrangThai', '=', 1)
                        ->get();
        $ctpns = ChiTietPhieuNhap::whereIn('MaPhieuNhap', $pns->pluck('MaPhieuNhap'))->get();
        $tongSLNhap = $ctpns->groupBy('MaSanPham')->map(function ($items) {
            return $items->sum('SoLuong');
        });

        $pxs = PhieuXuat::whereBetween('ThoiGianTao', [$tgDau, $tgCuoi])
                        ->where('TrangThai', '=', 1)
                        ->get();
        $ctpxs = ChiTietPhieuXuat::whereIn('MaPhieuXuat', $pxs->pluck('MaPhieuXuat'))->get();
        $tongSLXuat = $ctpxs->groupBy('MaSanPham')->map(function ($items) {
            return $items->sum('SoLuong');
        });


        $data = collect();

        foreach($sp as $maSanPham => $sanPham){
            $data->push([
                'maSanPham' => $maSanPham,
                'tenSanPham' => $sanPham->TenSanPham,
                'soLuongSP' => $sanPham->SoLuongTrongKho,
                'tongSLNhap' => $tongSLNhap->get($maSanPham, 0),
                'tongSLXuat' => $tongSLXuat->get($maSanPham, 0),
            ]);
        }

        $dataSP = $data->sortByDesc('tongSLXuat'); 

        return view('admin.BaoCao.baoCao', ['data' => $dataSP, 'tgDau'=>$tgDau, 'tgCuoi' => $tgCuoi]);
    }
}
