<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\SanPham;
use App\Models\DanhMuc;
use App\Models\ThuongHieu;
use App\Models\TaiKhoan;
use App\Models\PhanQuyen;
use App\Models\PhanQuyenNguoiDung;

use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function index(){
        $allDanhMuc = DanhMuc::orderBy('MaDanhMuc', 'ASC')->where('TrangThai', '1')->get();
        $allThuongHieu = ThuongHieu::orderBy('MaThuongHieu', 'DESC')->where('TrangThai', '1')->get();
        $allSanPham = SanPham::orderBy('MaDanhMuc', 'DESC')->where('TrangThai', '1')->paginate('20');
        return view('pages.home')->with(compact('allDanhMuc', 'allThuongHieu', 'allSanPham'));
    }

    public function HienThiThuongHieu($MaThuongHieu){
        $sanPhamThuocThuongHieu = SanPham::orderBy('MaDanhMuc', 'DESC')->where('TrangThai', '1')->
        where('MaThuongHieu', $MaThuongHieu)->paginate('20');
        $allThuongHieu = ThuongHieu::orderBy('MaThuongHieu', 'DESC')->where('TrangThai', '1')->get();
        $allDanhMuc = DanhMuc::orderBy('MaDanhMuc', 'ASC')->where('TrangThai', '1')->get();
        return view('pages.ThuongHieu.HienThiThuongHieu')->with(compact('allDanhMuc', 'allThuongHieu', 'sanPhamThuocThuongHieu'));
    }

    public function HienThiDanhMucCha($MaDanhMuc){
        $danhMucCha = $MaDanhMuc;
        $allThuongHieu = ThuongHieu::orderBy('MaThuongHieu', 'DESC')->where('TrangThai', '1')->get();
        $allDanhMuc = DanhMuc::orderBy('MaDanhMuc', 'ASC')->where('TrangThai', '1')->get();
        $allSanPham = SanPham::orderBy('MaDanhMuc', 'DESC')->where('TrangThai', '1')->get();
        return view('pages.DanhMuc.HienThiDanhMucCha')->with(compact('allDanhMuc', 'allThuongHieu', 'allSanPham', 'danhMucCha'));
    }

    public function HienThiDanhMucCon($MaDanhMuc){
        $allThuongHieu = ThuongHieu::orderBy('MaThuongHieu', 'DESC')->where('TrangThai', '1')->get();
        $allDanhMuc = DanhMuc::orderBy('MaDanhMuc', 'ASC')->where('TrangThai', '1')->get();
        $sanPhamThuocDanhMuc = SanPham::orderBy('MaDanhMuc', 'DESC')->where('TrangThai', '1')->
        where('MaDanhMuc', $MaDanhMuc)->paginate('20');
        return view('pages.DanhMuc.HienThiDanhMucCon')->with(compact('allDanhMuc', 'allThuongHieu', 'sanPhamThuocDanhMuc'));
    }

    public function ChiTietSanPham($MaSanPham){
        $chiTietSanPham = SanPham::where('MaSanPham', $MaSanPham)->first();
        $allThuongHieu = ThuongHieu::orderBy('MaThuongHieu', 'DESC')->where('TrangThai', '1')->get();
        $allDanhMuc = DanhMuc::orderBy('MaDanhMuc', 'ASC')->where('TrangThai', '1')->get();
        return view('pages.SanPham.ChiTietSanPham')->with(compact('allDanhMuc', 'allThuongHieu', 'chiTietSanPham'));;
    }

    public function TimKiem(Request $request){
        $allDanhMuc = DanhMuc::orderBy('MaDanhMuc', 'ASC')->where('TrangThai', '1')->get();
        $allThuongHieu = ThuongHieu::orderBy('MaThuongHieu', 'DESC')->where('TrangThai', '1')->get();
        $keywords = $request->keywords_submit;

        if($keywords == ''){
            return Redirect::to('/');
        }

        $timKiemSanPham = SanPham::orderBy('MaDanhMuc', 'DESC')->where('TrangThai', '1')
        ->where('TenSanPham', 'like', '%'.$keywords.'%')->get();
        return view('pages.SanPham.TimKiem')->with(compact('allDanhMuc', 'allThuongHieu', 'timKiemSanPham', 'keywords'));
    }

    public function GioHang(){
        return view('pages.GioHang.GioHang');
    }

    public function TrangKhachHangDangNhap(){
        return view('pages.TaiKhoan.login');
    }

    public function KhachHangDangNhap(Request $request){
        $data = $request->all();
        $Email = $data['Email'];
        $MatKhau = md5($data['MatKhau']);
        $login = TaiKhoan::where('Email', $Email)->where('MatKhau', $MatKhau)->first();
        // $isAdmin = 0;
        if($login){
            $login_count = $login->count();
            if($login_count){
                // $phanQuyenNguoiDung = PhanQuyenNguoiDung::orderBy('MaPQND', 'DESC')->get();
                // foreach($phanQuyenNguoiDung as $key => $value){
                //     if($value->MaTaiKhoan == $login->MaTaiKhoan){
                //         $isAdmin++;
                //     }
                // }
                Session::put('MaTaiKhoan', $login->MaTaiKhoan); 
                // if($isAdmin > 1){
                //     Session::put('isAdmin', $isAdmin); 
                // }
                return Redirect::to('/');
            }
        }else{
            Session::put('status', 'Mật khẩu hoặc tài khoản không đúng. Vui lòng đăng nhập lại');
            return Redirect::to('/TrangKhachHangDangNhap');
        }
    }

    public function KhachHangDangXuat(){
        Session::put('TenTaiKhoan', null);
        Session::put('MaTaiKhoan', null);
        return Redirect::to('/');
    }
}