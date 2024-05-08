<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\SanPham;
use App\Models\DanhMuc;
use App\Models\ThongSoKyThuat;
use App\Models\DanhMucTSKT;
use App\Models\SanPhamTSKT;
use Illuminate\Support\Facades\Redirect;

class SanPhamTSKTController extends Controller
{
    public function TrangThemSanPhamTSKT(){
        $danhMucTSKT = DanhMucTSKT::orderBy('MaDMTSKT', 'DESC')->get();
        $thongSoKyThuat = ThongSoKyThuat::orderBy('MaTSKT', 'DESC')->get();
        $allDanhMuc = DanhMuc::orderBy('MaDanhMuc', 'DESC')->get();
        $allSanPham = SanPham::orderBy('MaSanPham', 'DESC')->get();
        return view('admin.ThongSoKyThuat.SanPhamTSKT.ThemSanPhanTSKT')
        ->with(compact('thongSoKyThuat', 'allDanhMuc', 'danhMucTSKT', 'allSanPham'));
    }

    public function TrangLietKeSanPhamTSKT(){
        
    }

    public function ChangeTable(Request $request){
        $data = $request->all();
        if($data['action']){
            $output = '';
            if($data['action'] == "DanhMucCha"){
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
            }elseif($data['action'] == "DanhMucCon"){
                $select_sanPham = SanPham::where('MaDanhMuc', $data['ma_id'])->orderBy('MaSanPham', 'DESC')->get();
                // foreach($select_sanPham as $key => $sanPham){
                //     $output.='<option value="'.$sanPham->MaSanPham.'">'.$sanPham->TenSanPham.'</option>';
                // }
                $output.=
                '
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Tên thương hiệu</th>
                        <th style="width:100px;">Quản lý</th>
                    </tr>
                </thead>
                ';
                foreach ($select_sanPham as $key => $sanPham){
                    $count = $key+1;
                    $route = '';
                    $output.=
                    '
                        <tr>
                            <td>'.$count.'</td>
                            <td>'.$sanPham->TenSanPham.'</td>
                            <td>'.$sanPham->ThuongHieu->TenThuongHieu.'</td>
                            <td>
                                <a href="{{ route('.$route.') }}" type="button" class="btn btn-default add-to-cart">
                                Thêm thông số kỹ thuật
                                </a>
                            </td>
                        </tr>
                    ';
                }  
                $output.='</tbody>';
            }
        }
        echo $output;
    }
}
