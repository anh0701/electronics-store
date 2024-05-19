<?php

namespace App\Http\Controllers;

use App\Models\ChuongTrinhGiamGiaSP;
use App\Models\SanPham;
use Illuminate\Http\Request;

class ChuongTrinhGiamGia extends Controller
{
    //
    public function giaoDienTao (){
        $products = SanPham::all();
        return view('admin.ChuongTrinhGiamGia.themChuongTrinhGiamGia', compact('products'));
    }

    public function taoChuongTrinhGiamGia (Request $request){
        $request->validate([
            'TenCTGG' => 'required',
            'SlugCTGG' => 'required',
            'HinhAnh' => 'required',
            'MoTa' => 'required',
            'TrangThai' => 'required',
            'MaSanPham' => 'required',
            'PhamTramGiam' => 'required',
        ]);
        $discountProgram = ChuongTrinhGiamGia::create($request->only(['TenCTGG', 'SlugCTGG', 'HinhAnh', 'MoTa', 'TrangThai']));
        ChuongTrinhGiamGiaSP::create([
            'MaSanPham' => $request->MaSanPham,
            'MaCTGG' => $discountProgram->MaCTGG,
            'PhamTramGiam' => $request->PhamTramGiam,
        ]);

        return redirect()->route('ChuongTrinhGiamGia.themChuongTrinhGiamGia')->with('success', 'Discount program created successfully!');
    }
    public function danhSachSanPham(Request $request)
    {
        $search = $request->input('q');
        $products = SanPham::where('TenSanPham', 'LIKE', "%{$search}%")
            ->get(['MaSanPham as id', 'TenSanPham as text']);

        return response()->json($products);
    }

}
