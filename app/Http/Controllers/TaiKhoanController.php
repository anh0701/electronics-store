<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\TaiKhoan;
use App\Models\PhanQuyen;
use App\Models\PhanQuyenNguoiDung;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class TaiKhoanController extends Controller
{
    // public function dangNhap(){
    //     session::forget('user');
    //     return view('auth.dangNhap');
    
    public function dangNhap(Request $request){
        session::forget('user');
        return view('auth.dangNhap');
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
            return redirect()->back()->withInput()->withErrors([
                'email' => 'Email hoặc mật khẩu không đúng.',
            ]);
        }
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
            'tentaikhoan.unique' => 'Ten tai khoan đã được sử dụng.',
            'matkhau.required' => 'Vui lòng nhập mật khẩu.',
        ];
        $valid = $request->validate([
            'email' => [
            'required',
            'email',
                Rule::unique('tbl_taikhoan')->ignore($request->user_id),
            ],
            'tentaikhoan' => [
                'required',
                Rule::unique('tbl_taikhoan')->ignore($request->user_id),
            ],
        ], $messages);

        if (!$valid) {
            return redirect()->back()->withInput();
        }

        $maTK = 'TKNV' . date('YmdHis');
        $thoiGianTao = date('Y-m-d H:i:s');
        $matkhauMoi = bcrypt($request->matkhau);

        $taiKhoan = new TaiKhoan();
        $taiKhoan->MaTaiKhoan = $maTK;
        $taiKhoan->Email = $request->email;
        $taiKhoan->TenTaiKhoan = $request->tentaikhoan;
        $taiKhoan->MatKhau = $matkhauMoi;
        $taiKhoan->ThoiGianTao = $thoiGianTao;
        $taiKhoan->save();

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

    

    public function taoTK(){
        return view('admin.TaiKhoan.taoTK');
    }

    public function xuLyTaoTK(Request $request){
        $messages = [
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'email.unique' => 'Địa chỉ email đã được sử dụng.',
            'tentaikhoan.required' => 'Vui lòng nhập tên tài khoản.',
            'tentaikhoan.unique' => 'Ten tai khoan đã được sử dụng.',
            'matkhau.required' => 'Vui lòng nhập mật khẩu.',
        ];
        $valid = $request->validate([
            'email' => [
            'required',
            'email',
                Rule::unique('tbl_taikhoan')->ignore($request->user_id),
            ],
            'tentaikhoan' => [
                'required',
                Rule::unique('tbl_taikhoan')->ignore($request->user_id),
            ],
            'matkhau' => 'required',
            'hinhanh' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Giới hạn kích thước và loại hình ảnh
        ], $messages);

        if(!$valid){
            return redirect()->back()->withInput();
        }

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
        return redirect('/liet-ke-tai-khoan')->with('success', 'Tài khoản đã được tạo thành công!');
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
        $messages = [
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'email.unique' => 'Địa chỉ email đã được sử dụng.',
            'tentaikhoan.required' => 'Vui lòng nhập tên tài khoản.',
            'tentaikhoan.unique' => 'Ten tai khoan đã được sử dụng.',
            'matkhau.required' => 'Vui lòng nhập mật khẩu.',
        ];
        $valid = $request->validate([
            'email' => [
            'required',
            'email',
                Rule::unique('tbl_taikhoan')->ignore($request->maTK, 'MaTaiKhoan'),
            ],
            'tentaikhoan' => [
                'required',
                Rule::unique('tbl_taikhoan')->ignore($request->maTK, 'MaTaiKhoan'),
            ],
            'hinhanh' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Giới hạn kích thước và loại hình ảnh
        ], $messages);
        
        $valid = $request->all();
        $maTK = $request->maTK;
        $tenTK = $request->tentaikhoan;
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

}
