<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\PhiGiaoHang;
use App\Models\PhieuGiamGia;
use App\Models\DonHang;
use App\Models\GiaoHang;
use App\Models\ChiTietDonHang;
use Illuminate\Support\Facades\Redirect;

class DonHangController extends Controller
{
    public function TrangLietKeDonHang(){
        $allDonHang = DonHang::orderBy('MaDonHang', 'DESC')->paginate(20);
        return view('admin.DonHang.LietKeDonHang')->with(compact('allDonHang'));
    }

    public function TrangChiTietDonHang($order_code){
        $allDonHang = DonHang::where('order_code', $order_code)->first();
        $allChiTietDonHang = ChiTietDonHang::orderBy('MaCTDH', 'DESC')->where('order_code', $order_code)->get();        
        return view('admin.DonHang.TrangChiTietDonHang')->with(compact('allChiTietDonHang', 'allDonHang'));
    }

    public function XoaChiTietDonHang($MaCTDH){
        $order_code = ChiTietDonHang::where('MaCTDH', $MaCTDH)->first();
        
        $chiTietDonHang = ChiTietDonHang::find($MaCTDH);
        $chiTietDonHang->delete();
        return Redirect::to('TrangLietKeDonHang')->with('status', 'Xóa chi tiết đơn hàng thành công');
    }
}
