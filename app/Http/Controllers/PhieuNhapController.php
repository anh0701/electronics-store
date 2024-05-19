<?php

namespace App\Http\Controllers;

use App\Models\ChiTietPhieuNhap;
use App\Models\NhaCungCap;
use App\Models\SanPham;
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
        $pns = DB::table('tbl_phieunhap')
                ->join('tbl_taikhoan', 'tbl_phieunhap.MaTaiKhoan', '=', 'tbl_taikhoan.MaTaiKhoan')
                ->join('tbl_nhacungcap', 'tbl_phieunhap.MaNhaCungCap', '=', 'tbl_nhacungcap.MaNhaCungCap')
                ->select('tbl_phieunhap.*', 'tbl_taikhoan.TenTaiKhoan', 'tbl_nhacungcap.TenNhaCungCap')
                ->orderByDesc('tbl_phieunhap.ThoiGianTao')
                ->paginate(5);

        return view('admin.PhieuNhap.xemPhieuNhap', ['data' => $pns]);
    } 

    public function xemCTPN($id){
        $pn = DB::select("SELECT pn.*, tk.TenTaiKhoan, ncc.TenNhaCungCap
                        FROM tbl_phieunhap pn 
                        JOIN tbl_taikhoan tk ON pn.MaTaiKhoan = tk.MaTaiKhoan
                        JOIN tbl_nhacungcap ncc ON pn.MaNhaCungCap = ncc.MaNhaCungCap
                        WHERE MaPhieuNhap = '{$id}'");
        $ctpn = DB::select("SELECT ct.*, sp.TenSanPham
                        FROM tbl_chitietphieunhap ct
                        JOIN tbl_sanpham sp ON ct.MaSanPham = sp.MaSanPham
                        WHERE MaPhieuNhap = '{$id}'");
        return view('admin.PhieuNhap.xemcT', ['pn' => $pn[0], 'ctpn' => $ctpn]);
    }

    public function suaPN($id){
        $pn = DB::select("SELECT * FROM tbl_phieunhap WHERE MaPhieuNhap = '{$id}'");
        $ctpn = DB::select("SELECT ct.*, sp.TenSanPham
                        FROM tbl_chitietphieunhap ct
                        JOIN tbl_sanpham sp ON ct.MaSanPham = sp.MaSanPham
                        WHERE MaPhieuNhap = '{$id}'");

        return view('admin.PhieuNhap.test1', ['pn' => $pn[0], 'ctpn' => $ctpn]);
    }

    public function suaPNCT($id){
        Session::put('maPN', $id);
        $ctpn = DB::select("SELECT ct.*, sp.TenSanPham
                        FROM tbl_chitietphieunhap ct
                        JOIN tbl_sanpham sp ON ct.MaSanPham = sp.MaSanPham
                        WHERE MaPhieuNhap = '{$id}'");

        return view('admin.PhieuNhap.suaPNCT', ['ctpn' => $ctpn]);
    }

    public function lapPN(){
        $user = session(('user'));
        $tenTK = $user['TenTaiKhoan'];
        $listNCC = DB::select("SELECT MaNhaCungCap, TenNhaCungCap FROM tbl_nhacungcap");
        return view('admin.PhieuNhap.themPN', ['nguoiLap' => $tenTK, 'listNCC' => $listNCC]);
    }
    
    public function lapPNCT(){
        $pn = Session::get('pn');
        $maPN = $pn[0];
        $listPNCT = DB::select("SELECT ct.*, sp.TenSanPham
                    FROM tbl_chitietphieunhap ct
                    JOIN tbl_sanpham sp ON ct.MaSanPham = sp.MaSanPham
                    WHERE MaPhieuNhap = '{$maPN}'");
        return view('admin.PhieuNhap.themPNCT', ['listPNCT' => $listPNCT]);
    }

    
    public function timKiemSP(Request $request){
        $tk = $request->tkSP;
        $listSP = DB::select("SELECT * FROM tbl_sanpham WHERE TenSanPham LIKE '%$tk%' LIMIT 20");
        Session::put('listSP', $listSP);
        if(is_null(Session::get('pn'))){
            $maPN = Session::get('maPN');
            return redirect()->route('suaPNCT', ['id' => $maPN]);
        }else{
            return redirect('/lap-phieu-nhap-chi-tiet');
        }
        
    }

    

    public function xuLyLapPNCT(Request $request){
        $messages = [
            'soLuong.required' => 'vui lòng nhập số lượng',
            'gia.required' => 'Vui lòng nhập giá nhập',
        ];
        $valid = $request->validate([
            'soLuong' => 'required',
            'gia' => 'required',
        ], $messages);

        if(is_null(Session::get('pn'))){
            $maPN = Session::get('maPN');
            $page = 2;
        }else{
            $pn = Session::get('pn');
            $maPN = $pn[0];
            $page = 1;
        }
        $maCTPN = 'CTPN' . uniqid();
        $ctpn = new ChiTietPhieuNhap();
        $ctpn->MaCTPN = $maCTPN;
        $ctpn->MaPhieuNhap = $maPN;
        $ctpn->MaSanPham = $request->maSP;
        $ctpn->SoLuong = $request->soLuong;
        $ctpn->GiaSanPham = $request->gia;      
        $ctpn->save();

        if($page == 2){
            return redirect()->route('suaPNCT', ['id'=>$maPN]);
        }else{
            return redirect('/lap-phieu-nhap-chi-tiet');
        }
    }

    public function xoaCTPN($id){
        DB::delete("DELETE FROM tbl_chitietphieunhap WHERE MaCTPN = '{$id}'");
        if(is_null(Session::get('maPN'))){
            return redirect('/lap-phieu-nhap-chi-tiet');   
        }else{
            return redirect()->route('suaPNCT', ['id' => Session::get('maPN')]);
        }  
    }

    public function luuPN(){
        Session::forget('listSP');
        $pn = Session::pull('pn');
        $maPN = $pn[0];
        // $tongTien = Session::pull('tongTien');
        $tongTien = 0;
        $ctpn = DB::select("SELECT * FROM tbl_chitietphieunhap WHERE MaPhieuNhap = '{$maPN}'");
        foreach ($ctpn as $ct){
            $tongTien += $ct->SoLuong * $ct->GiaSanPham;
        }
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
        
        $tienTra = 0;
        $tienNo = $request->tongTien - $tienTra;
        $tenTK = $request->nguoiLap;
        $maTK = DB::select("SELECT * FROM tbl_taikhoan WHERE TenTaiKhoan = '{$tenTK}'");
        $arr = preg_split("/\//", $request->maNCC);
        $maNCC = $arr[0];
        $tenNCC = $arr[1];
        

        $phieunhap = new PhieuNhap();
        $phieunhap->MaPhieuNhap = $maPN;
        $phieunhap->MaNhaCungCap = $maNCC;
        $phieunhap->MaTaiKhoan = $maTK[0]->MaTaiKhoan;
        $phieunhap->PhuongThucThanhToan = $request->thanhToan;
        $phieunhap->TongTien = $request->tongTien;
        $phieunhap->TienTra = $tienTra;
        $phieunhap->TienNo = $tienNo;
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
        return redirect('/lap-phieu-nhap-chi-tiet');
    }
      
    public function suaCT($id){
        $ct = DB::select("SELECT ct.*, sp.TenSanPham
        FROM tbl_chitietphieunhap ct
        JOIN tbl_sanpham sp ON ct.MaSanPham = sp.MaSanPham
        WHERE MaCTPN = '{$id}'");

        return view('admin.PhieuNhap.suaCT', ['ct' => $ct]);
    }

    public function suaCT2(Request $request){
        $maPN = $request->maPN;
        $maCT = $request->maCT;
        $sl = $request->soLuong;
        $gia = $request->gia;
        ChiTietPhieuNhap::where('MaCTPN', $maCT)->update([
            'SoLuong' => $sl,
            'GiaSanPham' => $gia,
        ]);
        return redirect()->route('suaPNCT', ['id' => $maPN]);
    }
        
    public function xuLySuaPN(Request $request){
        
        $maPN = $request->maPN;
        $ctpn = DB::select("SELECT * FROM tbl_chitietphieunhap WHERE MaPhieuNhap = '{$maPN}'");
        $tongTien = 0;

        foreach ($ctpn as $ct){
            $tongTien += $ct->SoLuong * $ct->GiaSanPham;
        }
        
        $tienTraMoi = $request->tienTra + $request->tienTraMoi;
        if($tienTraMoi > $tongTien){
            return redirect()->back()->withInput()->withErrors(['tienTra' => 'Bạn nhập sai rồi']);
        }
        $tienNo = $tongTien - $tienTraMoi;
        $thoiGianSua = date('Y-m-d H:i:s');
        
        
        PhieuNhap::where('MaPhieuNhap', $maPN)->update([
            'TongTien' => $tongTien,
            'TienTra' => $tienTraMoi,
            'TienNo' => $tienNo,
            'PhuongThucThanhToan' => $request->thanhToan,
            'TrangThai' => $request->trangThai,
            'ThoiGianSua' => $thoiGianSua,
        ]);

        $trangThai1 = $request->trangThaiTruoc;
        $trangThai2 = $request->trangThai;
        if($trangThai2 == 1 && ($trangThai1 != $trangThai2)){
            foreach($ctpn as $ct){
                $maSP = $ct->MaSanPham;
                $soLuong = $ct->SoLuong;
                $sltk = DB::select("SELECT SoLuongTrongKho FROM tbl_sanpham WHERE MaSanPham = '{$maSP}'");
                $sl = $sltk[0]->SoLuongTrongKho + $soLuong;
                SanPham::where('MaSanPham', $maSP)->update(['SoLuongTrongKho' => $sl]);
            }
        }elseif($trangThai2 == 0 && ($trangThai1 != $trangThai2)){
            foreach($ctpn as $ct){
                $maSP = $ct->MaSanPham;
                $soLuong = $ct->SoLuong;
                $sltk = DB::select("SELECT SoLuongTrongKho FROM tbl_sanpham WHERE MaSanPham = '{$maSP}'");
                $sl = $sltk[0]->SoLuongTrongKho - $soLuong;
                SanPham::where('MaSanPham', $maSP)->update(['SoLuongTrongKho' => $sl]);
            }
        }
        return redirect()->route('xemCTPN', ['id' => $maPN]);

    }

    public function xoaPN($id){
        DB::delete("DELETE FROM tbl_chitietphieunhap WHERE MaPhieuNhap = '{$id}'");
        DB::delete("DELETE FROM tbl_phieunhap WHERE MaPhieuNhap = '{$id}'");
        return redirect('/liet-ke-phieu-nhap');
    }
}
