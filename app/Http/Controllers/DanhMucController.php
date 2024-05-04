<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhMuc;
use App\Models\ThuongHieu;
use App\Models\ThuongHieuThuocDanhMuc;
use Illuminate\Support\Facades\Redirect;

class DanhMucController extends Controller
{
    public function TrangThemDanhMuc(){
        $allDanhMuc = DanhMuc::orderBy('DanhMucCha', 'DESC')->where('DanhMucCha', 0)->get();
        return view('admin.DanhMuc.ThemDanhMuc')->with(compact('allDanhMuc'));
    }
    
    public function TrangLietKeDanhMuc(){
        $allDanhMuc = DanhMuc::orderBy('MaDanhMuc', 'DESC')->paginate(15);
        return view('admin.DanhMuc.LietKeDanhMuc')->with(compact('allDanhMuc'));
    }

    public function trangThemThuongHieuVaoDanhMuc(){
        $allThuongHieu = ThuongHieu::orderBy('MaThuongHieu', 'DESC')->get();
        $allDanhMuc = DanhMuc::orderBy('MaDanhMuc', 'DESC')->get();
        $allDanhMucCha = DanhMuc::orderBy('MaDanhMuc', 'DESC')->where('DanhMucCha', 0)->get();
        return view('admin.DanhMuc.ThemThuongHieuVaoDanhMuc')->with(compact('allThuongHieu', 'allDanhMuc', 'allDanhMucCha'));
    }

    public function themThuongHieuVaoDanhMuc(){

    }

    public function trangLietKeTHDM(){
        $allTHDM = ThuongHieuThuocDanhMuc::orderBy('MaDanhMuc', 'DESC')->paginate(20);
        return view('admin.DanhMuc.LietKeTHDM')->with(compact('allTHDM'));
    }

    public function ThemDanhMuc(Request $request){
        $data = $request->validate([
            'TenDanhMuc' => 'required|unique:tbl_danhmuc|max:50',
            'SlugDanhMuc' => 'required',
            'MoTa' => 'required',
            'TrangThai' => 'required',
            'DanhMucCha' => 'required',
        ],
        [
            'TenDanhMuc.unique' => 'Trùng tên danh mục với một danh mục khác',
            'TenDanhMuc.required' => 'Chưa điền tên danh mục',
            'TenDanhMuc.max' => 'Tên danh mục dài quá 50 ký tự',
            'SlugDanhMuc.required' => 'Chưa điền slug cho danh mục',
            'MoTa.required' => 'Chưa điền Mô tả cho danh mục',
            'TrangThai.required' => 'Chưa điền Trạng thái cho danh mục',
            'DanhMucCha.required' => 'Chưa chọn cấp độ cho danh mục',
        ]);
        $danhMuc = new DanhMuc();
        $danhMuc->TenDanhMuc = $data['TenDanhMuc'];
        $danhMuc->SlugDanhMuc = $data['SlugDanhMuc'];
        $danhMuc->DanhMucCha = $data['DanhMucCha'];
        $danhMuc->MoTa = $data['MoTa'];
        $danhMuc->TrangThai = $data['TrangThai'];
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

    public function SuaDanhMuc(Request $request, $MaDanhMuc){
        $data = $request->validate([
            'TenDanhMuc' => 'required|max:50',
            'SlugDanhMuc' => 'required',
            'MoTa' => 'required',
            'TrangThai' => 'required',
            'DanhMucCha' => 'required',
        ],
        [
            'TenDanhMuc.required' => 'Chưa điền tên danh mục',
            'TenDanhMuc.max' => 'Tên danh mục dài quá 50 ký tự',
            'SlugDanhMuc.required' => 'Chưa điền slug cho danh mục',
            'MoTa.required' => 'Chưa điền Mô tả cho danh mục',
            'TrangThai.required' => 'Chưa điền Trạng thái cho danh mục',
            'DanhMucCha.required' => 'Chưa chọn cấp độ cho danh mục',
        ]);
        $danhMuc = DanhMuc::find($MaDanhMuc);
        $danhMuc->TenDanhMuc = $data['TenDanhMuc'];
        $danhMuc->SlugDanhMuc = $data['SlugDanhMuc'];
        $danhMuc->DanhMucCha = $data['DanhMucCha'];
        $danhMuc->MoTa = $data['MoTa'];
        $danhMuc->TrangThai = $data['TrangThai'];
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $danhMuc->ThoiGianSua = now();
        $danhMuc->save();
        return Redirect::to('TrangLietKeDanhMuc')->with('status', 'Cập nhật danh mục sản phẩm thành công');
    }

    public function XoaDanhMuc($MaDanhMuc){
        $danhMuc = DanhMuc::find($MaDanhMuc)->delete();
        return Redirect::to('TrangLietKeDanhMuc')->with('status', 'Xóa danh mục sản phẩm thành công');
    }
}
