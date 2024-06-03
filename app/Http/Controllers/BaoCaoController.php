<?php

namespace App\Http\Controllers;

use App\Models\ChiTietPhieuNhap;
use App\Models\ChiTietPhieuXuat;
use App\Models\PhieuNhap;
use App\Models\PhieuXuat;
use App\Models\SanPham;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;

class BaoCaoController extends Controller
{
    //
    public function xem(){
        $path = public_path('baoCaoXNT');
        $file = File::files($path);

        return view('admin.BaoCao.xem', ['file' => $file]);
    }

    public function xemCT($fileName) {
        $filePath = public_path('baoCaoXNT/' . $fileName);

        if (!File::exists($filePath)) {
            abort(404);
        }

        $spreadsheet = IOFactory::load($filePath);
        $sheet = $spreadsheet->getActiveSheet();
        $data = $sheet->toArray();

        return view('admin.BaoCao.xemCT', ['data' => $data, 'fileName' => $fileName]);
    }

    public function xuLyTaoBaoCao(Request $request){
        $tgDau = $request->thoiGianDau;
        $tgCuoi = $request->thoiGianCuoi;

        $sp = SanPham::all()->keyBy('MaSanPham');

        $pns = PhieuNhap::whereBetween('ThoiGianTao', [$tgDau, $tgCuoi])
                        ->where('TrangThai', '=', 1)
                        ->get();
        $ctpns = ChiTietPhieuNhap::whereIn('MaPhieuNhap', $pns->pluck('MaPhieuNhap'))->get();
        $tongSLNhap = $ctpns->groupBy('MaSanPham')->map(function ($items) {
            return $items->sum('SoLuong');
        });

        $pxs = PhieuXuat::whereBetween('ThoiGianTao', [$tgDau, $tgCuoi])
                        ->where('TrangThai', '=', 1)
                        ->get();
        $ctpxs = ChiTietPhieuXuat::whereIn('MaPhieuXuat', $pxs->pluck('MaPhieuXuat'))->get();
        $tongSLXuat = $ctpxs->groupBy('MaSanPham')->map(function ($items) {
            return $items->sum('SoLuong');
        });


        $data = collect();

        foreach($sp as $maSanPham => $sanPham){
            $data->push([
                'maSanPham' => $maSanPham,
                'tenSanPham' => $sanPham->TenSanPham,
                'soLuongSP' => $sanPham->SoLuongTrongKho,
                'tongSLNhap' => $tongSLNhap->get($maSanPham, 0),
                'tongSLXuat' => $tongSLXuat->get($maSanPham, 0),
            ]);
        }

        $dataSP = $data->sortByDesc('tongSLXuat'); 

        return view('admin.BaoCao.baoCao', ['data' => $dataSP, 'tgDau'=>$tgDau, 'tgCuoi' => $tgCuoi]);
    }

    public function luuFile(Request $request){
        $jsonData = $request->input('dataSP');
        $data = json_decode($jsonData, true);
        

        $tgDau = $request->input('tgDau');

        $tg = date_format(date_create($tgDau), 'm_Y');
        
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Báo cáo xuất nhập tồn');
        $sheet->mergeCells('A1:B1');
        $sheet->setCellValue('C1', 'Thời gian:  ' . $tg);
        $sheet->mergeCells('C1:F1');

        $sheet->getColumnDimension('A')->setWidth(10);
        $sheet->getColumnDimension('B')->setWidth(40);
        $sheet->getColumnDimension('C')->setWidth(10);
        $sheet->getColumnDimension('D')->setWidth(10);
        $sheet->getColumnDimension('E')->setWidth(10); 
        $sheet->getColumnDimension('F')->setWidth(10); 
        
        $sheet->setCellValue('A2', 'Mã sản phẩm')
              ->setCellValue('B2', 'Tên sản phẩm')
              ->setCellValue('C2', 'Tồn đầu kỳ')
              ->setCellValue('D2', 'Số lượng nhập')
              ->setCellValue('E2', 'Số lượng xuất')
              ->setCellValue('F2', 'Tồn cuối kỳ');
        $row = 3;
        foreach ($data as $item) {
            $sltd = $item['soLuongSP'] + $item['tongSLXuat'] - $item['tongSLNhap'];
            $sheet->setCellValue('A' . $row, $item['maSanPham'])
                  ->setCellValue('B' . $row, $item['tenSanPham'])
                  ->setCellValue('C' . $row, $sltd)
                  ->setCellValue('D' . $row, $item['tongSLNhap'])
                  ->setCellValue('E' . $row, $item['tongSLXuat'])
                  ->setCellValue('F' . $row, $item['soLuongSP']);
            $row++;
        }

        $fileName = $tg . '.xlsx';
        $filePath = public_path('baoCaoXNT/' . $fileName);
        $writer = new Xlsx($spreadsheet);
        $writer->save($filePath);
        
        return redirect()->route('xemBaoCao');

    }

    public function taiXuong($fileName){
        $filePath = public_path('baoCaoXNT/' . $fileName);

        if (!File::exists($filePath)) {
            abort(404);
        }
    
        return response()->download($filePath, $fileName);
    }
}
