<?php

namespace App\Http\Controllers;

use App\Models\NhaCungCap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
class NhaCungCapController extends Controller
{
    //
    public function lietKe(){
        $user = session('user');
        $quyen = $user['Quyen'];
        $limit = 20;
        $ncc = DB::select("SELECT * FROM tbl_nhacungcap LIMIT ?", [$limit]);
        if($quyen == "NV" || $quyen == null){
            return redirect('/');
        }else{
            return view('admin.NhaCungCap.lietKeNCC', ['data'=>$ncc]);
        } 
    }

    public function themNCC(){
        return view('admin.NhaCungCap.themNCC');
    }

    public function xuLyThemNCC(Request $request){
        $messages = [
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email đã được sử dụng.',
            'tennhacungcap.required' => 'Vui lòng nhập tên nhà cung cấp.',
            'tennhacungcap.unique' => 'Tên nhà cung cấp đã được sử dụng.',
        ];
        $valid = $request->validate([
            'email' => [
            'required',
            'email',
                Rule::unique('tbl_nhacungcap')->ignore($request->user_id),
            ],
            'tennhacungcap' => [
                'required',
                Rule::unique('tbl_nhacungcap')->ignore($request->user_id),
            ],
        ], $messages);

        if (!$valid) {
            return redirect()->back()->withInput();
        }

        $tenNCC = $request->tennhacungcap;
        $maNCC = 'NCC' . date('YmdHis');
        $thoiGianTao = date('Y-m-d H:i:s');

        $nhacungcap = new NhaCungCap();
        $nhacungcap->MaNhaCungCap = $maNCC;
        $nhacungcap->TenNhaCungCap = $tenNCC;
        $nhacungcap->DiaChi = $request->diachi;
        $nhacungcap->SoDienThoai = $request->sdt;
        $nhacungcap->Email = $request->email;
        $nhacungcap->ThoiHanHopDong = $request->thoihanhopdong;
        $nhacungcap->ThoiGianTao = $thoiGianTao;
        $nhacungcap->save();

        return redirect('/liet-ke-nha-cung-cap')->with('success', 'Thên nhà cung cấp thành công!');

    }

    public function suaNCC($id){
        $ncc = DB::select("SELECT * FROM tbl_nhacungcap WHERE tbl_nhacungcap.MaNhaCungCap = '{$id}' LIMIT 1");
        return view('admin.NhaCungCap.suaNCC', ['data'=>$ncc]);
    }

    public function xuLySuaNCC(Request $request){
        $messages = [
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'email.unique' => 'Địa chỉ email đã được sử dụng.',
            'tennhacungcap.required' => 'Vui lòng nhập tên tài khoản.',
            'tennhacungcap.unique' => 'Ten tai khoan đã được sử dụng.',
        ];
        $valid = $request->validate([
            'email' => [
            'required',
            'email',
                Rule::unique('tbl_nhacungcap')->ignore($request->maNCC, 'MaNhaCungCap'),
            ],
            'tennhacungcap' => [
                'required',
                Rule::unique('tbl_nhacungcap')->ignore($request->maNCC, 'MaNhaCungCap'),
            ],
        ], $messages);
        
        $valid = $request->all();
        $maNCC = $request->maNCC;
        $tenNCC = $request->tennhacungcap;
        $email = $request->email;
        $sdt = $request->sdt;
        $diachi = $request->diachi;
        $thoihanHD = $request->thoihanhopdong;
        $thoigiansua = date('Y-m-d H:i:s');

        NhaCungCap::where('MaNhaCungCap', $maNCC)->update([
            'TenNhaCungCap' => $tenNCC,
            'DiaChi' => $diachi,
            'SoDienThoai' => $sdt,
            'Email' => $email,
            'ThoiHanHopDong' => $thoihanHD,
            'ThoiGianSua' => $thoigiansua,        
        ]);
        return redirect('/liet-ke-nha-cung-cap')->with('success', 'Nha cung cap đã được sửa thành công!');
    }

    public function xoaNCC($id){
        DB::delete('DELETE FROM tbl_nhacungcap WHERE MaNhaCungCap = ?', [$id]);
        return redirect('/liet-ke-nha-cung-cap')->with('Success', 'Xoa nha cung cap thanh cong');
    }

}