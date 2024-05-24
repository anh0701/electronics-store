<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Session;
use App\Models\TaiKhoan;
use App\Models\SanPham;
use App\Models\PhieuGiamGia;
use App\Models\PhieuGiamGiaNguoiDung;
use App\Models\DonHang;
use App\Models\ChiTietDonHang;
use App\Models\GiaoHang;
use App\Models\DanhGia;
use Illuminate\Support\Facades\Redirect;

class DanhGiaController extends Controller
{
    public function DanhGia(Request $request){
        $data = $request->validate([
            'NoiDung' => 'required',
            'MaSanPham' => 'required',
            'SoSao' => 'required',
        ],[
            'NoiDung.required' => 'Bạn chưa điền nội dung đánh giá',
            'MaSanPham.required' => 'Chọn sản phẩm để đánh giá',
            'SoSao.required' => 'Chọn số sao để đánh giá sản phẩm',
        ]);
        if(Empty(Session::get('user'))){
            return Redirect()->back()->with('error', 'Bạn hãy đăng nhập để có thể đánh giá sản phẩm'); 
        }elseif(Session::get('user')){
            $user = Session('user');
            $allDonHang = DonHang::orderBy('MaDonHang', 'DESC')->where('Email', $user['Email'])->get();
            $allChiTietDonHang = ChiTietDonHang::orderBy('MaCTDH', 'DESC')->where('MaSanPham', $data['MaSanPham'])->get();
            foreach($allDonHang as $key => $valueDH){
                foreach($allChiTietDonHang as $key => $valueCTDH){
                    if($valueDH->order_code == $valueCTDH->order_code){
                        $danhGia = new DanhGia();
                        $danhGia->Email = $user['Email'];
                        $danhGia->MaSanPham = $data['MaSanPham'];
                        $danhGia->NoiDung = $data['NoiDung'];
                        $danhGia->TrangThai = 1;
                        $danhGia->SoSao = $data['SoSao'];
                        date_default_timezone_set('Asia/Ho_Chi_Minh');
                        $danhGia->ThoiGianTao = now();
                        $danhGia->save();
                        return Redirect()->back()->with('message', 'Đánh giá của bạn về sản phẩm được lưu lại'); 
                    }
                }
            }
        }
        return Redirect()->back()->with('error', 'Bạn phải mua sản phẩm này mới có thể sử dụng chức năng đánh giá sản phẩm');
    }

    public function TrangLietKeDanhGia(){
        $allDanhGia = DanhGia::orderBy('MaSanPham', 'DESC')->paginate(20);
        return view('admin.DanhGia.LietKeDanhGia')->with(compact('allDanhGia'));
    }

    public function KoKichHoatDanhGia($MaDanhGia){
        $danhGia = DanhGia::find($MaDanhGia);
        $danhGia->update(['TrangThai'=>0]);
        return Redirect::to('TrangLietKeDanhGia')->with('status', 'Cập nhật tình trạng đánh giá sản phẩm thành công');
    }

    public function KichHoatDanhGia($MaDanhGia){
        $danhGia = DanhGia::find($MaDanhGia);
        $danhGia->update(['TrangThai'=>1]);
        return Redirect::to('TrangLietKeDanhGia')->with('status', 'Cập nhật tình trạng đánh giá sản phảm thành công');
    }

    public function XoaDanhGia($MaDanhGia){
        $danhGia = DanhGia::find($MaDanhGia);
        $danhGia->delete();
        return Redirect::to('TrangLietKeDanhGia')->with('status', 'Xóa đánh giá sản phẩm thành công');
    }
}
