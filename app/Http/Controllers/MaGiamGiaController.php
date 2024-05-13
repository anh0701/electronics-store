<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MaGiamGia;
use Illuminate\Support\Facades\Redirect;

class MaGiamGiaController extends Controller
{
    public function TrangThemMaGiamGia(){
        return view('admin.MaGiamGia.ThemMaGiamGia');
    }

    public function TrangLietKeMaGiamGia(){
        $allMaGiamGia = MaGiamGia::orderBy('MaGiamGia', 'DESC')->paginate(20);
        return view('admin.MaGiamGia.LietKeMaGiamGia')->with(compact('allMaGiamGia'));
    }

    public function ThemMaGiamGia(Request $request){
        $data = $request->validate([
            'TenMaGiamGia' => 'required|unique:tbl_MaGiamGia|max:50',
            'SlugMaGiamGia' => 'required',
            'TinhNang' => 'required',
            'SoTien' => 'required',
            'MaCode' => 'required',
            'HinhAnh' => 'required',
        ],
        [
            'TenMaGiamGia.unique' => 'Trùng tên mã giảm giá với một mã giảm giá khác',
            'TenMaGiamGia.required' => 'Chưa điền tên mã giảm giá',
            'TenMaGiamGia.max' => 'Tên mã giảm giá dài quá 50 ký tự',
            'SlugMaGiamGia.required' => 'Chưa điền slug cho mã giảm giá',
            'TinhNang.required' => 'Chưa điền tính năng cho mã giảm giá',
            'MaCode.required' => 'Chưa điền Trạng thái cho mã giảm giá',
            'SoTien.required' => 'Chưa điền Số tiền cho mã giảm giá',
            'HinhAnh.required' => 'Chưa chọn hình ảnh cho mã giảm giá',
        ]);
        $MaGiamGia = new MaGiamGia();
        $MaGiamGia->TenMaGiamGia = $data['TenMaGiamGia'];
        $MaGiamGia->SlugMaGiamGia = $data['SlugMaGiamGia'];
        $MaGiamGia->TinhNang = $data['TinhNang'];
        $MaGiamGia->SoTien = $data['SoTien'];
        $MaGiamGia->MaCode = $data['MaCode'];

        $get_image = $request->HinhAnh;
        $path = 'upload/MaGiamGia/';
        $get_name_image = $get_image->getClientOriginalName(); 
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);

        $MaGiamGia->HinhAnh = $new_image;
        $MaGiamGia->save();
        
        return Redirect::to('TrangLietKeMaGiamGia')->with('status', 'Thêm mã giảm giá sản phẩm thành công');
    }

    public function TrangSuaMaGiamGia($MaGiamGia){
        $MaGiamGia = MaGiamGia::where('MaGiamGia' ,$MaGiamGia)->get();
        return view('admin.MaGiamGia.SuaMaGiamGia', compact('MaGiamGia')); 
    }

    public function SuaMaGiamGia(Request $request, $MaGiamGia){
        $data = $request->validate([
            'TenMaGiamGia' => 'required|unique:tbl_MaGiamGia|max:50',
            'SlugMaGiamGia' => 'required',
            'TinhNang' => 'required',
            'SoTien' => 'required',
            'MaCode' => 'required',
            'HinhAnh' => 'required',
        ],
        [
            'TenMaGiamGia.unique' => 'Trùng tên mã giảm giá với một mã giảm giá khác',
            'TenMaGiamGia.required' => 'Chưa điền tên mã giảm giá',
            'TenMaGiamGia.max' => 'Tên mã giảm giá dài quá 50 ký tự',
            'SlugMaGiamGia.required' => 'Chưa điền slug cho mã giảm giá',
            'TinhNang.required' => 'Chưa điền tính năng cho mã giảm giá',
            'MaCode.required' => 'Chưa điền Trạng thái cho mã giảm giá',
            'SoTien.required' => 'Chưa điền Số tiền cho mã giảm giá',
            'HinhAnh.required' => 'Chưa chọn hình ảnh cho mã giảm giá',
        ]);
        $MaGiamGia = MaGiamGia::find($MaGiamGia);
        $MaGiamGia->TenMaGiamGia = $data['TenMaGiamGia'];
        $MaGiamGia->SlugMaGiamGia = $data['SlugMaGiamGia'];
        $MaGiamGia->TinhNang = $data['TinhNang'];
        $MaGiamGia->SoTien = $data['SoTien'];
        $MaGiamGia->MaCode = $data['MaCode'];

        $get_image = $request->HinhAnh;
        $path = 'upload/MaGiamGia/';
        $get_name_image = $get_image->getClientOriginalName(); 
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);

        $MaGiamGia->HinhAnh = $new_image;
        $MaGiamGia->save();
        
        return Redirect::to('TrangLietKeMaGiamGia')->with('status', 'Sửa mã giảm giá sản phẩm thành công');
    }

    public function XoaMaGiamGia($MaGiamGia){
        $MaGiamGia = MaGiamGia::find($MaGiamGia);
        $path_unlink = 'upload/MaGiamGia/'.$MaGiamGia->HinhAnh;
        if (file_exists($path_unlink)){
            unlink($path_unlink);
        }
        $MaGiamGia->delete();
        return Redirect::to('TrangLietKeMaGiamGia')->with('status', 'Xóa mã giảmg giá thành công');
    }

}
