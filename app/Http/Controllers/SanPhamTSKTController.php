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
        $sanPhamSession = Session::get('sanPham');
        if($sanPhamSession){
            Session::forget('sanPham');
            return Redirect()->back()->with('message', 'Xóa toàn bộ sản phẩm trong Session'); 
        }else{
            return Redirect()->back()->with('message', 'Giỏ hàng đang trống'); 
        }
    }

    public function ThemSanPhamSession(Request $request){
        $data = $request->all();
        $session_id = substr(md5(microtime()), rand(0, 26), 5);
        $sanPham = Session::get('sanPham');
        if($sanPham == true){
            $is_avaiable = 0;
            foreach($sanPham as $key => $value){
                if($value['MaSanPham'] == $data['cart_product_id']){
                    $is_avaiable++;
                }
            }
            if($is_avaiable == 0){
                $sanPham[] = array(
                    'session_id' => $session_id,
                    'MaSanPham' => $data['cart_product_id'],
                    'TenSanPham' => $data['cart_product_name'],
                );
                Session::put('sanPham', $sanPham);
            }
        }else{
            $sanPham[] = array(
                'session_id' => $session_id,
                'MaSanPham' => $data['cart_product_id'],
                'TenSanPham' => $data['cart_product_name'],
            );
        }
        Session::put('sanPham', $sanPham);
        Session::save();
    }

    public function XoaSanPhamSession($session_id){
        $sanPhamSession = Session::get('sanPham');
        if($sanPhamSession == true){
            foreach($sanPhamSession as $key => $value){
                if($value['session_id'] == $session_id){
                    unset($sanPhamSession[$key]);
                }
            }
            Session::put('sanPham', $sanPhamSession);
            return Redirect()->back()->with('message', 'Xóa sản phẩm khỏi thành công');
        }else{
            return Redirect()->back()->with('message', 'Xóa sản phẩm khỏi thất bại');
        }
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
            // }elseif($data['action'] == "DanhMucCon"){
            //     $select_sanPham = SanPham::where('MaDanhMuc', $data['ma_id'])->orderBy('MaSanPham', 'DESC')->get();
            //     $output.=
            //     '<thead>
            //         <tr>
            //             <th>STT</th>
            //             <th>Tên sản phẩm</th>
            //             <th>Tên thương hiệu</th>
            //             <th style="width:100px;">Quản lý</th>
            //         </tr>
            //     </thead>
            //     <tbody>';
            //     foreach($select_sanPham as $key => $sanPham){
            //         $count = $key+1;
            //         $output.=
            //         '
            //             <tr>
            //                 <td>'.$count.'</td>
            //                 <td>'.$sanPham->TenSanPham.'</td>
            //                 <td>'.$sanPham->ThuongHieu->TenThuongHieu.'</td>
            //                 <td>
            //                 </td>
            //             </tr>
            //         ';
            //     }
            }
        }
        echo $output;
    }
}
