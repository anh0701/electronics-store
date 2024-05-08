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
        $allDanhMucCha = DanhMuc::orderBy('MaDanhMuc', 'DESC')->where('DanhMucCha', 0)->get();
        return view('admin.SanPham.ThemSanPham')->with(compact('allThuongHieu', 'allDanhMuc', 'allDanhMucCha'));
    }

    public function TrangLietKeSanPham(){
        $allSanPham = SanPham::orderBy('MaSanPham', 'DESC')->orderBy('MaThuongHieu', 'DESC')->paginate(20);
        return view('admin.SanPham.LietKeSanPham')->with(compact('allSanPham'));
    }

    // public function ChonDanhMuc(Request $request){
    //     $data = $request->all();
    //     if($data['action']){
    //         $output = '';
    //         $output.='<option value="">'.'---Danh mục con---'.'</option>';
    //         $select_danhMucCon = DanhMuc::where('DanhMucCha', $data['ma_id'])->orderBy('MaDanhMuc', 'ASC')->get();
    //         foreach($select_danhMucCon as $key => $danhMucCon){
    //             $output.='<option value="'.$danhMucCon->MaDanhMuc.'">'.$danhMucCon->TenDanhMuc.'</option>';
    //         }
    //     }
    //     echo $output;
    // }

    public function ChonDanhMuc(Request $request){
        $data = $request->all();
        if($data['action']){
            $output = '';
            $select_danhMucCon = DanhMuc::where('DanhMucCha', $data['ma_id'])->orderBy('MaDanhMuc', 'DESC')->get();
                if($select_danhMucCon->isEmpty()){
                    $select_danhMucCha = DanhMuc::where('MaDanhMuc', $data['ma_id'])->get();
                    foreach($select_danhMucCha as $key => $danhMucCha){
                        $output.='<option value="'.$danhMucCha->MaDanhMuc.'">--- Không có danh mục con ---</option>';
                    }
                }elseif($select_danhMucCon->isNotEmpty()){
                    $output.='<option>--- Chọn danh mục con ---</option>';
                    foreach($select_danhMucCon as $key => $danhMucCon){
                        $output.='<option value="'.$danhMucCon->MaDanhMuc.'">'.$danhMucCon->TenDanhMuc.'</option>';
                    }
                }
        }
        echo $output;
    }

    public function ThemSanPham(Request $request){
        $data = $request->validate([
            'TenSanPham' => 'required|max:250',
            'SlugSanPham' => 'required',
            'MaThuongHieu' => 'required',
            'MoTa' => 'required',
            'DanhMucCha' => 'required',
            'DanhMucCon' => '',
            'TrangThai' => 'required',
            'GiaSanPham' => 'required',
            'HinhAnh' => 'required'
        ],
        [
            'TenSanPham.required' => 'Chưa điền tên sản phẩm',
            'TenSanPham.max' => 'Tên sản phẩm dài quá 250 ký tự',
            'SlugSanPham.required' => 'Chưa điền slug cho sản phẩm',
            'DanhMucCha.required' => 'Chưa điền Danh mục cho sản phẩm',
            'MaThuongHieu.required' => 'Chưa điền Thương hiệu cho sản phẩm',
            'MoTa.required' => 'Chưa điền Mô tả cho sản phẩm',
            'TrangThai.required' => 'Chưa điền Trạng thái cho sản phẩm',
            'GiaSanPham.required' => 'Chưa điền giá cho sản phẩm',
            'HinhAnh.required' => 'Chưa chọn hình ảnh cho sản phẩm',
        ]);
        // $data = $request->all();
        $sanPham = new SanPham();
        $sanPham->TenSanPham = $data['TenSanPham'];
        $sanPham->SlugSanPham = $data['SlugSanPham'];
        if($data['DanhMucCon'] == false){
            $data['DanhMucCon'] = $data['DanhMucCha'];
            $sanPham->MaDanhMuc = $data['DanhMucCon'];
        }else{
            $sanPham->MaDanhMuc = $data['DanhMucCon'];
        }
        $sanPham->MaThuongHieu = $data['MaThuongHieu'];
        $sanPham->GiaSanPham = $data['GiaSanPham'];
        $sanPham->MoTa = $data['MoTa'];
        $sanPham->TrangThai = $data['TrangThai'];
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
        return Redirect::to('TrangLietKeSanPham')->with('status', 'Thêm sản phẩm mới thành công');
    }

    public function TrangSuaSanPham($MaSanPham){
        $allThuongHieu = ThuongHieu::orderBy('MaThuongHieu', 'DESC')->get();
        $allDanhMuc = DanhMuc::orderBy('MaDanhMuc', 'DESC')->get();
        $sanPham = SanPham::where('MaSanPham' ,$MaSanPham)->get();
        return view('admin.SanPham.SuaSanPham', compact('sanPham', 'allThuongHieu', 'allDanhMuc')); 
    }

    public function SuaSanPham(Request $request, $MaSanPham){
        $data = $request->validate([
            'TenSanPham' => 'required|max:250',
            'SlugSanPham' => 'required',
            'MaThuongHieu' => 'required',
            'MoTa' => 'required',
            'DanhMucCha' => 'required',
            'DanhMucCon' => '',
            'TrangThai' => 'required',
            'GiaSanPham' => 'required',
        ],
        [
            'TenSanPham.required' => 'Chưa điền tên sản phẩm',
            'TenSanPham.max' => 'Tên sản phẩm dài quá 250 ký tự',
            'SlugSanPham.required' => 'Chưa điền slug cho sản phẩm',
            'DanhMucCha.required' => 'Chưa điền Danh mục cha sản phẩm',
            'DanhMucCon.required' => 'Chưa điền Danh mục con sản phẩm',
            'MaThuongHieu.required' => 'Chưa điền Thương hiệu cho sản phẩm',
            'MoTa.required' => 'Chưa điền Mô tả cho sản phẩm',
            'TrangThai.required' => 'Chưa điền Trạng thái cho sản phẩm',
            'GiaSanPham.required' => 'Chưa điền giá cho sản phẩm',
        ]);
        // $data = $request->all();
        $sanPham = SanPham::find($MaSanPham);
        $sanPham->TenSanPham = $data['TenSanPham'];
        $sanPham->SlugSanPham = $data['SlugSanPham'];
        if($data['DanhMucCon'] == false){
            $data['DanhMucCon'] = $data['DanhMucCha'];
            $sanPham->MaDanhMuc = $data['DanhMucCon'];
        }else{
            $sanPham->MaDanhMuc = $data['DanhMucCon'];
        }
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

    public function KoKichHoatSanPham($MaSanPham){
        $sanPham = SanPham::find($MaSanPham);
        $sanPham->update(['TranThai'=>0]);
        return Redirect::to('TrangLietKeSanPham')->with('status', 'Không kích hoạt sản phẩm thành công');
    }

    public function KichHoatSanPham($MaSanPham){
        $sanPham = SanPham::find($MaSanPham);
        $sanPham->update(['TrangThai'=>1]);
        return Redirect::to('TrangLietKeSanPham')->with('status', 'Kích hoạt sản phẩm thành công');
    }
}
