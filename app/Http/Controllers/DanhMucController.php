<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhMuc;
use App\Models\ThuongHieu;
use App\Models\ThuongHieuDanhMuc;
use Illuminate\Support\Facades\Redirect;

class DanhMucController extends Controller
{
    // Quản lý danh mục

    public function TrangThemDanhMuc(){
        $allDanhMuc = DanhMuc::orderBy('DanhMucCha', 'DESC')->where('DanhMucCha', 0)->get();
        return view('admin.DanhMuc.QuanlyDanhMuc.ThemDanhMuc')->with(compact('allDanhMuc'));
    }
    
    public function TrangLietKeDanhMuc(){
        $allDanhMuc = DanhMuc::orderBy('DanhMucCha', 'DESC')->orderBy('MaDanhMuc', 'DESC')->paginate(15);
        $allDanhMucCha = DanhMuc::where('DanhMucCha', 0)->get();
        return view('admin.DanhMuc.QuanlyDanhMuc.LietKeDanhMuc')->with(compact('allDanhMuc', 'allDanhMucCha'));
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
        return view('admin.DanhMuc.QuanlyDanhMuc.SuaDanhMuc', compact('suaDanhMuc', 'danhMuc')); 
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

    // Quản lý thương hiệu thuộc danh mục

    public function trangThemTHDM(){
        $allThuongHieu = ThuongHieu::orderBy('MaThuongHieu', 'DESC')->get();
        $allDanhMuc = DanhMuc::orderBy('MaDanhMuc', 'DESC')->get();
        $allDanhMucCha = DanhMuc::orderBy('MaDanhMuc', 'DESC')->where('DanhMucCha', 0)->get();
        return view('admin.DanhMuc.QuanLyTHDM.ThemTHDM')->with(compact('allThuongHieu', 'allDanhMuc', 'allDanhMucCha'));
    }

    public function trangLietKeTHDM(){
        $allTHDM = ThuongHieuDanhMuc::orderBy('MaDanhMuc', 'DESC')->paginate(20);
        $allDanhMuc = DanhMuc::orderBy('MaDanhMuc', 'DESC')->get();
        $allDanhMucCha = DanhMuc::orderBy('MaDanhMuc', 'DESC')->where('DanhMucCha', 0)->get();
        return view('admin.DanhMuc.QuanLyTHDM.LietKeTHDM')->with(compact('allTHDM', 'allDanhMuc'));
    }

    public function themTHDM(Request $request){
        $data = $request->validate([
            'MaThuongHieu' => 'required',
            'DanhMucCha' => 'required',
            'DanhMucCon' => '',
        ],
        [
            'DanhMucCha.required' => 'Chưa điền Danh mục cho sản phẩm',
            'MaThuongHieu.required' => 'Chưa điền Thương hiệu cho sản phẩm',
        ]);
        $thuongHieuDanhMuc = new ThuongHieuDanhMuc();
        if($data['DanhMucCon'] == false){
            $data['DanhMucCon'] = $data['DanhMucCha'];
            $thuongHieuDanhMuc->MaDanhMuc = $data['DanhMucCon'];
        }else{
            $thuongHieuDanhMuc->MaDanhMuc = $data['DanhMucCon'];
        }
        $thuongHieuDanhMuc->MaThuongHieu = $data['MaThuongHieu'];
        $thuongHieuDanhMuc->save();
        return Redirect::to('trang-liet-ke-thtdm')->with('status', 'Thêm thương hiệu vào danh mục thành công');
    }

    public function trangSuaTHDM($MaTHDM){
        $allThuongHieu = ThuongHieu::orderBy('MaThuongHieu', 'DESC')->get();
        $allDanhMuc = DanhMuc::orderBy('MaDanhMuc', 'DESC')->get();
        $thuongHieuDanhMuc = ThuongHieuDanhMuc::where('MaTHDM', $MaTHDM)->get();
        return view('admin.DanhMuc.QuanLyTHDM.SuaTHDM', compact('thuongHieuDanhMuc', 'allThuongHieu', 'allDanhMuc')); 
    }

    public function suaTHDM(Request $request, $MaTHDM){
        $data = $request->validate([
            'MaThuongHieu' => 'required',
            'DanhMucCha' => 'required',
            'DanhMucCon' => '',
        ],
        [
            'DanhMucCha.required' => 'Chưa điền Danh mục cho sản phẩm',
            'MaThuongHieu.required' => 'Chưa điền Thương hiệu cho sản phẩm',
        ]);
        $thuongHieuDanhMuc = ThuongHieuDanhMuc::find($MaTHDM);
        if($data['DanhMucCon'] == false){
            $data['DanhMucCon'] = $data['DanhMucCha'];
            $thuongHieuDanhMuc->MaDanhMuc = $data['DanhMucCon'];
        }else{
            $thuongHieuDanhMuc->MaDanhMuc = $data['DanhMucCon'];
        }
        $thuongHieuDanhMuc->MaThuongHieu = $data['MaThuongHieu'];
        $thuongHieuDanhMuc->save();
        return Redirect::to('trang-liet-ke-thtdm')->with('status', 'Cập nhật thương hiệu thuộc danh mục thành công');
    }

    public function xoaTHDM($MaTHDM){
        $thuongHieuDanhMuc = ThuongHieuDanhMuc::find($MaTHDM)->delete();
        return Redirect::to('trang-liet-ke-thtdm')->with('status', 'Xóa thương hiệu thuộc danh mục thành công');
    }

}
