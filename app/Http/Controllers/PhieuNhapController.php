<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use App\Models\PhieuNhap;
use Illuminate\Support\Facades\DB;

class PhieuNhapController extends Controller
{
    public function trangXemPhieuNhap(){
        $pns = PhieuNhap::all();

        return view('admin.PhieuNhap.xemPhieuNhap', ['data' => $pns]);
    } 

    public function xemCTPN($id){
        $pn = DB::select("SELECT * FROM test1 WHERE test1.maPN = '{$id}' LIMIT 1");
        return view('admin.PhieuNhap.xemCT', ['data' => $pn]);
    }

    public function lapPN(){
        return view('admin.PhieuNhap.lapPN');
    }

    public function luuPN(Request $request)
    {
 
        $validatedData = $request->validate([
            'nguoiLap' => 'required|max:255',
            'maNCC' => 'required|max:255',
            'tongTien' => 'required|numeric',
            'soTienTra' => 'required|numeric',
        ]);
        
        
        $maPN = 'PN' . date('YmdHis');
        $thoiGianLap = date('Y-m-d H:i:s');
        $soTienNo = $request->tongTien - $request->soTienTra;
        $validatedData = $request->all();

        DB::table('test1')->insert([
            'maPN' => $maPN,
            'nguoiLap' => $validatedData['nguoiLap'],
            'maNCC' => $validatedData['maNCC'],
            'thoiGianLap' => $thoiGianLap,
            'tongTien' => $validatedData['tongTien'],
            'soTienTra' => $validatedData['soTienTra'],
            'soTienNo' => $soTienNo,
        ]);

        return redirect('/xemPN')->with('success', 'Lap phieu nhap thanh cong');
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
