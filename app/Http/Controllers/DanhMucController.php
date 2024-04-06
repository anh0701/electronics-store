<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhMuc;
use Illuminate\Support\Facades\Redirect;

class DanhMucController extends Controller
{
    public function TrangThemDanhMuc(){
        $allDanhMuc = DanhMuc::orderBy('DanhMucCha', 'DESC')->where('DanhMucCha', 0)->paginate(10);
        return view('admin.DanhMuc.ThemDanhMuc')->with(compact('allDanhMuc'));
    }
    
    public function TrangLietKeDanhMuc(){
        $allDanhMuc = DanhMuc::orderBy('MaDanhMuc', 'DESC')->paginate(10);
        return view('admin.DanhMuc.LietKeDanhMuc')->with(compact('allDanhMuc'));
    }

    public function ThemDanhMuc(Request $request){
        $data = $request->all();
        $danhMuc = new DanhMuc();
        $danhMuc->TenDanhMuc = $data['TenDanhMuc'];
        $danhMuc->SlugDanhMuc = $data['SlugDanhMuc'];
        $danhMuc->MoTa = $data['MoTa'];
        $danhMuc->TrangThai = $data['TrangThai'];
        $danhMuc->DanhMucCha = $data['DanhMucCha'];
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $danhMuc->ThoiGianTao = now();
        $danhMuc->save();
        return Redirect::to('TrangLietKeDanhMuc')->with('status', 'Thêm danh mục sản phẩm thành công');
    }

    public function KoKichHoatDanhMuc($MaDanhMuc){
        $danhMuc = DanhMuc::find($MaDanhMuc);
        $danhMuc->update(['TrangThai'=>0]);
        return Redirect::to('TrangLietKeDanhMuc')->with('status', 'Cập nhật tình trạng danh mục thành công');
    }

    public function KichHoatDanhMuc($MaDanhMuc){
        $danhMuc = DanhMuc::find($MaDanhMuc);
        $danhMuc->update(['TrangThai'=>1]);
        return Redirect::to('TrangLietKeDanhMuc')->with('status', 'Cập nhật tình trạng danh mục thành công');
    }

    public function TrangSuaDanhMuc($MaDanhMuc){
        $suaDanhMuc = DanhMuc::where('MaDanhMuc', $MaDanhMuc)->get();
        $danhMuc = DanhMuc::orderBy('MaDanhMuc', 'DESC')->get();
        return view('admin.DanhMuc.SuaDanhMuc', compact('suaDanhMuc', 'danhMuc')); 
    }

    public function SuaDanhMuc(Request $request, $MaDanhMuc){ // Request để lấy yêu cầu dữ liệu
        // $data = $request->validate([
        //     'TenDanhMuc' => 'required|max:50',
        //     'SlugDanhMuc' => 'required|unique:tbl_DanhMuc',
        //     'HinhAnh' => 'required|',
        //     'MoTa' => 'required|image|mimes:jpg,png,gif,svg|max:2048
        //     |dimensions:min_width=100, min_height=100, max_width=2000, max_height=2000',
        //     'Status' => 'required',
        // ],[
        //     'TenDanhMuc.required' => 'Chưa điền tên thương hiệu',
        //     'SlugDanhMuc.unique' => 'SlugDanhMuc trùng, vui lòng điền thông tin khác',
        // ]);
        $data = $request->all();
        $danhMuc = DanhMuc::find($MaDanhMuc);
        $danhMuc->TenDanhMuc = $data['TenDanhMuc'];
        $danhMuc->SlugDanhMuc = $data['SlugDanhMuc'];
        $danhMuc->MoTa = $data['MoTa'];
        $danhMuc->TrangThai = $data['TrangThai'];
        $danhMuc->DanhMucCha = $data['DanhMucCha'];
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $danhMuc->ThoiGianSua = now();
        $danhMuc->save();
        return Redirect::to('TrangLietKeDanhMuc')->with('status', 'Cập nhật thương hiệu sản phẩm thành công');
    }

    public function XoaDanhMuc($MaDanhMuc){
        $danhMuc = DanhMuc::find($MaDanhMuc)->delete();
        return Redirect::to('TrangLietKeDanhMuc')->with('status', 'Xóa thương hiệu sản phẩm thành công');
    }
}
