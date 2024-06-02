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
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Response;

class BaoCaoController extends Controller
{
    //
    public function xem(){
        return view('admin.BaoCao.xem', ['data' => '']);
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
        
        $tgD = Carbon::createFromFormat('Y-m-d', $request->input('tgDau'));
        $tgC = Carbon::createFromFormat('Y-m-d', $request->input('tgCuoi'));
        $tgDau = $tgD->format('d/m/Y');
        $tgCuoi = $tgC->format('d/m/Y');
        
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Báo cáo xuất nhập tồn');
        $sheet->mergeCells('A1:B1');
        $sheet->setCellValue('C1', 'Thời gian:  ' . $tgDau. '  -  ' . $tgCuoi);
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

        $tgDau = $tgD->format('d_m_Y');
        $tgCuoi = $tgC->format('d_m_Y');

        $writer = new Xlsx($spreadsheet);
        $fileName = 'bao_cao_xuat_nhap_ton_'. $tgDau . '_' . $tgCuoi . '.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($temp_file);
        return Response::download($temp_file, $fileName)->deleteFileAfterSend(true);

    }
}
