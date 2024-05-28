<?php

namespace App\Http\Controllers;

use App\Models\ChiTietPhieuTraHang;
use App\Models\PhieuTraHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SanPham;

class PhieuTraHangController extends Controller
{
    //
    public function xem(){
        $pth = DB::table('tbl_phieutrahang')
                ->join('tbl_taikhoan', 'tbl_phieutrahang.MaTaiKhoan', '=', 'tbl_taikhoan.MaTaiKhoan')
                ->join('tbl_nhacungcap', 'tbl_phieutrahang.MaNhaCungCap', '=', 'tbl_nhacungcap.MaNhaCungCap')
                ->select('tbl_phieutrahang.*', 'tbl_taikhoan.TenTaiKhoan', 'tbl_nhacungcap.TenNhaCungCap')
                ->orderByDesc('tbl_phieutrahang.ThoiGianTao')
                ->paginate(5);

        return view('admin.PhieuTraHang.lietKeTH', ['data' => $pth]);
    } 

    public function xemCTPTH($id){
        $pth = DB::select("SELECT pth.*, tk.TenTaiKhoan
                        FROM tbl_phieutrahang pth 
                        JOIN tbl_taikhoan tk ON pth.MaTaiKhoan = tk.MaTaiKhoan
                        WHERE MaPhieuTraHang = '{$id}'");
        $ctth = DB::select("SELECT ct.*, sp.TenSanPham
                        FROM tbl_chitietphieutrahang ct
                        JOIN tbl_sanpham sp ON ct.MaSanPham = sp.MaSanPham
                        WHERE MaPhieuTraHang = '{$id}'");
        return view('admin.PhieuTraHang.xemCT', ['pth' => $pth[0], 'ctth' => $ctth]);
    }

    public function luuPTH($id){
        $ct = DB::select("SELECT * FROM tbl_chitietphieutrahang WHERE MaPhieuTraHang = '{$id}'");
        $tongTien = 0;
        foreach($ct as $i){
            $tien = $i->SoLuong * $i->GiaSanPham;
            $tongTien += $tien;
        }
        PhieuTraHang::where('MaPhieuTraHang', $id)->update([
            'TongTien' => $tongTien,
        ]);
        return redirect()->route('xemCTPTH', ['id' => $id]);
    }
    public function xoaPTH($id){
        DB::delete("DELETE FROM tbl_chitietphieutrahang WHERE MaPhieuTraHang = '{$id}'");
        DB::delete("DELETE FROM tbl_phieutrahang WHERE MaPhieuTraHang = '{$id}'");

        return redirect()->route('xemPTH');
    }

    public function suaPTH($id){
        $pth = DB::select("SELECT pth.*, tk.TenTaiKhoan
                        FROM tbl_phieutrahang pth 
                        JOIN tbl_taikhoan tk ON pth.MaTaiKhoan = tk.MaTaiKhoan
                        WHERE MaPhieuTraHang = '{$id}'");
        $maPN = $pth[0]->MaPhieuNhap;
        $ctpn = DB::select("SELECT ct.*, sp.TenSanPham
                        FROM tbl_chitietphieunhap ct
                        JOIN tbl_sanpham sp ON ct.MaSanPham = sp.MaSanPham
                        WHERE MaPhieuNhap = '{$maPN}'");
        $ctpth = DB::select("SELECT ct.*, sp.TenSanPham
                    FROM tbl_chitietphieutrahang ct
                    JOIN tbl_sanpham sp ON ct.MaSanPham = sp.MaSanPham
                    WHERE MaPhieuTraHang = '{$id}'");
        $products = SanPham::all();
        return view('admin.PhieuTraHang.suaTH', ['pth' => $pth[0], 'ctpn' => $ctpn, 'ctpth' => $ctpth], compact('products'));
    }

    public function xuLySuaPTH(Request $request){

    }

    public function xuLyLapTHCT(Request $request){
        $messages = [
            'maSP.required' => 'vui lòng chọn sản phẩm',
            'soLuong.required' => 'vui lòng nhập số lượng',
            'lyDo' => 'vui lòng nhập lý do trả hàng',
        ];
        $valid = $request->validate([
            'maSP' => 'required',
            'soLuong' => 'required',
            'lyDo' => 'required',
        ], $messages);

        $maSP = $request->maSP;
        $soLuong = $request->soLuong;
        $sl = DB::select("SELECT SoLuongTrongKho FROM tbl_sanpham WHERE MaSanPham = '{$maSP}'");
        if($soLuong > $sl[0]->SoLuongTrongKho){
            return redirect()->back()->withInput()->withErrors(['soLuong' => 'Số lượng sản phẩm trong kho không đủ (Số lượng trong kho: ' . $sl[0]->SoLuongTrongKho . ')']);
        }
        $maPTH = $request->maPTHSua;
        $maPN = $request->maPN;
        $lyDo = $request->lyDo;
        $gia = 0;

        $ctpn = DB::select("SELECT * FROM tbl_chitietphieunhap WHERE MaPhieuNhap = '{$maPN}'");
        $kt = false;
        foreach($ctpn as $i){
            if($i->MaSanPham == $maSP){
                if($i->SoLuong < $soLuong){
                    return redirect()->back()->withInput()->withErrors(['soLuong' => 'Nhập quá số lượng trong phiếu nhập (Số lượng trong phiếu nhập: ' . $i->SoLuong . ')']);
                }
                $gia = $i->GiaSanPham;
                $kt = true;
                break;
            }
        }
        if(!$kt){
            return redirect()->back()->withInput()->withErrors(['maSP' => 'Không tìm thấy sản phẩm']);
        }
        
        if ($maPTH) {
            $maCTTH = 'CTTH' . uniqid();
            $ctth = new ChiTietPhieuTraHang();
            $ctth->MaCTPTH = $maCTTH;
            $ctth->MaPhieuTraHang = $maPTH;
            $ctth->MaSanPham = $maSP;
            $ctth->SoLuong = $soLuong;    
            $ctth->GiaSanPham = $gia;
            $ctth->LyDoTraHang = $lyDo;
            $ctth->save();
        }

        return redirect()->route('suaPTH', ['id' => $maPTH]);  
    }

    public function updateSoLuong(Request $request)
    {
        $MaCTPTH = $request->input('MaCTPTH');
        $soLuong = $request->input('soLuong');
        $lyDoTraHang = $request->input('lyDoTraHang');
        $tenSanPham = $request->input('tenSanPham');
        $maPN = $request->input('maPN');
        $sl = DB::select("SELECT sp.SoLuongTrongKho 
                        FROM tbl_sanpham sp
                        JOIN tbl_chitietphieutrahang px ON px.MaSanPham = sp.MaSanPham
                        WHERE MaCTPTH = '{$MaCTPTH}'");
        if($soLuong > $sl[0]->SoLuongTrongKho){
            return response()->json(['success' => false, 'message' => 'Số lượng sản phẩm trong kho không đủ']);
        }
        $ctpn = DB::select("SELECT ct.*
                        FROM tbl_chitietphieunhap ct
                        JOIN tbl_sanpham sp ON ct.MaSanPham = sp.MaSanPham
                        WHERE MaPhieuNhap = '{$maPN}' AND TenSanPham = '{$tenSanPham}'");

        if($ctpn[0]->SoLuong < $soLuong){
            return response()->json(['success' => false, 'message' => 'Nhập quá số lượng trong phiếu nhập']);
        }
        
        if ($MaCTPTH) {
            ChiTietPhieuTraHang::where('MaCTPTH', $MaCTPTH)->update([
                'SoLuong' => $soLuong,
                'LyDoTraHang' => $lyDoTraHang,
            ]);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Không tìm thấy sản phẩm']);
    }

    public function xoaCTPTHS($id, $maPTH){
        DB::delete("DELETE FROM tbl_chitietphieutrahang WHERE MaCTPTH = '{$id}'");      
        return redirect()->route('suaPTH', ['id' => $maPTH]);   
    }

    public function lapTH($id, $maNCC){
        $maTH = 'TH' . date('YmdHis');
        $products = SanPham::all();
        $ctpn = DB::select("SELECT ct.*, sp.TenSanPham
                        FROM tbl_chitietphieunhap ct
                        JOIN tbl_sanpham sp ON ct.MaSanPham = sp.MaSanPham
                        WHERE MaPhieuNhap = '{$id}'");
        return view('admin.PhieuTraHang.themTh', ['maTH' => $maTH, 'maPN' => $id, 'maNCC' => $maNCC, 'ctpn' => $ctpn], compact('products'));
    }

    public function xuLyLapTH(Request $request)
    {
        $maTH = $request->maPhieu;
        $maPN = $request->maPN;
        $maNCC = $request->maNCC;
        $thoiGianTao = date('Y-m-d H:i:s');
        $tenTK = $request->nguoiLap;
        $maTK = DB::select("SELECT * FROM tbl_taikhoan WHERE TenTaiKhoan = '{$tenTK}'");
        $trangThai = 0;
        $tongTien = 0;
        
        if ($maTH) {
            $phieutrahang = new PhieuTraHang();
            $phieutrahang->MaPhieuTraHang = $maTH;
            $phieutrahang->MaPhieuNhap = $maPN;
            $phieutrahang->MaNhaCungCap = $maNCC;
            $phieutrahang->MaTaiKhoan = $maTK[0]->MaTaiKhoan;
            $phieutrahang->TrangThai = $trangThai;
            $phieutrahang->TongTien = $tongTien;
            $phieutrahang->ThoiGianTao = $thoiGianTao;
            $phieutrahang->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Mời bạn kiểm tra lại thông tin!!']);
    }

    public function xuLyLapTHCT1(Request $request){
        $maTH = $request->maTH;
        $maSP = $request->maSP;
        $maPN = $request->maPN;
        $soLuong = $request->soLuong;
        $lyDo = $request->lyDo;
        $gia = 0;

        $ctpn = DB::select("SELECT * FROM tbl_chitietphieunhap WHERE MaPhieuNhap = '{$maPN}'");
        $kt = false;
        foreach($ctpn as $i){
            if($i->MaSanPham == $maSP){
                if($i->SoLuong < $soLuong){
                    return response()->json(['success' => false, 'message' => 'Nhập quá số lượng trong phiếu nhập']);
                }
                $gia = $i->GiaSanPham;
                $kt = true;
                break;
            }

        }
        if(!$kt){
            return response()->json(['success' => false, 'message' => 'Không tìm thấy sản phẩm']);
        }

        $sl = DB::select("SELECT SoLuongTrongKho FROM tbl_sanpham WHERE MaSanPham = '{$maSP}'");
        if($soLuong > $sl[0]->SoLuongTrongKho){
            return response()->json(['success' => false, 'message' => 'Số lượng trong kho không đủ']);
        }
        if ($maTH) {
            $maCTTH = 'CTTH' . uniqid();
            $ctth = new ChiTietPhieuTraHang();
            $ctth->MaCTPTH = $maCTTH;
            $ctth->MaPhieuTraHang = $maTH;
            $ctth->MaSanPham = $maSP;
            $ctth->SoLuong = $soLuong;    
            $ctth->GiaSanPham = $gia;
            $ctth->LyDoTraHang = $lyDo;
            $ctth->save();
            $tenSP = DB::select("SELECT TenSanPham FROM tbl_sanpham WHERE MaSanPham = '{$maSP}'");
            $tenSP1 = $tenSP[0]->TenSanPham;
            return response()->json([
                'success' => true,
                'maCTTH' => $maCTTH,
                'maSP' => $tenSP1,
                'soLuong' => $soLuong,
                'gia' => $gia,
                'lyDo' => $lyDo,
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Không tìm thấy sản phẩm']);
        
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

}
