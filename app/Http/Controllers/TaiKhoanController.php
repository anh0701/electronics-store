<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\TaiKhoan;
use App\Models\PhanQuyen;
use App\Models\PhanQuyenNguoiDung;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;


class TaiKhoanController extends Controller
{
    public function dangNhap(){
        session::forget('user');
        return view('auth.dangNhap');
    }

    public function dangKy(){
        return view('auth.dangKy');
    }

    public function xuLyDK(Request $request){
        $messages = [
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'email.unique' => 'Địa chỉ email đã được sử dụng.',
            'tentaikhoan.required' => 'Vui lòng nhập tên tài khoản.',
            'matkhau.required' => 'Vui lòng nhập mật khẩu.',
        ];

        $valid = $request->validate([
            'email' => 'required|email|unique:tbl_taikhoan',
            'tentaikhoan' => 'required',
            'matkhau' => 'required',
        ], $messages);

        $maTK = 'TKNV' . date('YmdHis');
        $valid = $request->all();
        $thoiGianTao = date('Y-m-d H:i:s');
        $matkhauMoi = bcrypt($request->matkhau);
        // Tạo tài khoản mới
        $taiKhoan = new TaiKhoan();
        $taiKhoan->MaTaiKhoan = $maTK;
        $taiKhoan->Email = $request->email;
        $taiKhoan->TenTaiKhoan = $request->tentaikhoan;
        $taiKhoan->MatKhau = $matkhauMoi;
        $taiKhoan->ThoiGianTao = $thoiGianTao;
        $taiKhoan->save();

        // Điều hướng sau khi tạo tài khoản thành công
        return redirect('/dang-nhap')->with('success', 'Tài khoản đăng ký thành công!');
    }

    public function trangAdmin(){
        $user = session('user');
        $quyen = $user['Quyen'];
        if($quyen == "NV" || $quyen == null){
            return redirect('/');
        }else{
            return view('trangQuanLy', compact('user'));
        }
        // Trả về view Dashboard và truyền thông tin người dùng vào view

    }

    public function dangXuat(){
        session::forget('user');
        return redirect('/dang-nhap'); // Chuyển hướng về trang đăng nhập
    }

    public function xuLyDN(Request $request){
        $messages = [
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'matkhau.required' => 'Vui lòng nhập mật khẩu.',
        ];

        $valid = $request->validate([
            'email' => 'required',
            'matkhau' => 'required',
        ], $messages);

        $valid = $request->all();
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
                return redirect('/trang-quan-ly');
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
        $messages = [
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'email.unique' => 'Địa chỉ email đã được sử dụng.',
            'tentaikhoan.required' => 'Vui lòng nhập tên tài khoản.',
            'matkhau.required' => 'Vui lòng nhập mật khẩu.',
        ];
        $valid = $request->validate([
            'email' => 'required|email|unique:tbl_taikhoan',
            'tentaikhoan' => 'required',
            'matkhau' => 'required',
            'hinhanh' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Giới hạn kích thước và loại hình ảnh
        ], $messages);

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
        return redirect('/trang-quan-ly')->with('success', 'Tài khoản đã được tạo thành công!');
    }

    public function lietKeTK(){
        $tk = DB::select("SELECT * FROM tbl_taikhoan WHERE quyen IS NOT NULL");
        return view('admin.TaiKhoan.lietKeTK', ['data'=>$tk]);
    }

    public function suaTK($id){
        $tk = DB::select("SELECT * FROM tbl_taikhoan WHERE tbl_taikhoan.MaTaiKhoan = '{$id}' LIMIT 1");
        return view('admin.TaiKhoan.suaTK', ['data'=>$tk]);
    }

