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
        Session::forget('maPN');
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

        return view('admin.PhieuNhap.suaPN', ['pn' => $pn[0], 'ctpn' => $ctpn]);
    }

    public function suaPNCT($id){
        $ctpn = DB::select("SELECT ct.*, sp.TenSanPham
                        FROM tbl_chitietphieunhap ct
                        JOIN tbl_sanpham sp ON ct.MaSanPham = sp.MaSanPham
                        WHERE MaPhieuNhap = '{$id}'");
        $products = SanPham::all();
        $maPN = $id;
        return view('admin.PhieuNhap.suaPNCT', ['ctpn' => $ctpn, 'maPN' => $maPN], compact('products'));
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
        $products = SanPham::all();
        return view('admin.PhieuNhap.themPNCT', ['listPNCT' => $listPNCT], compact('products'));
    }

    public function danhSachSanPham(Request $request)
    {
        $search = $request->input('q');
        $ids = $request->input('ids');

        if ($ids) {
            $products = SanPham::whereIn('MaSanPham', $ids)->get(['MaSanPham as id', 'TenSanPham as text']);
            return response()->json($products);
        }

        $products = SanPham::where('TenSanPham', 'LIKE', "%{$search}%")
            ->get(['MaSanPham as id', 'TenSanPham as text']);

        return response()->json($products);
    }
    

    public function xuLyLapPNCT(Request $request){
        $messages = [
            'maSP.required' => 'vui lòng chọn sản phẩm',
            'soLuong.required' => 'vui lòng nhập số lượng',
            'gia.required' => 'Vui lòng nhập giá nhập',
        ];
        $valid = $request->validate([
            'maSP' => 'required',
            'soLuong' => 'required',
            'gia' => 'required',
        ], $messages);

        if($request->maPNSua != null){
            $maPN = $request->maPNSua;
        }else{
            $pn = Session::get('pn');
            $maPN = $pn[0];
        }
        $maCTPN = 'CTPN' . uniqid();
        $ctpn = new ChiTietPhieuNhap();
        $ctpn->MaCTPN = $maCTPN;
        $ctpn->MaPhieuNhap = $maPN;
        $ctpn->MaSanPham = $request->maSP;
        $ctpn->SoLuong = $request->soLuong;
        $ctpn->GiaSanPham = $request->gia;      
        $ctpn->save();

        if(is_null(Session::get('pn'))){
            return redirect()->route('suaPN', ['id'=>$maPN]);
        }else{
            return redirect('/lap-phieu-nhap-chi-tiet');
        }
    }

    public function xoaCTPN($id){
        $maPN = DB::select("SELECT MaPhieuNhap FROM tbl_chitietphieunhap WHERE MaCTPN = '$id'");
        DB::delete("DELETE FROM tbl_chitietphieunhap WHERE MaCTPN = '{$id}'");
        if(is_null(Session::get('pn'))){
            return redirect()->route('suaPN', ['id' => $maPN[0]->MaPhieuNhap]);
        }else{         
            return redirect('/lap-phieu-nhap-chi-tiet');   
        }  
    }

    public function luuPN(){
        $pn = Session::pull('pn');
        $maPN = $pn[0];

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
            'maNCC.required' => 'Vui lòng nhập mã nhà cung cấp.',
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
        $trangThai = 0;
        

        $phieunhap = new PhieuNhap();
        $phieunhap->MaPhieuNhap = $maPN;
        $phieunhap->MaNhaCungCap = $maNCC;
        $phieunhap->MaTaiKhoan = $maTK[0]->MaTaiKhoan;
        $phieunhap->PhuongThucThanhToan = $request->thanhToan;
        $phieunhap->TongTien = $request->tongTien;
        $phieunhap->TienTra = $tienTra;
        $phieunhap->TienNo = $tienNo;
        $phieunhap->TrangThai = $trangThai;
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
        $messages = [
            'soLuong.required' => 'vui lòng nhập số lượng',
            'gia.required' => 'Vui lòng nhập giá nhập',
        ];
        $valid = $request->validate([
            'soLuong' => 'required',
            'gia' => 'required',
        ], $messages);
        $maPN = $request->maPN;
        $maCT = $request->maCT;
        $sl = $request->soLuong;
        $gia = $request->gia;
        ChiTietPhieuNhap::where('MaCTPN', $maCT)->update([
            'SoLuong' => $sl,
            'GiaSanPham' => $gia,
        ]);
        return redirect()->route('suaPN', ['id' => $maPN]);
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
