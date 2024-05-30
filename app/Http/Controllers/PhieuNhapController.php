<?php

namespace App\Http\Controllers;

use App\Models\ChiTietPhieuNhap;
use App\Models\NhaCungCap;
use App\Models\PhieuXuat;
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

        return view('admin.PhieuNhap.lietKePN', ['data' => $pns]);
    } 

    public function timKiemPN(Request $request){
        $data = PhieuNhap::join('tbl_taikhoan', 'tbl_phieunhap.MaTaiKhoan', '=', 'tbl_taikhoan.MaTaiKhoan')
            ->join('tbl_nhacungcap', 'tbl_phieunhap.MaNhaCungCap', '=', 'tbl_nhacungcap.MaNhaCungCap')
            ->select('tbl_phieunhap.*', 'tbl_taikhoan.TenTaiKhoan', 'tbl_nhacungcap.TenNhaCungCap')
            ->where(function($query) use ($request) {
                $query->where('tbl_taikhoan.TenTaiKhoan', 'LIKE', "%{$request->timKiem}%")
                    ->orWhere('tbl_nhacungcap.TenNhaCungCap', 'LIKE', "%{$request->timKiem}%")
                    ->orWhere('tbl_phieunhap.ThoiGianTao', 'LIKE', "%{$request->timKiem}%");
            })
            ->paginate(5);
        return view('admin.PhieuNhap.lietKePN', compact('data'));
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
        $pn = DB::select("SELECT pn.*, tk.TenTaiKhoan, ncc.TenNhaCungCap
                        FROM tbl_phieunhap pn 
                        JOIN tbl_taikhoan tk ON pn.MaTaiKhoan = tk.MaTaiKhoan
                        JOIN tbl_nhacungcap ncc ON pn.MaNhaCungCap = ncc.MaNhaCungCap
                        WHERE MaPhieuNhap = '{$id}'");
        $products = SanPham::all();
        $ctpn = DB::select("SELECT ct.*, sp.TenSanPham
                        FROM tbl_chitietphieunhap ct
                        JOIN tbl_sanpham sp ON ct.MaSanPham = sp.MaSanPham
                        WHERE MaPhieuNhap = '{$id}'");

        return view('admin.PhieuNhap.suaPN', ['pn' => $pn[0], 'ctpn' => $ctpn], compact('products'));
    }

    public function lapPN(){
        $maPN = 'PN' . date('YmdHis');
        $listNCC = DB::select("SELECT MaNhaCungCap, TenNhaCungCap FROM tbl_nhacungcap WHERE TrangThai = 1");
        $products = SanPham::all();
        return view('admin.PhieuNhap.themPN', ['listNCC' => $listNCC, 'maPN' => $maPN], compact('products'));
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
    
    public function xuLyLapPNCT1(Request $request){
        $maCTPN = 'CTPN' . uniqid();
        $maPN = $request->maPN;
        $maSP = $request->maSP;
        $soLuong = $request->soLuong;
        $gia = $request->gia;
        
        if ($maPN) {
            $ktSanPhamTonTai = ChiTietPhieuNhap::where('MaPhieuNhap', $maPN)
                                ->where('MaSanPham', $maSP)
                                ->first();
            if($ktSanPhamTonTai){
                $ktSanPhamTonTai->SoLuong += $soLuong;
                $ktSanPhamTonTai->GiaSanPham = $gia;
                $ktSanPhamTonTai->save();
                $message = 'Cập nhật thành công';
            }else{
                $ctpn = new ChiTietPhieuNhap();
                $ctpn->MaCTPN = $maCTPN;
                $ctpn->MaPhieuNhap = $maPN;
                $ctpn->MaSanPham = $maSP;
                $ctpn->SoLuong = $soLuong;
                $ctpn->GiaSanPham = $gia;      
                $ctpn->save();
                $message = 'Thêm thành công';
            }
            $tenSP = DB::select("SELECT TenSanPham FROM tbl_sanpham WHERE MaSanPham = '{$maSP}'");
            $tenSP1 = $tenSP[0]->TenSanPham;
            return response()->json([
                'success' => true,
                'message' =>$message,
                'maCTPN' => $maCTPN,
                'maPN' => $maPN,
                'maSP' => $maSP,
                'tenSP' => $tenSP1,
                'soLuong' => $ktSanPhamTonTai ? $ktSanPhamTonTai->SoLuong : $soLuong,
                'gia' => $gia
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Không tìm thấy sản phẩm']);
        
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

        $maCTPN = 'CTPN' . uniqid();
        $maPN = $request->maPNSua;
        $maSP = $request->maSP;
        $soLuong = $request->soLuong;
        $gia = $request->gia;
  
        $ktSanPhamTonTai = ChiTietPhieuNhap::where('MaPhieuNhap', $maPN)
                            ->where('MaSanPham', $maSP)
                            ->first();
        if($ktSanPhamTonTai){
            $ktSanPhamTonTai->SoLuong += $soLuong;
            $ktSanPhamTonTai->GiaSanPham = $gia;
            $ktSanPhamTonTai->save();
        }else{
            $ctpn = new ChiTietPhieuNhap();
            $ctpn->MaCTPN = $maCTPN;
            $ctpn->MaPhieuNhap = $maPN;
            $ctpn->MaSanPham = $maSP;
            $ctpn->SoLuong = $soLuong;
            $ctpn->GiaSanPham = $gia;      
            $ctpn->save();
        }
        return redirect()->route('suaPN', ['id'=>$maPN]);
    }

    public function xoaCTS($id){
        $maPN = DB::select("SELECT MaPhieuNhap, MaSanPham, SoLuong FROM tbl_chitietphieunhap WHERE MaCTPN = '$id'");
        DB::delete("DELETE FROM tbl_chitietphieunhap WHERE MaCTPN = '{$id}'");
        return redirect()->route('suaPN', ['id' => $maPN[0]->MaPhieuNhap]);
    }

    public function xoaCTPN($id){
        DB::delete("DELETE FROM tbl_chitietphieunhap WHERE MaCTPN = '{$id}'");  
        return redirect('/lap-phieu-nhap-chi-tiet');          
    }

    public function luuPN($id){

        $maPN = $id;

        $tongTien = 0;
        $ctpn = DB::select("SELECT * FROM tbl_chitietphieunhap WHERE MaPhieuNhap = '{$maPN}'");
        foreach ($ctpn as $ct){
            $tongTien += $ct->SoLuong * $ct->GiaSanPham;
        }

        $pn = DB::select("SELECT TienTra FROM tbl_phieunhap WHERE MaPhieuNhap = '{$maPN}'");
        $tienNo = $tongTien - $pn[0]->TienTra;
        PhieuNhap::where('MaPhieuNhap', $maPN)->update([
            'TongTien' => $tongTien,
            'TienNo' => $tienNo
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
        
        $maPN = $request->maPhieu;
        $thoiGianTao = date('Y-m-d H:i:s');
        
        $tienTra = 0;
        $tienNo = $request->tongTien - $tienTra;
        $tenTK = $request->nguoiLap;
        $maTK = DB::select("SELECT * FROM tbl_taikhoan WHERE TenTaiKhoan = '{$tenTK}'");
        $maNCC = $request->maNCC;
        $trangThai = 0;
        
        if ($maPN) {
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
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Mời bạn kiểm tra lại thông tin!!']);
    }

    public function updateSoLuong(Request $request)
    {
        $MaCTPN = $request->input('MaCTPN');
        $soLuong = $request->input('soLuong');
        $giaSanPham = $request->input('giaSanPham');
        
        if ($MaCTPN) {
            ChiTietPhieuNhap::where('MaCTPN', $MaCTPN)->update([
                'SoLuong' => $soLuong,
                'GiaSanPham' => $giaSanPham,
            ]);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Không tìm thấy sản phẩm']);
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

        $trangThai1 = $request->trangThaiTruoc;
        $trangThai2 = $request->trangThai;
        if($trangThai2 == 1 && ($trangThai1 != $trangThai2)){
            foreach($ctpn as $ct){
                $maSP = $ct->MaSanPham;
                $soLuong = $ct->SoLuong;
                $sltk = DB::select("SELECT SoLuongTrongKho, SoLuongHienTai FROM tbl_sanpham WHERE MaSanPham = '{$maSP}'");
                $sl = $sltk[0]->SoLuongTrongKho + $soLuong;
                $sl2 = $sltk[0]->SoLuongHienTai + $soLuong;
                SanPham::where('MaSanPham', $maSP)->update([
                    'SoLuongTrongKho' => $sl,
                    'SoLuongHienTai' => $sl2,
                ]);
            }
        }elseif($trangThai2 == 0 && ($trangThai1 != $trangThai2)){
            $spMoi = [];
            foreach($ctpn as $ct){
                $maSP = $ct->MaSanPham;
                $soLuong = $ct->SoLuong;

                $sltk = DB::select("SELECT SoLuongTrongKho, SoLuongHienTai FROM tbl_sanpham WHERE MaSanPham = '{$maSP}'");
                $sltkHienTai = $sltk[0]->SoLuongTrongKho;
                $slhtHienTai = $sltk[0]->SoLuongHienTai;

                $sl = $sltkHienTai - $soLuong;
                $sl2 = $slhtHienTai - $soLuong;

                if($sl < 0){
                    return redirect()->back()->withErrors(['trangThai' => 'Số lượng trong kho không đủ. Mời bạn kiểm tra lại']);
                }

                $spMoi[$maSP] = [
                    'SoLuongTrongKho' => $sl,
                    'SoLuongHienTai' => $sl2,
                ];
            }
            foreach($spMoi as $maSP => $slMoi){
                SanPham::where('MaSanPham', $maSP)->update([
                    'SoLuongTrongKho' => $slMoi['SoLuongTrongKho'],
                    'SoLuongHienTai' => $slMoi['SoLuongHienTai'],
                ]);
            }
        }

        PhieuNhap::where('MaPhieuNhap', $maPN)->update([
            'TongTien' => $tongTien,
            'TienTra' => $tienTraMoi,
            'TienNo' => $tienNo,
            'PhuongThucThanhToan' => $request->thanhToan,
            'TrangThai' => $request->trangThai,
            'ThoiGianSua' => $thoiGianSua,
        ]);
        return redirect()->route('xemPN');

    }

    public function xoaPN($id){
        $maPTH = DB::select("SELECT MaPhieuTraHang, TrangThai FROM tbl_phieutrahang WHERE MaPhieuNhap = '{$id}'");
        $pth = [];
        foreach($maPTH as $i){
            $tt = $i->TrangThai;
            $ma = $i->MaPhieuTraHang;
            if($tt == 1){
                return redirect('/liet-ke-phieu-nhap')->withErrors(['phieuTH' => 'Mời bạn kiểm tra lại phiếu trả hàng (có phiếu đã được xác nhận)']);
            }
            
            $pth[] = $ma;
        }
        foreach($pth as $ma){
            DB::delete("DELETE FROM tbl_chitietphieutrahang WHERE MaPhieuTraHang = '{$ma}'");
            DB::delete("DELETE FROM tbl_phieutrahang WHERE MaPhieuTraHang = '{$ma}'");
        }
        
        DB::delete("DELETE FROM tbl_chitietphieunhap WHERE MaPhieuNhap = '{$id}'");
        DB::delete("DELETE FROM tbl_phieunhap WHERE MaPhieuNhap = '{$id}'");

        return redirect('/liet-ke-phieu-nhap');
    }
}
