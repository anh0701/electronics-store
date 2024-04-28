<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\TaiKhoan;
use App\Models\PhanQuyen;
use App\Models\PhanQuyenNguoiDung;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
class TaiKhoanController extends Controller
{
    public function dangNhap(){
        session::forget('user');
        return view('admin.TaiKhoan.dangNhap');
    }

    public function trangAdmin(){
        $user = session('user');
        $quyen = $user['Quyen'];
        if($quyen == "" || $quyen == null){
            return redirect('/');
        }else{
            return view('trangQuanLy', compact('user'));
        }
        // Trả về view Dashboard và truyền thông tin người dùng vào view
        
    }

    public function dangXuat(){
        session::forget('user');
        return redirect('/dangNhap'); // Chuyển hướng về trang đăng nhập
    }

    public function xuLyDN(Request $request){
        $email = $request->input('email');
        $matkhau = $request->input('matkhau');
        $taikhoan = TaiKhoan::where('Email', $email)->first();

        if ($taikhoan && password_verify($matkhau, $taikhoan->MatKhau)) {
            if($taikhoan->Quyen == ""){
                $request->session()->put('user', [
                    'TenTaiKhoan' => $taikhoan->TenTaiKhoan,
                    'Quyen' => $taikhoan->Quyen,
                ]);
                return redirect('/');
            }
            else{
                $request->session()->put('user', [
                    'TenTaiKhoan' => $taikhoan->TenTaiKhoan,
                    'Quyen' => $taikhoan->Quyen,
                ]);
                return redirect('/trangAdmin');
            }
        } else {
            return redirect()->back()->withErrors([
                'email' => 'Email hoặc mật khẩu không đúng.',
            ]);
        }
    }

    public function taoTK(){
        return view('admin.TaiKhoan.taoTK');
    }

    public function xuLyTaoTK(Request $request){
        $valid = $request->validate([
            'email' => 'required|email|unique:tbl_taikhoan',
            'tentaikhoan' => 'required',
            'sdt' => 'required',
            'matkhau' => 'required',
            'hinhanh' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Giới hạn kích thước và loại hình ảnh
            'quyen' => 'required',
        ]);
        
        // Lưu hình ảnh vào thư mục lưu trữ và lấy đường dẫn
        if ($request->hasFile('hinhanh')) {
            $hinhanh = $request->file('hinhanh');
            $tenHinhAnh = time() . '.' . $hinhanh->getClientOriginalExtension();
            $duongDan = public_path('uploads/hinhanh');
            $hinhanh->move($duongDan, $tenHinhAnh);
            $duongDanHinhAnh = 'uploads/hinhanh/' . $tenHinhAnh;
        } else {
            $duongDanHinhAnh = ''; // Nếu không có hình ảnh được tải lên
        }

        $maTK = 'TKNV' . date('YmdHis');
        $valid = $request->all();
        $thoiGianTao = date('Y-m-d H:i:s');
        $matkhauMoi = bcrypt($request->matkhau);
        // Tạo tài khoản mới
        $taiKhoan = new TaiKhoan();
        $taiKhoan->MaTaiKhoan = $maTK;
        $taiKhoan->Email = $request->email;
        $taiKhoan->TenTaiKhoan = $request->tentaikhoan;
        $taiKhoan->SoDienThoai = $request->sdt;
        $taiKhoan->MatKhau = $matkhauMoi;
        $taiKhoan->HinhAnh = $duongDanHinhAnh; // Lưu đường dẫn hình ảnh
        $taiKhoan->ThoiGianTao = $thoiGianTao;
        $taiKhoan->Quyen = $request->quyen;
        $taiKhoan->save();
    
        // Điều hướng sau khi tạo tài khoản thành công
        return redirect('/trangAdmin')->with('success', 'Tài khoản đã được tạo thành công!');
    }

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

}
