<?php

namespace App\Http\Controllers;

use App\Models\PhieuGiamGia;
use Illuminate\Http\Request;

class PhieuGiamGiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function phieuGiamGia()
    {
        //
        return view('');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function giaoDienTao()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function taoPhieuGiamGia(Request $request)
    {
        //
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
    public function giaoDienSua(PhieuGiamGia $phieuGiamGia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function suaPhieuGiamGia(Request $request, PhieuGiamGia $phieuGiamGia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function Xoa(PhieuGiamGia $phieuGiamGia)
    {
        //
    }
}