    public function xuLySuaTK(Request $request){
        $maTK = $request->maTK;
        $tenTK = $request->tenTK;
        $email = $request->email;
        $sdt = $request->sdt;
        $quyen = $request->quyen;

        TaiKhoan::where('MaTaiKhoan', $maTK)->update([
            'TenTaiKhoan' => $tenTK,
            'Email' => $email,
            'SoDienThoai' => $sdt,
            'Quyen' => $quyen,
        ]);
        return redirect('/liet-ke-tai-khoan')->with('success', 'Tài khoản đã được sửa thành công!');
    }

    public function xoaTK($id){
        DB::delete('DELETE FROM tbl_taikhoan WHERE MaTaiKhoan = ?', [$id]);
        return redirect('/liet-ke-tai-khoan')->with('success', 'Tài khoản đã được xóa thành công!');
    }

    // public function show_dashboard(){
    //     return view('admin_layout');
    // }

    // public function TrangLietKeTaiKhoan(){
    //     $allTaiKhoan = TaiKhoan::orderBy('MaTaiKhoan', 'DESC')->paginate(10);
    //     $allPQND = PhanQuyenNguoiDung::orderBy('MaPQND', 'DESC')->get();
    //     $allPhanQuyen = PhanQuyen::orderBy('MaPhanQuyen', 'DESC')->get();
    //     return view('admin.TaiKhoan.LietKeTaiKhoan')->with(compact('allTaiKhoan', 'allPQND', 'allPhanQuyen'));
    // }

    // public function XoaPQND($MaPQND){
    //     $phanQuyenNguoiDung = PhanQuyenNguoiDung::find($MaPQND);
    //     $phanQuyenNguoiDung->delete();
    //     return Redirect::to('TrangLietKeTaiKhoan')->with('status', 'Xóa phân quyền của tài khoản thành công');
    // }

    // public function ThemPQND($MaTaiKhoan, $MaPhanQuyen){
    //     $phanQuyenNguoiDung = new PhanQuyenNguoiDung();
    //     $phanQuyenNguoiDung->MaTaiKhoan = $MaTaiKhoan;
    //     $phanQuyenNguoiDung->MaPhanQuyen = $MaPhanQuyen;
    //     $phanQuyenNguoiDung->save();
    //     return Redirect::to('TrangLietKeTaiKhoan')->with('status', 'Phân quyền cho tài khoản thành công');
    // }

    // public function XemChiTiet($MaTaiKhoan){
    //     $allTaiKhoan = TaiKhoan::orderBy('MaTaiKhoan', 'DESC')->get();
    //     $allPQND = PhanQuyenNguoiDung::orderBy('MaPQND', 'DESC')->where('MaTaiKhoan', $MaTaiKhoan)->get();
    //     $allPhanQuyen = PhanQuyen::orderBy('MaPhanQuyen', 'DESC')->get();
    //     return view('admin.TaiKhoan.XemChiTiet')->with(compact('allTaiKhoan', 'allPQND', 'allPhanQuyen'));
    // }

    // public function TrangTaoTaiKhoan(){
    //     return view('admin.TaiKhoan.TaoTaiKhoan');
    // }

    // public function TaoTaiKhoan(Request $request){

    // }

    // public function TrangDangNhap(){
    //     return view('admin.TaiKhoan.login');
    // }

    // public function DangNhapAdmin(Request $request){
    //     $data = $request->all();
    //     $Email = $data['Email'];
    //     $MatKhau = md5($data['MatKhau']);
    //     $login = TaiKhoan::where('Email', $Email)->where('MatKhau', $MatKhau)->first();
    //     if($login){
    //         $login_count = $login->count();
    //         if($login_count){
    //             Session::put('TenTaiKhoan', $login->TenTaiKhoan);
    //             Session::put('MaTaiKhoan', $login->MaTaiKhoan);
    //             return Redirect::to('/dashboard');
    //         }
    //     }else{
    //         Session::put('status', 'Mật khẩu hoặc tài khoản không đúng. Vui lòng đăng nhập lại');
    //         return Redirect::to('/DangNhapAdmin');
    //     }
    // }

}
