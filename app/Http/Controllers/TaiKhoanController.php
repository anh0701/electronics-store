<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;
use App\Models\TaiKhoan;
use App\Models\PhanQuyen;
use App\Models\PhanQuyenNguoiDung;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class TaiKhoanController extends Controller
{
    public function dashboard(){
        return view('admin_layout');
    }

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
            if($taikhoan->Quyen == "Khách hàng"){
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
            'tentaikhoan.unique' => 'Tên tài khoản đã được sử dụng.',
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
        ], $messages);

        if (!$valid) {
            return redirect()->back()->withInput();
        }

        $maTK = 'TK' . date('YmdHis');
        $thoiGianTao = date('Y-m-d H:i:s');
        $matkhauMoi = bcrypt($request->matkhau);
        $quyen = 'Khách hàng';

        $taiKhoan = new TaiKhoan();
        $taiKhoan->MaTaiKhoan = $maTK;
        $taiKhoan->Email = $request->email;
        $taiKhoan->TenTaiKhoan = $request->tentaikhoan;
        $taiKhoan->MatKhau = $matkhauMoi;
        $taiKhoan->BacNguoiDung = 1;
        $taiKhoan->ThoiGianTao = $thoiGianTao;
        $taiKhoan->Quyen = $quyen;
        $taiKhoan->save();

        return redirect('/dang-nhap')->with('success', 'Tài khoản đăng ký thành công!');
    }

    public function trangAdmin(){
        $user = session('user');
        $quyen = $user['Quyen'];
        if($quyen == "Nhân viên" || $quyen == "Khách hàng"){
            return redirect('/');
        }else{
            return view('admin_layout', compact('user'));
        }
        // Trả về view Dashboard và truyền thông tin người dùng vào view

    }

    public function capNhatTK(){
        $user = session(('user'));
        $tenTK = $user['TenTaiKhoan'];
        if($tenTK != ""){
            $tk = DB::select("SELECT * FROM tbl_taikhoan WHERE TenTaiKhoan = '{$tenTK}'");
            return view('auth.capNhatTK', ['data' => $tk]);
        }
    }

    public function xuLyCNTK(Request $request){
        $messages = [
            'HinhAnh.image' => "Vui lòng chọn đúng file hình ảnh."
        ];
        $valid = Validator::make ( $request->all() ,[
            'HinhAnh' => ['nullable','image','mimes:jpeg,png,jpg,gif|max:2048'], // Giới hạn kích thước và loại hình ảnh
        ], $messages);

        if ($valid->fails()) {
            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($valid->errors());
        }
        // Lưu hình ảnh vào thư mục lưu trữ và lấy đường dẫn
        if ($request->hasFile('HinhAnh')) {
            $hinhanh = $request->file('HinhAnh');
            $tenHinhAnh = time() . '.' . $hinhanh->getClientOriginalExtension();
            $duongDan = public_path('upload/Profile');
            $hinhanh->move($duongDan, $tenHinhAnh);
            $duongDanHinhAnh = 'upload/Profile/' . $tenHinhAnh;
        } else {
            $duongDanHinhAnh = ''; // Nếu không có hình ảnh được tải lên
        }

        $valid = $request->all();
        $tenTK = session(('user'))['TenTaiKhoan'];
        $thoiGianSua = Carbon::now();
        $sdt = $request->SoDienThoai;
        $tenNguoiDung = $request->TenNguoiDung;
        $email = $request->Email;
        $diaChi = $request->DiaChi;
        $hinhAnh = $duongDanHinhAnh;

        TaiKhoan::where('TenTaiKhoan', $tenTK)->update([
            'TenNguoiDung' => $tenNguoiDung,
            'Email' => $email,
            'DiaChi' => $diaChi,
            'SoDienThoai' => $sdt,
            'ThoiGianSua' => $thoiGianSua,
            'HinhAnh' => $hinhAnh
        ]);


        $request->session()->put('user', [
            'TenTaiKhoan' => $tenTK,
            'Quyen' => $request->quyen
        ]);

        return redirect('/thong-tin-tai-khoan')->with('success', 'Tài khoản đã được sửa thành công!');
    }

    public function dangXuat(){
        session::forget('user');
        return redirect('/dang-nhap'); // Chuyển hướng về trang đăng nhập
    }

    public function lietKeTK(){
        $tk = DB::table('tbl_taikhoan')
                    ->select('tbl_taikhoan.*')
                    ->orderByDesc('tbl_taikhoan.ThoiGianTao')
                    ->paginate(10);
        return view('admin.TaiKhoan.lietKeTK', ['data'=>$tk]);
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
            'tentaikhoan.unique' => 'Tên tài khoản đã được sử dụng.',
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
        ], $messages);

        if(!$valid){
            return redirect()->back()->withInput();
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
        $taiKhoan->ThoiGianTao = $thoiGianTao;
        $taiKhoan->Quyen = $request->quyen;
        $taiKhoan->save();

        return redirect('/liet-ke-tai-khoan')->with('success', 'Tài khoản đã được tạo thành công!');
    }



    public function suaTK($id){
        $tk = DB::select("SELECT * FROM tbl_taikhoan WHERE tbl_taikhoan.MaTaiKhoan = '{$id}' LIMIT 1");
        return view('admin.TaiKhoan.suaTK', ['data'=>$tk]);
    }

    public function xuLySuaTK(Request $request){
        $maTK = $request->maTK;
        $quyen = $request->quyen;
        $thoiGianSua = date('Y-m-d H:i:s');
        TaiKhoan::where('MaTaiKhoan', $maTK)->update([
            'SoDienThoai' => $request->sdt,
            'Quyen' => $quyen,
            'ThoiGianSua' => $thoiGianSua,
        ]);
        return redirect('/liet-ke-tai-khoan')->with('success', 'Tài khoản đã được sửa thành công!');
    }

    public function xoaTK($id){
        DB::delete('DELETE FROM tbl_taikhoan WHERE MaTaiKhoan = ?', [$id]);
        return redirect('/liet-ke-tai-khoan')->with('success', 'Tài khoản đã được xóa thành công!');
    }

    public function timkiemTK(Request $request){
        $keyword = $request->input('keyword');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $quyen = $request->input('quyen');

        $query = "SELECT * FROM tbl_taikhoan WHERE 1=1"; // 1=1 để bắt đầu điều kiện WHERE

        if (!empty($startDate)) {
            $query .= " AND DATE(ThoiGianTao) >= '$startDate'";
        }

        if (!empty($endDate)) {
            $query .= " AND DATE(ThoiGianTao) <= '$endDate'";
        }

        if (!empty($quyen)){
            $query .= " AND Quyen LIKE '%$quyen%'";
        }

        if (!empty($keyword)) {
            $query .= " AND (TenTaiKhoan LIKE '%$keyword%'
                        OR Email LIKE '%$keyword%'
                        OR SoDienThoai LIKE '%$keyword%'
                        OR Email LIKE '%$keyword%'
                        OR ThoiGianTao LIKE '%$keyword%'
                        -- OR ThoiGianSua LIKE '%$keyword%'
                        )";
        }

        $data = DB::select($query);

        return view('admin.TaiKhoan.lietkeTK', compact('data'));
    }

    public function show_dashboard(){
        $user = session('user');
        $quyen = $user['Quyen'];
        if($quyen == "Nhân viên" || $quyen == "Khách hàng"){
            return redirect('/');
        }else{
            return view('admin_layout', compact('user'));
        }
    }
}
