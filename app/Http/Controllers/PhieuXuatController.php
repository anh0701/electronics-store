<?php

namespace App\Http\Controllers;

use App\Models\ChiTietPhieuXuat;
use App\Models\PhieuXuat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use App\Models\SanPham;

class PhieuXuatController extends Controller
{
    //
    public function xem(){
        $pxs = DB::table('tbl_phieuxuat')
                ->join('tbl_taikhoan', 'tbl_phieuxuat.MaTaiKhoan', '=', 'tbl_taikhoan.MaTaiKhoan')
                ->select('tbl_phieuxuat.*', 'tbl_taikhoan.TenTaiKhoan')
                ->orderByDesc('tbl_phieuxuat.ThoiGianTao')
                ->paginate(5);

        return view('admin.PhieuXuat.lietKe', ['data' => $pxs]);
    } 

    public function xemCT($id){
        $px = DB::select("SELECT px.*, tk.TenTaiKhoan
                        FROM tbl_phieuxuat px 
                        JOIN tbl_taikhoan tk ON px.MaTaiKhoan = tk.MaTaiKhoan
                        WHERE MaPhieuXuat = '{$id}'");
        $ct = DB::select("SELECT ct.*, sp.TenSanPham
                            FROM tbl_chitietphieuxuat ct
                            JOIN tbl_sanpham sp ON ct.MaSanPham = sp.MaSanPham
                            WHERE MaPhieuXuat = '{$id}'");
        return view('admin.PhieuXuat.xemCT', ['px' => $px[0], 'ct' => $ct]);
    }

    public function xoaPX($id){
        DB::delete("DELETE FROM tbl_chitietphieuxuat WHERE MaPhieuXuat = '{$id}'");
        DB::delete("DELETE FROM tbl_phieuxuat WHERE MaPhieuXuat = '{$id}'");
        return redirect()->route('xemPX');
    }

    public function taoPX(){
        $maPX = 'PX' . date('YmdHis');
        $products = SanPham::all();
        return view('admin.PhieuXuat.themPX', ['maPX' => $maPX], compact('products'));
    }

    public function xuLyLapPX(Request $request)
    {
        $maPX = $request->maPhieu;
        $thoiGianTao = date('Y-m-d H:i:s');
        $tenTK = $request->nguoiLap;
        $maTK = DB::select("SELECT * FROM tbl_taikhoan WHERE TenTaiKhoan = '{$tenTK}'");
        $tongSL = $request->tongSoLuong;
        $trangThai = 0;
        
        if ($maPX) {
            $phieuxuat = new PhieuXuat();
            $phieuxuat->MaPhieuXuat = $maPX;
            $phieuxuat->MaTaiKhoan = $maTK[0]->MaTaiKhoan;
            $phieuxuat->TongSoLuong = $tongSL;
            $phieuxuat->TrangThai = $trangThai;
            $phieuxuat->ThoiGianTao = $thoiGianTao;
            $phieuxuat->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Mời bạn kiểm tra lại thông tin!!']);
    }

    public function xuLyLapPXCT1(Request $request){
        $maPX = $request->maPX;
        $maSP = $request->maSP;
        $soLuong = $request->soLuong;

        $soLuong = $request->soLuong;
        $sl = DB::select("SELECT SoLuongTrongKho FROM tbl_sanpham WHERE MaSanPham = '{$maSP}'");
        if($soLuong > $sl[0]->SoLuongTrongKho){
            return response()->json(['success' => false, 'message' => 'Số lượng trong kho không đủ']);
        }
        if ($maPX) {
            $maCTPX = 'CTPX' . uniqid();
            $ctpx = new ChiTietPhieuXuat();
            $ctpx->MaCTPX = $maCTPX;
            $ctpx->MaPhieuXuat = $maPX;
            $ctpx->MaSanPham = $maSP;
            $ctpx->SoLuong = $soLuong;    
            $ctpx->save();
            $tenSP = DB::select("SELECT TenSanPham FROM tbl_sanpham WHERE MaSanPham = '{$maSP}'");
            $tenSP1 = $tenSP[0]->TenSanPham;
            return response()->json([
                'success' => true,
                'maCTPX' => $maCTPX,
                'maPX' => $maPX,
                'maSP' => $tenSP1,
                'soLuong' => $soLuong,
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Không tìm thấy sản phẩm']);
        
    }
   
    public function taoPXCT(Request $request){
        $messages = [
            'maSP.required' => 'vui lòng chọn sản phẩm',
            'soLuong.required' => 'vui lòng nhập số lượng',
        ];
        $valid = $request->validate([
            'maSP' => 'required',
            'soLuong' => 'required',
        ], $messages);

        $maSP = $request->maSP;
        $soLuong = $request->soLuong;
        $sl = DB::select("SELECT SoLuongTrongKho FROM tbl_sanpham WHERE MaSanPham = '{$maSP}'");
        if($soLuong > $sl[0]->SoLuongTrongKho){
            return redirect()->back()->withInput()->withErrors(['soLuong' => 'Số lượng sản phẩm trong kho không đủ (Số lượng trong kho: ' . $sl[0]->SoLuongTrongKho . ')']);
        }

        $maPX = $request->maPXSua;
        $maCTPX = 'CTPX' . uniqid();
        $ctpx = new ChiTietPhieuXuat();
        $ctpx->MaCTPX = $maCTPX;
        $ctpx->MaPhieuXuat = $maPX;
        $ctpx->MaSanPham = $maSP;
        $ctpx->SoLuong = $soLuong;
        $ctpx->save();
        $p = $request->page;
        if($p == "tao"){
            return redirect()->route('taoCT', ['id' => $maPX]);
        }else{
            return redirect()->route('suaPX', ['id' => $maPX]);
        }
        
    }

    public function xoaCT($id, $maPX){
        DB::delete("DELETE FROM tbl_chitietphieuxuat WHERE MaCTPX = '{$id}'");      
        return redirect()->route('taoCT', ['id' => $maPX]);   
    }

    public function xoaCTPXS($id, $maPX){
        DB::delete("DELETE FROM tbl_chitietphieuxuat WHERE MaCTPX = '{$id}'");      
        return redirect()->route('suaPX', ['id' => $maPX]);   
    }

    public function luuPX($id){
        $ct = DB::select("SELECT * FROM tbl_chitietphieuxuat WHERE MaPhieuXuat = '{$id}'");
        $tongSL = 0;
        foreach($ct as $i){
            $tongSL += $i->SoLuong;
        }
        PhieuXuat::where('MaPhieuXuat', $id)->update([
            'TongSoLuong' => $tongSL,
        ]);
        return redirect()->route('xemPX');
    }

    public function suaPX($id){
        $products = SanPham::all();
        $px = DB::select("SELECT px.*, tk.TenTaiKhoan
                        FROM tbl_phieuxuat px 
                        JOIN tbl_taikhoan tk ON px.MaTaiKhoan = tk.MaTaiKhoan
                        WHERE MaPhieuXuat = '{$id}'");
        $ct = DB::select("SELECT ct.*, sp.TenSanPham
                            FROM tbl_chitietphieuxuat ct
                            JOIN tbl_sanpham sp ON ct.MaSanPham = sp.MaSanPham
                            WHERE MaPhieuXuat = '{$id}'");
        return view('admin.PhieuXuat.suaPX', ['px' => $px[0], 'ctpx' => $ct], compact('products'));
    }

    public function suaPXP(Request $request){
        $maPX = $request->maPX;
        $ctpx = DB::select("SELECT * FROM tbl_chitietphieuxuat WHERE MaPhieuXuat = '{$maPX}'");
        $tongSL = 0;
        foreach($ctpx as $i){
            $tongSL += $i->SoLuong;
        }
        $tgSua = date('Y-m-d H:i:s');
        PhieuXuat::where('MaPhieuXuat', $maPX)->update([
            'TongSoLuong' => $tongSL,
            'TrangThai' => $request->trangThai,
            'ThoiGianSua' => $tgSua,
        ]);
        $trangThai1 = $request->trangThaiTruoc;
        $trangThai2 = $request->trangThai;
        if($trangThai2 == 1 && ($trangThai1 != $trangThai2)){
            foreach($ctpx as $ct){
                $maSP = $ct->MaSanPham;
                $soLuong = $ct->SoLuong;
                $sltk = DB::select("SELECT SoLuongTrongKho, SoLuongHienTai FROM tbl_sanpham WHERE MaSanPham = '{$maSP}'");
                $sl = $sltk[0]->SoLuongTrongKho - $soLuong;
                $sl2 = $sltk[0]->SoLuongHienTai - $soLuong;
                SanPham::where('MaSanPham', $maSP)->update([
                    'SoLuongTrongKho' => $sl,
                    'SoLuongHienTai' => $sl2,
                ]);
            }
        }elseif($trangThai2 == 0 && ($trangThai1 != $trangThai2)){
            foreach($ctpx as $ct){
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
        }
        return redirect()->route('xemPX');
    }

    public function updateSoLuong(Request $request)
    {
        $MaCTPX = $request->input('MaCTPX');
        $soLuong = $request->input('soLuong');

        $sl = DB::select("SELECT sp.SoLuongTrongKho 
                        FROM tbl_sanpham sp
                        JOIN tbl_chitietphieuxuat px ON px.MaSanPham = sp.MaSanPham
                        WHERE MaCTPX = '{$MaCTPX}'");
        if($soLuong > $sl[0]->SoLuongTrongKho){
            return response()->json(['success' => false, 'message' => 'Số lượng sản phẩm trong kho không đủ']);
        }
        if ($MaCTPX) {
            ChiTietPhieuXuat::where('MaCTPX', $MaCTPX)->update([
                'SoLuong' => $soLuong,
            ]);
            return response()->json(['success' => true]);
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