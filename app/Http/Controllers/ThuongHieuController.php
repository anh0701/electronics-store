<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ThuongHieu;
use Illuminate\Support\Facades\Redirect;

class ThuongHieuController extends Controller
{
    public function TrangThemThuongHieu(){
        return view('admin.ThuongHieu.ThemThuongHieu');
    }

    public function TrangLietKeThuongHieu(){
        $allThuongHieu = ThuongHieu::orderBy('MaThuongHieu', 'DESC')->paginate(5);
        return view('admin.ThuongHieu.LietKeThuongHieu')->with(compact('allThuongHieu'));
    }

    public function ThemThuongHieu(Request $request){
        $data = $request->validate([
            'TenThuongHieu' => 'required|max:50',
            'SlugThuongHieu' => 'required|unique:tbl_thuonghieu',
            'HinhAnh' => 'required|',
            'MoTa' => 'required|image|mimes:jpg,png,gif,svg|max:2048
            |dimensions:min_width=100, min_height=100, max_width=2000, max_height=2000',
            'Status' => 'required',
        ],[
            'TenThuongHieu.required' => 'Chưa điền tên thương hiệu',
            'SlugThuongHieu.unique' => 'SlugThuongHieu trùng, vui lòng điền thông tin khác',
            'MoTa' => 'Mô tả thương hiệu đang trống, vui lòng điền thông tin',
        ]);
        $data = $request->all();
        $thuongHieu = new ThuongHieu();
        $thuongHieu->TenThuongHieu = $data['TenThuongHieu'];
        $thuongHieu->SlugThuongHieu = $data['SlugThuongHieu'];
        $thuongHieu->MoTa = $data['MoTa'];
        $thuongHieu->TrangThai = $data['TrangThai'];
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $thuongHieu->ThoiGianTao = now();

        $get_image = $request->HinhAnh;
        $path = 'upload/ThuongHieu/';
        $get_name_image = $get_image->getClientOriginalName(); 
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);

        $thuongHieu->HinhAnh = $new_image;
        $thuongHieu->save();
        
        return Redirect::to('TrangLietKeThuongHieu')->with('status', 'Thêm thương hiệu sản phẩm thành công');
    }

    public function KoKichHoatThuongHieu($MaThuongHieu){
        $thuongHieu = ThuongHieu::find($MaThuongHieu);
        $thuongHieu->update(['TrangThai'=>0]);
        return Redirect::to('TrangLietKeThuongHieu')->with('status', 'Cập nhật tình trạng thương hiệu thành công');
    }

    public function KichHoatThuongHieu($MaThuongHieu){
        $thuongHieu = ThuongHieu::find($MaThuongHieu);
        $thuongHieu->update(['TrangThai'=>1]);
        return Redirect::to('TrangLietKeThuongHieu')->with('status', 'Cập nhật tình trạng thương hiệu thành công');
    }

    public function TrangSuaThuongHieu($MaThuongHieu){
        $thuongHieu = ThuongHieu::where('MaThuongHieu' ,$MaThuongHieu)->get();
        return view('admin.ThuongHieu.SuaThuongHieu', compact('thuongHieu')); 
    }

    public function SuaThuongHieu(Request $request, $MaThuongHieu){ // Request để lấy yêu cầu dữ liệu
        $data = $request->validate([
            'TenThuongHieu' => 'required|max:50',
            'SlugThuongHieu' => 'required|unique:tbl_thuonghieu',
            'HinhAnh' => 'required|',
            'MoTa' => 'required|image|mimes:jpg,png,gif,svg|max:2048
            |dimensions:min_width=100, min_height=100, max_width=2000, max_height=2000',
            'Status' => 'required',
        ],[
            'TenThuongHieu.required' => 'Chưa điền tên thương hiệu',
            'SlugThuongHieu.unique' => 'SlugThuongHieu trùng, vui lòng điền thông tin khác',
        ]);
        $data = $request->all();
        $thuongHieu = ThuongHieu::find($MaThuongHieu);
        $thuongHieu->TenThuongHieu = $data['TenThuongHieu'];
        $thuongHieu->SlugThuongHieu = $data['SlugThuongHieu'];
        $thuongHieu->MoTa = $data['MoTa'];
        $thuongHieu->TrangThai = $data['TrangThai'];
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $thuongHieu->ThoiGianSua = now();


        $get_image = $request->HinhAnh;
        if($get_image){
            // Xóa hình ảnh cũ
            $path_unlink = 'upload/ThuongHieu/'.$thuongHieu->HinhAnh;
            if (file_exists($path_unlink)){
                unlink($path_unlink);
            }
            // Thêm mới
            $path = 'upload/ThuongHieu/';
            $get_name_image = $get_image->getClientOriginalName(); // hinh123.jpg
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $thuongHieu->HinhAnh = $new_image;
        }
        $thuongHieu->save();
        return Redirect::to('TrangLietKeThuongHieu')->with('status', 'Cập nhật thương hiệu sản phẩm thành công');
    }

    public function XoaThuongHieu($MaThuongHieu){
        $thuongHieu = ThuongHieu::find($MaThuongHieu);
        $path_unlink = 'upload/ThuongHieu/'.$thuongHieu->HinhAnh;
        if (file_exists($path_unlink)){
            unlink($path_unlink);
        }
        $thuongHieu->delete();
        return Redirect::to('TrangLietKeThuongHieu')->with('status', 'Xóa thương hiệu sản phẩm thành công');
    }
}