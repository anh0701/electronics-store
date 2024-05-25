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
        $user = session(('user'));
        $tenTK = $user['TenTaiKhoan'];
        $products = SanPham::all();
        $maPX = 'PX' . date('YmdHis');
        $thoiGianTao = date('Y-m-d H:i:s');
        $tongSL = 0;
        $maTK = DB::select("SELECT MaTaiKhoan FROM tbl_taikhoan WHERE TenTaiKhoan = '{$tenTK}'");
        $phieuxuat = new PhieuXuat();
        $phieuxuat->MaPhieuXuat = $maPX;
        $phieuxuat->MaTaiKhoan = $maTK[0]->MaTaiKhoan;
        $phieuxuat->TongSoLuong = $tongSL;
        $phieuxuat->TrangThai = 0;
        $phieuxuat->ThoiGianTao = $thoiGianTao;
        $phieuxuat->save();

        return view('admin.PhieuXuat.taoPX', compact('products'), ['maPX' => $maPX]);
    }

    public function taoCT($id){
        $products = SanPham::all();
        $ct = DB::select("SELECT ct.*, sp.TenSanPham
                            FROM tbl_chitietphieuxuat ct
                            JOIN tbl_sanpham sp ON ct.MaSanPham = sp.MaSanPham
                            WHERE MaPhieuXuat = '{$id}'");
        return view('admin.PhieuXuat.taoPXCT', compact('products'), ['data' => $ct, 'maPX' => $id]);
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

        $maPX = $request->id;
        $maCTPX = 'CTPX' . uniqid();
        $ctpx = new ChiTietPhieuXuat();
        $ctpx->MaCTPX = $maCTPX;
        $ctpx->MaPhieuXuat = $maPX;
        $ctpx->MaSanPham = $request->maSP;
        $ctpx->SoLuong = $request->soLuong;
        $ctpx->save();
        $p = $request->page;
        if($p == "tao"){
            return redirect()->route('taoCT', ['id' => $maPX]);
        }else{
            return redirect()->route('suaPX', ['id' => $maPX]);
        }
        
    }

    public function xoaCT($id){
        $maP = DB::select("SELECT MaPhieuXuat FROM tbl_chitietphieuxuat WHERE MaCTPX = '$id'");
        DB::delete("DELETE FROM tbl_chitietphieuxuat WHERE MaCTPX = '{$id}'");      
        return redirect()->route('taoCT', ['id' => $maP[0]->MaPhieuXuat]);   
    }

    public function xoaCTS($id){
        $maP = DB::select("SELECT MaPhieuXuat FROM tbl_chitietphieuxuat WHERE MaCTPX = '$id'");
        DB::delete("DELETE FROM tbl_chitietphieuxuat WHERE MaCTPX = '{$id}'");      
        return redirect()->route('suaPX', ['id' => $maP[0]->MaPhieuXuat]);   
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
        return view('admin.PhieuXuat.suaPX', ['px' => $px[0], 'ct' => $ct], compact('products'));
    }

    public function suaPXP(Request $request){
        $maPX = $request->maPX;
        $ct = DB::select("SELECT * FROM tbl_chitietphieuxuat WHERE MaPhieuXuat = '{$maPX}'");
        $tongSL = 0;
        foreach($ct as $i){
            $tongSL += $i->SoLuong;
        }
        $tgSua = date('Y-m-d H:i:s');
        PhieuXuat::where('MaPhieuXuat', $maPX)->update([
            'TongSoLuong' => $tongSL,
            'TrangThai' => $request->trangThai,
            'ThoiGianSua' => $tgSua,
        ]);
        return redirect()->route('xemCT', ['id' => $maPX]);
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
