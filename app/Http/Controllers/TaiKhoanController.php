<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\TaiKhoan;
use App\Models\PhanQuyen;
use App\Models\PhanQuyenNguoiDung;
use Illuminate\Support\Facades\Redirect;

class TaiKhoanController extends Controller
{
    public function show_dashboard(){
        return view('admin_layout');
    }

    public function TrangLietKeTaiKhoan(){
        $allTaiKhoan = TaiKhoan::orderBy('MaTaiKhoan', 'DESC')->paginate(10);
        $allPQND = PhanQuyenNguoiDung::orderBy('MaPQND', 'DESC')->get();
        $allPhanQuyen = PhanQuyen::orderBy('MaPhanQuyen', 'DESC')->get();
        return view('admin.TaiKhoan.LietKeTaiKhoan')->with(compact('allTaiKhoan', 'allPQND', 'allPhanQuyen'));
    }

    public function XoaPQND($MaPQND){
        $phanQuyenNguoiDung = PhanQuyenNguoiDung::find($MaPQND);
        $phanQuyenNguoiDung->delete();
        return Redirect::to('TrangLietKeTaiKhoan')->with('status', 'Xóa phân quyền của tài khoản thành công');
    }

    public function ThemPQND($MaTaiKhoan, $MaPhanQuyen){
        $phanQuyenNguoiDung = new PhanQuyenNguoiDung();
        $phanQuyenNguoiDung->MaTaiKhoan = $MaTaiKhoan;
        $phanQuyenNguoiDung->MaPhanQuyen = $MaPhanQuyen;
        $phanQuyenNguoiDung->save();
        return Redirect::to('TrangLietKeTaiKhoan')->with('status', 'Phân quyền cho tài khoản thành công');
    }

    public function XemChiTiet($MaTaiKhoan){
        $allTaiKhoan = TaiKhoan::orderBy('MaTaiKhoan', 'DESC')->get();
        $allPQND = PhanQuyenNguoiDung::orderBy('MaPQND', 'DESC')->where('MaTaiKhoan', $MaTaiKhoan)->get();
        $allPhanQuyen = PhanQuyen::orderBy('MaPhanQuyen', 'DESC')->get();
        return view('admin.TaiKhoan.XemChiTiet')->with(compact('allTaiKhoan', 'allPQND', 'allPhanQuyen'));
    }

    public function TrangTaoTaiKhoan(){
        return view('admin.TaiKhoan.TaoTaiKhoan');
    }

    public function TaoTaiKhoan(Request $request){
        
    }

    public function TrangDangNhap(){
        return view('admin.TaiKhoan.login');
    }

    public function DangNhapAdmin(Request $request){
        $data = $request->all();
        $Email = $data['Email'];
        $MatKhau = md5($data['MatKhau']);
        $login = TaiKhoan::where('Email', $Email)->where('MatKhau', $MatKhau)->first();
        if($login){
            $login_count = $login->count();
            if($login_count){
                Session::put('TenTaiKhoan', $login->TenTaiKhoan);
                Session::put('MaTaiKhoan', $login->MaTaiKhoan);
                return Redirect::to('/dashboard');
            }
        }else{
            Session::put('status', 'Mật khẩu hoặc tài khoản không đúng. Vui lòng đăng nhập lại');
            return Redirect::to('/DangNhapAdmin');
        }
    }

    public function DangXuat(){
        Session::put('TenTaiKhoan', null);
        Session::put('MaTaiKhoan', null);
        return Redirect::to('/TrangDangNhap');
    }
}