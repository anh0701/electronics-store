<?php

namespace App\Http\Controllers;

use App\Models\PhieuGiamGia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PhieuGiamGiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function phieuGiamGia()
    {
        //
        $phieuGiamGia = PhieuGiamGia::orderBy('MaGiamGia', 'DESC')->get();
        return view('admin.PhieuGiamGia.lietKePhieuGiamGia')->with(compact("phieuGiamGia"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function giaoDienTao()
    {
        //
        return view('admin.PhieuGiamGia.themPhieuGiamGia');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function taoPhieuGiamGia(Request $request)
    {
        //
        $data = $request->all();
        $phieu = new PhieuGiamGia();
        $phieu->TenMaGiamGia = $data['TenMaGiamGia'];
        $phieu->SlugMaGiamGia = $data['SlugMaGiamGia'];
        $phieu->TriGia = $data['TriGia'];
        $phieu->MaCode = $data['MaCode'];
        $phieu->DonViTinh = $data['DonViTinh'];
        $phieu->save();

        return Redirect::to('/liet-ke-phieu-giam-gia')->with('message', 'Thêm mã giảm giá thành công');

    }

    /**
     * Display the specified resource.
     */
    public function hienThiCTP(PhieuGiamGia $phieuGiamGia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function giaoDienSua($MaGiamGia)
    {
        //
        $suaPhieu = PhieuGiamGia::where('MaGiamGia', $MaGiamGia)->get();
        return view('admin.PhieuGiamGia.suaPhieuGiamGia', compact('suaPhieu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function suaPhieuGiamGia(Request $request, $MaGiamGia)
    {
        //
        $data = $request->all();
//        dd($data);
        $phieu = PhieuGiamGia::find($MaGiamGia);
//        dd($phieu);
        $phieu->TenMaGiamGia = $request->TenMaGiamGia;
        $phieu->SlugMaGiamGia = $request->SlugMaGiamGia;
        $phieu->TriGia = $request->TriGia;
        $phieu->MaCode = $request->MaCode;
        $phieu->DonViTinh = $request->DonViTinh;
        $phieu->save();

        return Redirect::to('/liet-ke-phieu-giam-gia')->with('message', 'Sửa mã giảm giá thành công');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function Xoa($MaGiamGia)
    {
        //
        $phieuGiamGia = PhieuGiamGia::find($MaGiamGia);
        $phieuGiamGia->delete();
        return Redirect::to('liet-ke-phieu-giam-gia')->with('status', 'Xóa mã giảm giá thành công');

    }
}
