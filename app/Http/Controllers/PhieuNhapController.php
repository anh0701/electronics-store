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

    public function suaPN($id){
        $pn = DB::select("SELECT * FROM tbl_phieunhap WHERE MaPhieuNhap = '{$id}'");
        $ctpn = DB::select("SELECT * FROM tbl_chitietphieunhap WHERE MaPhieuNhap = '{$id}'");

        return view('admin.PhieuNhap.suaPN', ['pn' => $pn[0], 'ctpn' => $ctpn]);
    }


    public function lapPN(){
        $user = session(('user'));
        $tenTK = $user['TenTaiKhoan'];
        $listNCC = DB::select("SELECT MaNhaCungCap, TenNhaCungCap FROM tbl_nhacungcap");
        return view('admin.PhieuNhap.themPN', ['nguoiLap' => $tenTK, 'listNCC' => $listNCC]);
    }
    
    
    public function timKiemSP(Request $request){
        $tk = $request->tkSP;
        $listSP = DB::select("SELECT * FROM tbl_sanpham WHERE TenSanPham LIKE '%$tk%' LIMIT 20");
        Session::put('listSP', $listSP);
        return redirect('/lap-phieu-nhap-chi-tiet');
    }

    public function lapPNCT(){
        $pn = Session::get('pn');
        $maPN = $pn[0];
        $listPNCT = DB::select("SELECT * FROM tbl_chitietphieunhap WHERE MaPhieuNhap = '{$maPN}'");
        return view('admin.PhieuNhap.themPNCT', ['listPNCT' => $listPNCT]);
    }

    public function xuLyLapPNCT(Request $request){
        $messages = [
            'maSP.required' => 'Vui lòng nhập ma nha cung cap.',
            'soLuong.required' => 'vui lòng nhập số lượng',
            'gia.required' => 'Vui lòng nhập giá nhập',
        ];
        $valid = $request->validate([
            'maSP' => 'required',
            'soLuong' => 'required',
            'gia' => 'required',
        ], $messages);

        $pn = Session::get('pn');
        $maPN = $pn[0];
        $maCTPN = 'CTPN' . uniqid();
        $ctpn = new ChiTietPhieuNhap();
        $ctpn->MaCTPN = $maCTPN;
        $ctpn->MaPhieuNhap = $maPN;
        $ctpn->MaSanPham = $request->maSP;
        $ctpn->SoLuong = $request->soLuong;
        $ctpn->GiaSanPham = $request->gia;      
        $ctpn->save();
        $tongTien = Session::get('tongTien');
        $tt = $ctpn->SoLuong * $ctpn->GiaSanPham;
        $tongTien += $tt;
        Session::put('tongTien', $tongTien);
        return redirect('/lap-phieu-nhap-chi-tiet');

    }

    public function luuPN(){
        Session::forget('listSP');
        $pn = Session::pull('pn');
        $maPN = $pn[0];
        $tongTien = Session::pull('tongTien');
        PhieuNhap::where('MaPhieuNhap', $maPN)->update([
            'TongTien' => $tongTien,
        ]);

        return redirect('/liet-ke-phieu-nhap');
        
    }

    public function xuLyPN(Request $request)
    {
        $messages = [
            'maNCC.required' => 'Vui lòng nhập ma nha cung cap.',
        ];
        $valid = $request->validate([
            'maNCC' => 'required',
        ], $messages);

        if (!$valid) {
            return redirect()->back()->withInput();
        }
        
        $maPN = 'PN' . date('YmdHis');
        $thoiGianTao = date('Y-m-d H:i:s');
        // $tongTien = $request->tongTien;
        // $tienTra = $request->soTienTra;
        // if($tienTra > $tongTien){
        //     return redirect()->back()->withInput()->withErrors(['tienTra' => 'Ban nhap sai so tien tra']);
        // }
        // if($tongTien != "" && $tienTra != ""){
        //     $soTienNo = $request->tongTien - $request->soTienTra;
        // }else{
        //     $soTienNo = 0;
        // }

        // $matHangList = session('matHangList', []);

        $tenTK = $request->nguoiLap;
        $maTK = DB::select("SELECT * FROM tbl_taikhoan WHERE TenTaiKhoan = '{$tenTK}'");
        $arr = preg_split("/\//", $request->maNCC);
        $maNCC = $arr[0];
        $tenNCC = $arr[1];

        $phieunhap = new PhieuNhap();
        $phieunhap->MaPhieuNhap = $maPN;
        $phieunhap->MaNhaCungCap = $maNCC;
        $phieunhap->MaTaiKhoan = $maTK[0]->MaTaiKhoan;
        $phieunhap->PhuongThucThanhToan = $request->pttt;
        $phieunhap->TongTien = $request->tongTien;
        $phieunhap->ThoiGianTao = $thoiGianTao;
        $phieunhap->save();  

        if($request->thanhToan == 0){
            $tt = 'Chuyển khoản';
        }elseif($request->thanhToan == 1){
            $tt = 'Tiền mặt';
        }elseif($request->thanhToan == 2){
            $tt = 'Khác';
        }
        Session::put('pn', [$maPN, $tenTK, $tenNCC, $tt]);
        Session::put('tongTien', $request->tongTien);
        return redirect('/lap-phieu-nhap-chi-tiet');
    }
      
        
        

    

    public function xuLySuaPN(Request $request){
        $tongTien = 0;
        foreach($request->maCTPN as $key => $maCTPN){
            $soluong = $request->soluong[$key];
            $dongia = $request->dongia[$key];
            $thanhTien = $soluong * $dongia;
            $tongTien += $thanhTien;
            ChiTietPhieuNhap::where('MaCTPN', $maCTPN)->update([
                'SoLuong' => $soluong,
                'GiaSanPham' => $dongia,

            ]);  
        }
        $trangThai = $request->trangThai;
        $tienTra = $request->tongTien - $request->tienNo;
        $tienTraMoi = $tienTra + $request->tienTra;
        $tienNo = $tongTien - $tienTraMoi;
        $thoiGianSua = date('Y-m-d H:i:s');
        PhieuNhap::where('MaPhieuNhap', $request->maPN)->update([
            'TongTien' => $tongTien,
            'TienTra' => $tienTraMoi,
            'TienNo' => $tienNo,
            'ThoiGianSua' => $thoiGianSua,
            'TrangThai' => $trangThai,
        ]);

        if($trangThai == "DAXACNHAN"){
            foreach($request->maCTPN as $key => $maCTPN){
                $soluong = $request->soluong[$key];
                $chiTietPhieuNhap = ChiTietPhieuNhap::where('MaCTPN', $maCTPN)->first();
                if($chiTietPhieuNhap){
                    $sanpham = $chiTietPhieuNhap->SanPham;
                    if($sanpham){
                        $sanpham->SoLuongTrongKho += $soluong;
                        $sanpham->save();
                    }
                }
            }
        }
        return redirect()->route('xemCTPN', ['id' => $request->maPN]);
        // return redirect('/liet-ke-phieu-nhap');
    }

    public function xoaPN($id){
        DB::delete("DELETE FROM tbl_chitietphieunhap WHERE MaPhieuNhap = '{$id}'");
        DB::delete("DELETE FROM tbl_phieunhap WHERE MaPhieuNhap = '{$id}'");
        return redirect('/liet-ke-phieu-nhap');
    }
}
