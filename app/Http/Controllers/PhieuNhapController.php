<?php

namespace App\Http\Controllers;

use App\Models\ChiTietPhieuNhap;
use App\Models\NhaCungCap;
use Exception;
use Session;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use App\Models\PhieuNhap;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PhieuNhapController extends Controller
{
    public function trangXemPhieuNhap(){
        session::forget('matHangList');     
        $pns = DB::select("SELECT pn.*, tk.TenTaiKhoan
                  FROM tbl_phieunhap pn
                  JOIN tbl_taikhoan tk ON pn.MaTaiKhoan = tk.MaTaiKhoan");

        return view('admin.PhieuNhap.xemPhieuNhap', ['data' => $pns]);
    } 

    public function xemCTPN($id){
        $pn = DB::select("SELECT * FROM tbl_phieunhap WHERE MaPhieuNhap = '{$id}'");
        $ctpn = DB::select("SELECT * FROM tbl_chitietphieunhap WHERE MaPhieuNhap = '{$id}'");
        // $maNCC = $pn[0]->MaNhaCungCap;
        // $tenNCC = DB::select("SELECT TenNhaCungCap FROM tbl_nhacungcap WHERE MaNhaCungCap = '{$maNCC}'");
        // $maTK = $pn[0]->MaTaiKhoan;
        // $tenTK = DB::select("SELECT TenTaiKhoan FROM tbl_taikhoan WHERE MaTaiKhoan = '{$maTK}'");
        return view('admin.PhieuNhap.xemcT', ['pn' => $pn[0], 'ctpn' => $ctpn]);
    }


    public function lapPN(){
        $matHangList = session('matHangList', []);
        $user = session(('user'));
        $tenTK = $user['TenTaiKhoan'];
        $tongTien = 0;
        $listNCC = DB::select("SELECT MaNhaCungCap, TenNhaCungCap FROM tbl_nhacungcap");

        
        foreach ($matHangList as $mh){
            $tongTien += $mh['thanhTien'];
        }

        return view('admin.PhieuNhap.lapPN', ['matHangList' => $matHangList, 'tongTien' => $tongTien, 'nguoiLap' => $tenTK, 'listNCC' => $listNCC]);
    }
    
    public function xuLyThemMatHang(Request $request)
    {
        $messages = [
            'maHang.required' => 'Vui lòng nhập ma hang',
            'soLuong.required' => 'Vui lòng nhập so luong',
            'donGia.required' => 'Vui lòng nhập don gia',
        ];
        $valid = $request->validate([
            'maHang' => 'required',
            'soLuong' => 'required',
            'donGia' => 'required',
        ], $messages);

        if(!$valid){
            return redirect()->back()->withInput();
        }
        
        // Lấy thông tin từ request
        $maHang = $request->input('maHang');
        $soLuong = $request->input('soLuong');
        $donGia = $request->input('donGia');
        $thanhTien = $soLuong * $donGia;
    
        // Tạo một mảng mặt hàng mới
        $newMatHang = [
            'maHang' => $maHang,
            'soLuong' => $soLuong,
            'donGia' => $donGia,
            'thanhTien' => $thanhTien,
        ];
    
        // Lấy danh sách mặt hàng từ session hoặc khởi tạo một danh sách mới nếu không tồn tại
        $matHangList = session('matHangList', []);
    
        // Thêm mặt hàng mới vào danh sách mặt hàng
        $matHangList[] = $newMatHang;
    
        // Lưu danh sách mặt hàng vào session
        session(['matHangList' => $matHangList]);
        
        // Chuyển hướng về trang tạo mới phiếu nhập
        return redirect('/lap-phieu-nhap')->withInput();
    }
    public function xoaMatHang($index)
    {
        $matHangList = session('matHangList', []);
        unset($matHangList[$index]);
        session(['matHangList' => $matHangList]);

        return redirect()->back()->withInput();
    }

    public function xuLyPN(Request $request)
    {
        $messages = [
            'nguoiLap.required' => 'Vui lòng nhập Nguoi Lap.',
            'maNCC.required' => 'Vui lòng nhập ma nha cung cap.',
        ];
        $valid = $request->validate([
            'nguoiLap' => 'required',
            'maNCC' => 'required',
        ], $messages);

        if (!$valid) {
            return redirect()->back()->withInput();
        }
        
        $maPN = 'PN' . date('YmdHis');
        $thoiGianTao = date('Y-m-d H:i:s');
        $tongTien = $request->tongTien;
        $tienTra = $request->soTienTra;
        if($tienTra > $tongTien){
            return redirect()->back()->withInput()->withErrors(['tienTra' => 'Ban nhap sai so tien tra']);
        }
        if($tongTien != "" && $tienTra != ""){
            $soTienNo = $request->tongTien - $request->soTienTra;
        }else{
            $soTienNo = 0;
        }

        $matHangList = session('matHangList', []);
        $dem = count($matHangList);
        if ($dem <= 0) {
            return redirect()->back()->withInput()->withErrors(['matHang' => 'Ban chua them mat hang']);
        }

        $tenTK = $request->nguoiLap;
        $maTK = DB::select("SELECT * FROM tbl_taikhoan WHERE TenTaiKhoan = '{$tenTK}'");
        
        $phieunhap = new PhieuNhap();
        $phieunhap->MaPhieuNhap = $maPN;
        $phieunhap->MaNhaCungCap = $request->maNCC;
        $phieunhap->MaTaiKhoan = $maTK[0]->MaTaiKhoan;
        $phieunhap->TongTien = $tongTien;
        $phieunhap->TienTra = $tienTra;
        $phieunhap->TienNo = $soTienNo;
        $phieunhap->PhuongThucThanhToan = $request->pttt;
        $phieunhap->ThoiGianTao = $thoiGianTao;
        // try{
            $phieunhap->save();  
                  
        // }catch(Exception $e){
        //     return redirect('/lap-phieu-nhap')->withInput()->withErrors(['error' => $e->getMessage()]);
        // }
        

        
        foreach ($matHangList as $mh){
            $maCTPN = 'CTPN' . uniqid();
            $ctpn = new ChiTietPhieuNhap();
            $ctpn->MaCTPN = $maCTPN;
            $ctpn->MaPhieuNhap = $maPN;
            $ctpn->MaSanPham = $mh['maHang'];
            $ctpn->SoLuong = $mh['soLuong'];
            $ctpn->GiaSanPham = $mh['donGia'];
            
            try{
                $ctpn->save();      
            }catch(Exception $e){
                return redirect('/lap-phieu-nhap')->withInput()->withErrors(['maHang' => 'Ma san pham khong ton tai']);
            }
        }
        
        
        
        $request->session()->forget('matHangList');
        return redirect('/liet-ke-phieu-nhap')->with('success', 'Phieu nhap đã được tạo thành công!');
    }

    public function suaPN($id){
        $pn = DB::select("SELECT * FROM test1 WHERE test1.maPN = '{$id}' LIMIT 1");
        return view('admin.PhieuNhap.suaPN', ['data' => $pn]);
    }

    public function xuLySua(Request $request){
        $maPN = $request->input('maPN');
        $nguoiLap = $request->input('nguoiLap');
        $maNCC = $request->input('maNCC');
        $tongTien = $request->input('tongTien');
        $soTienTra = $request->input('soTienTra');
        $soTienNo = $request->input('tongTien') - $request->input('soTienTra');

        // Cập nhật dữ liệu vào cơ sở dữ liệu
        PhieuNhap::where('maPN', $maPN)->update([
            'nguoiLap' => $nguoiLap,
            'maNCC' => $maNCC,
            'tongTien' => $tongTien,
            'soTienTra' => $soTienTra,
            'soTienNo' => $soTienNo,
        ]);
        return redirect()->route('xem.CT', ['id' => $maPN]);
    }


}
