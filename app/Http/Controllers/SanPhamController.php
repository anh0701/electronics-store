<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\DanhMuc;
use App\Models\ThuongHieu;
use Illuminate\Support\Facades\Redirect;

class SanPhamController extends Controller
{
    public function TrangThemSanPham(){
        $allThuongHieu = ThuongHieu::orderBy('MaThuongHieu', 'DESC')->get();
        $allDanhMuc = DanhMuc::orderBy('MaDanhMuc', 'DESC')->get();
        return view('admin.SanPham.ThemSanPham')->with(compact('allThuongHieu', 'allDanhMuc'));
    }

    public function TrangLietKeSanPham(){
        $allSanPham = SanPham::orderBy('MaSanPham', 'DESC')->orderBy('MaThuongHieu', 'DESC')->paginate(20);
        return view('admin.SanPham.LietKeSanPham')->with(compact('allSanPham'));
    }

    public function ThemSanPham(Request $request){
        // $data = $request->validate([
        //     'TenSanPham' => 'required|max:50',
        //     'SlugSanPham' => 'required|unique:tbl_SanPham',
        //     'HinhAnh' => 'required|',
        //     'MoTa' => 'required|image|mimes:jpg,png,gif,svg|max:2048
        //     |dimensions:min_width=100, min_height=100, max_width=2000, max_height=2000',
        //     'Status' => 'required',
        // ],[
        //     'TenSanPham.required' => 'Chưa điền tên',
        //     'SlugSanPham.unique' => 'SlugSanPham trùng, vui lòng điền thông tin khác',
        // ]);
        $data = $request->all();
        $sanPham = new SanPham();
        $sanPham->TenSanPham = $data['TenSanPham'];
        $sanPham->SlugSanPham = $data['SlugSanPham'];
        $sanPham->MoTa = $data['MoTa'];
        $sanPham->TrangThai = $data['TrangThai'];
        $sanPham->MaDanhMuc = $data['MaDanhMuc'];
        $sanPham->MaThuongHieu = $data['MaThuongHieu'];
        $sanPham->GiaSanPham = $data['GiaSanPham'];
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $sanPham->ThoiGianTao = now();

        $get_image = $request->HinhAnh;
        $path = 'upload/SanPham/';
        $get_name_image = $get_image->getClientOriginalName(); 
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);

        $sanPham->HinhAnh = $new_image;
        $sanPham->save();
        
        return Redirect::to('TrangLietKeSanPham')->with('status', 'Thêm sản phẩm thành công');
    }

    public function TrangSuaSanPham($MaSanPham){
        $allThuongHieu = ThuongHieu::orderBy('MaThuongHieu', 'DESC')->get();
        $allDanhMuc = DanhMuc::orderBy('MaDanhMuc', 'DESC')->get();
        $sanPham = SanPham::where('MaSanPham' ,$MaSanPham)->get();
        return view('admin.SanPham.SuaSanPham', compact('sanPham', 'allThuongHieu', 'allDanhMuc')); 
    }

    public function SuaSanPham(Request $request, $MaSanPham){ // Request để lấy yêu cầu dữ liệu
        // $data = $request->validate([
        //     'TenThuongHieu' => 'required|max:50',
        //     'SlugThuongHieu' => 'required|unique:tbl_thuonghieu',
        //     'HinhAnh' => 'required|',
        //     'MoTa' => 'required|image|mimes:jpg,png,gif,svg|max:2048
        //     |dimensions:min_width=100, min_height=100, max_width=2000, max_height=2000',
        //     'Status' => 'required',
        // ],[
        //     'TenThuongHieu.required' => 'Chưa điền tên',
        //     'SlugThuongHieu.unique' => 'SlugThuongHieu trùng, vui lòng điền thông tin khác',
        // ]);
        $data = $request->all();
        $sanPham = SanPham::find($MaSanPham);
        $sanPham->TenSanPham = $data['TenSanPham'];
        $sanPham->SlugSanPham = $data['SlugSanPham'];
        $sanPham->MaDanhMuc = $data['MaDanhMuc'];
        $sanPham->MaThuongHieu = $data['MaThuongHieu'];
        $sanPham->GiaSanPham = $data['GiaSanPham'];
        $sanPham->MoTa = $data['MoTa'];
        $sanPham->TrangThai = $data['TrangThai'];
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $sanPham->ThoiGianSua = now();


        $get_image = $request->HinhAnh;
        if($get_image){
            // Xóa hình ảnh cũ
            $path_unlink = 'upload/SanPham/'.$sanPham->HinhAnh;
            if (file_exists($path_unlink)){
                unlink($path_unlink);
            }
            // Thêm mới
            $path = 'upload/SanPham/';
            $get_name_image = $get_image->getClientOriginalName(); // hinh123.jpg
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $sanPham->HinhAnh = $new_image;
        }
        $sanPham->save();
        return Redirect::to('TrangLietKeSanPham')->with('status', 'Cập nhật sản phẩm thành công');
    }

    public function XoaSanPham($MaSanPham){
        $sanPham = SanPham::find($MaSanPham);
        $path_unlink = 'upload/SanPham/'.$sanPham->HinhAnh;
        if (file_exists($path_unlink)){
            unlink($path_unlink);
        }
        $sanPham->delete();
        return Redirect::to('TrangLietKeSanPham')->with('status', 'Xóa sản phẩm thành công');
    }
}
