<?php

namespace App\Http\Controllers;

use App\Models\ChiTietPhieuNhap;
use App\Models\ChiTietPhieuXuat;
use App\Models\PhieuNhap;
use App\Models\PhieuXuat;
use App\Models\SanPham;
use Carbon\Carbon;
use Session;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

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

        $dataSP = array_filter($data, function($row){
            return isset($row[1]) && is_numeric($row[2]) && is_numeric($row[3]) && is_numeric($row[4]);
        });

        $dataSanPham = collect($dataSP);
        
        
        $danhMuc = collect(DB::select("SELECT MaDanhMuc, TenDanhMuc FROM tbl_danhmuc"));
        
        $bieuDo = $dataSanPham->groupBy(2)
        ->mapWithKeys(function($item, $maDanhMuc) use ($danhMuc){
            $tongNhap = $item->sum(4);
            $tongXuat = $item->sum(7);
            $tongTon = $item->sum(10);

            $tenDanhMuc = $danhMuc->firstWhere('MaDanhMuc', $maDanhMuc)->TenDanhMuc;
            return [$tenDanhMuc => [
                'tongNhap' => $tongNhap,
                'tongXuat' => $tongXuat,
                'tongTon' => $tongTon,
            ]];
        });
        
        
        $page = 5;
        $pageHienTai = LengthAwarePaginator::resolveCurrentPage();
        $sanPhamHienTai = $dataSanPham->slice(($pageHienTai - 1) * $page, $page)->all();

        $trangSanPham = new LengthAwarePaginator($sanPhamHienTai, $dataSanPham->count(), $page, $pageHienTai, [
            'path' => LengthAwarePaginator::resolveCurrentPath()
        ]);

        return view('admin.BaoCao.xemCT', ['data' => $trangSanPham, 'fileName' => $fileName], compact('bieuDo'));
    }

    public function xuLyTaoBaoCao(Request $request){
        if($request->thoiGian == 'thangNay'){
            $tgHienTai = Carbon::now();
            $tgDau = $tgHienTai->copy()->startOfMonth()->toDateTimeString();
            $tgCuoi = $tgHienTai->copy()->endOfMonth()->toDateTimeString();
        }elseif($request->thoiGian == 'thangTruoc'){
            $tgHienTai = Carbon::now();
            $thangTruoc = $tgHienTai->subMonth();

            $tgDau = $thangTruoc->copy()->startOfMonth()->toDateTimeString();
            $tgCuoi = $thangTruoc->copy()->endOfMonth()->toDateTimeString();
        }
        // dd($tgDau);
        $loaiBaoCao = $request->loaiBaoCao;

        


        $sp = SanPham::all()->keyBy('MaSanPham');

        $pns = PhieuNhap::whereBetween('ThoiGianTao', [$tgDau, $tgCuoi])
                        ->where('TrangThai', '=', 1)
                        ->get();
        $ctpns = ChiTietPhieuNhap::whereIn('MaPhieuNhap', $pns->pluck('MaPhieuNhap'))->get();
        $tongSLNhapVaGia = $ctpns->groupBy('MaSanPham')->map(function ($items) {
            return [
                'tongSoLuong' => $items->sum('SoLuong'),
                'giaNhap' => $items->pluck('GiaSanPham')->first(),
            ];
        });

        $pxs = PhieuXuat::whereBetween('ThoiGianTao', [$tgDau, $tgCuoi])
                        ->where('TrangThai', '=', 1)
                        ->get();
        $ctpxs = ChiTietPhieuXuat::whereIn('MaPhieuXuat', $pxs->pluck('MaPhieuXuat'))->get();
        $tongSLXuat = $ctpxs->groupBy('MaSanPham')->map(function ($items) {
            return $items->sum('SoLuong');
        });


        $data = collect();
        if($loaiBaoCao == 'baoCaoXNT'){
            foreach($sp as $maSanPham => $sanPham){
                $tongNhap = $tongSLNhapVaGia->get($maSanPham, ['tongSoLuong' => 0, 'giaNhap' => 0]);
                $data->push([
                    'maSanPham' => $maSanPham,
                    'tenSanPham' => $sanPham->TenSanPham,
                    'maDanhMuc' => $sanPham->MaDanhMuc,
                    'soLuongSP' => $sanPham->SoLuongTrongKho == 0 ? 0 : $sanPham->SoLuongTrongKho,
                    'tongSLNhap' => $tongNhap['tongSoLuong'],
                    'giaNhap' => $tongNhap['giaNhap'] == 0 ? $sanPham->GiaSanPham : $tongNhap['giaNhap'],
                    'tongSLXuat' => $tongSLXuat->get($maSanPham, 0),
                    'giaBan' => $sanPham->GiaSanPham,
                ]);
            }
        }elseif($loaiBaoCao == 'baoCaoN'){
            foreach($sp as $maSanPham => $sanPham){
                $tongNhap = $tongSLNhapVaGia->get($maSanPham, ['tongSoLuong' => 0, 'giaNhap' => 0]);
                if($tongNhap['tongSoLuong'] > 0){
                    $data->push([
                        'maSanPham' => $maSanPham,
                        'tenSanPham' => $sanPham->TenSanPham,
                        'maDanhMuc' => $sanPham->MaDanhMuc,
                        'tongSL' => $tongNhap['tongSoLuong'],
                        'gia' => $tongNhap['giaNhap'] == 0 ? $sanPham->GiaSanPham : $tongNhap['giaNhap'],
                    ]);
                }else{
                    
                }
                
            }
            return view('admin.BaoCao.baoCaoNhap', ['data' => $data, 'tgDau'=>$tgDau, 'tgCuoi' => $tgCuoi, 'loaiBaoCao'=>$loaiBaoCao]);
        }elseif($loaiBaoCao == 'baoCaoX'){
            foreach($sp as $maSanPham => $sanPham){
                if($tongSLXuat->get($maSanPham, 0) > 0){
                    $data->push([
                        'maSanPham' => $maSanPham,
                        'tenSanPham' => $sanPham->TenSanPham,
                        'maDanhMuc' => $sanPham->MaDanhMuc,
                        'tongSL' => $tongSLXuat->get($maSanPham, 0),
                        'gia' => $sanPham->GiaSanPham,
                    ]);
                }else{
                    
                }
                
            }
            return view('admin.BaoCao.baoCaoNhap', ['data' => $data, 'tgDau'=>$tgDau, 'tgCuoi' => $tgCuoi, 'loaiBaoCao'=>$loaiBaoCao]);
        }else{
            foreach($sp as $maSanPham => $sanPham){
                if($sanPham->SoLuongTrongKho > 0){
                    $data->push([
                        'maSanPham' => $maSanPham,
                        'tenSanPham' => $sanPham->TenSanPham,
                        'maDanhMuc' => $sanPham->MaDanhMuc,
                        'tongSL' => $sanPham->SoLuongTrongKho,
                        'gia' => $sanPham->GiaSanPham,
                    ]);
                }else{
                    
                }
                
            }
            return view('admin.BaoCao.baoCaoNhap', ['data' => $data, 'tgDau'=>$tgDau, 'tgCuoi' => $tgCuoi, 'loaiBaoCao'=>$loaiBaoCao]);
        }
        

        // $dataSP = $data->sortByDesc('tongSLXuat'); 

        return view('admin.BaoCao.baoCao', ['data' => $data, 'tgDau'=>$tgDau, 'tgCuoi' => $tgCuoi, 'loaiBaoCao'=>$loaiBaoCao]);
    }

    public function luuFile(Request $request){
        $jsonData = $request->input('dataSP');
        $tgDau = $request->input('tgDau');
        $tgCuoi = $request->input('tgCuoi');
        $data = json_decode($jsonData, true);
        // dd($data);

        $tg = date_format(date_create($tgDau), 'm_Y');
        $tgD = date_format(date_create($tgDau), 'd/m/Y');
        $tgC = date_format(date_create($tgCuoi), 'd/m/Y');
        
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'BÁO CÁO XUẤT NHẬP TỒN');
        $sheet->mergeCells('A1:M1');
        $sheet->getStyle('A1')->applyFromArray([
            'font' => [
            'bold' => true,
            'color' => ['rgb' => '0E46A3'],
            'name' => 'Times New Roman',
            'size' => 18,
        ],
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        ],
        ]);
        $sheet->setCellValue('A2', 'Từ ngày: ' . $tgD);
        $sheet->setCellValue('A3', 'Đến ngày: ' . $tgC);
        $sheet->mergeCells('A2:M2');
        $sheet->mergeCells('A3:M3');
        $sheet->getStyle('A2:M3')->applyFromArray([
            'font' => [
            'bold' => true,
            'italic' => true,
            'color' => ['rgb' => '0E46A3'],
            'name' => 'Times New Roman',
            'size' => 13,
        ],
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        ],
        ]);
        
        $sheet->getRowDimension(5)->setRowHeight(30);
        $sheet->getColumnDimension('A')->setWidth(10);
        $sheet->getColumnDimension('B')->setWidth(60);
        $sheet->getColumnDimension('C')->setWidth(5);
        $sheet->getColumnDimension('D')->setWidth(15);
        $sheet->getColumnDimension('E')->setWidth(10); 
        $sheet->getColumnDimension('F')->setWidth(12); 
        $sheet->getColumnDimension('G')->setWidth(15);
        $sheet->getColumnDimension('H')->setWidth(10); 
        $sheet->getColumnDimension('I')->setWidth(12); 
        $sheet->getColumnDimension('J')->setWidth(15);
        $sheet->getColumnDimension('K')->setWidth(10); 
        $sheet->getColumnDimension('L')->setWidth(12); 
        $sheet->getColumnDimension('M')->setWidth(15); 
        
        $sheet->setCellValue('A5', 'MÃ SẢN PHẨM')
              ->setCellValue('B5', 'TÊN SẢN PHẨM')
              ->setCellValue('C5', 'Mã danh mục')
              ->setCellValue('D5', 'TỒN ĐẦU KỲ')
              ->setCellValue('E5', 'NHẬP TRONG KỲ')
              ->setCellValue('H5', 'XUẤT TRONG KỲ')
              ->setCellValue('K5', 'TỒN CUỐI KỲ');
        $sheet->mergeCells('A5:A6');
        $sheet->mergeCells('B5:B6');
        $sheet->mergeCells('D5:D6');
        $sheet->mergeCells('E5:G5');
        $sheet->mergeCells('H5:J5');
        $sheet->mergeCells('K5:M5');
        $sheet->setCellValue('E6', 'SỐ LƯỢNG')
                ->setCellValue('F6', 'GIÁ NHẬP')
                ->setCellValue('G6', 'THÀNH TIỀN')
                ->setCellValue('H6', 'SỐ LƯỢNG')
                ->setCellValue('I6', 'GIÁ BÁN')
                ->setCellValue('J6', 'THÀNH TIỀN')
                ->setCellValue('K6', 'SỐ LƯỢNG')
                ->setCellValue('L6', 'GIÁ BÁN')
                ->setCellValue('M6', 'THÀNH TIỀN');


        $sheet->getStyle('A5:M6')->applyFromArray([
            'font' => [
            'bold' => true,
            'color' => ['rgb' => '0E46A3'],
            'name' => 'Times New Roman',
            'size' => 13,
        ],
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => ['rgb' => 'BFF6C3'],
        ],
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['rgb' => '000000'],
            ],
        ],
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            'wrapText' => true,
        ],
        ]);
        $sheet->getColumnDimension('C')->setVisible(false);

        $row = 7;
        $tongNhap = 0;
        $tongXuat = 0;
        $tongSoNhap = 0;
        $tongSoXuat = 0;
        $tongSoTon = 0;
        $tongGiaTri = 0;
        $tongSoTonDau = 0;
        foreach ($data as $item) {
            $sltd = $item['soLuongSP'] + $item['tongSLXuat'] - $item['tongSLNhap'];
            $thanhTienNhap = $item['tongSLNhap'] * $item['giaNhap'];
            $thanhTienXuat = $item['tongSLXuat'] * $item['giaBan'];
            $thanhTien = $item['soLuongSP'] * $item['giaBan'];
            $tongNhap += $thanhTienNhap;
            $tongXuat += $thanhTienXuat;
            $tongGiaTri += $thanhTien;
            $tongSoNhap += $item['tongSLNhap'];
            $tongSoXuat += $item['tongSLXuat'];
            $tongSoTon += $item['soLuongSP'];
            $tongSoTonDau += $sltd;
            $sheet->setCellValue('A' . $row, $item['maSanPham'])
                  ->setCellValue('B' . $row, $item['tenSanPham'])
                  ->setCellValue('C' . $row, $item['maDanhMuc'])
                  ->setCellValue('D' . $row, $sltd)
                  ->setCellValue('E' . $row, $item['tongSLNhap'])
                  ->setCellValue('F' . $row, $item['giaNhap'])
                  ->setCellValue('G' . $row, $thanhTienNhap)
                  ->setCellValue('H' . $row, $item['tongSLXuat'])
                  ->setCellValue('I' . $row, $item['giaBan'])
                  ->setCellValue('J' . $row, $thanhTienXuat)
                  ->setCellValue('K' . $row, $item['soLuongSP'])
                  ->setCellValue('L' . $row, $item['giaBan'])
                  ->setCellValue('M' . $row, $thanhTien);
            $row++;
        }
        $sheet->getStyle('A6:M' . ($row))->applyFromArray([
            'font' => [
            'color' => ['rgb' => '000000'],
            'name' => 'Times New Roman',
            'size' => 13,
        ],
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['rgb' => '000000'],
            ],
        ],
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        ],
        ]);
        $sheet->setCellValue('B' . $row, 'Tổng');
        $sheet->setCellValue('D' . $row, $tongSoTonDau);
        $sheet->setCellValue('E' . $row, $tongSoNhap);
        $sheet->setCellValue('G' . $row, $tongNhap);
        $sheet->setCellValue('H' . $row, $tongSoXuat);
        $sheet->setCellValue('J' . $row, $tongXuat);
        $sheet->setCellValue('K' . $row, $tongSoTon);
        $sheet->setCellValue('M' . $row, $tongGiaTri);
        $sheet->getStyle('A' . $row . ':M' . $row)->applyFromArray([
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => ['rgb' => 'FCDC2A'],
        ],
        ]);
        $sheet->getStyle('E7:M' . $row)->getNumberFormat()->setFormatCode('#,##0');

        $sheet->setCellValue('D' . ($row + 3), 'Nguời lập biểu');
        $sheet->setCellValue('G' . ($row + 3), 'Kế toán trưởng');
        $sheet->setCellValue('J' . ($row + 3), 'Giám đốc');
        $sheet->mergeCells('D'.($row + 3) . ':E' . ($row + 3));
        $sheet->mergeCells('G'.($row + 3) . ':H' . ($row + 3));
        $sheet->mergeCells('J'.($row + 3) . ':K' . ($row + 3));
        $sheet->getStyle('A' . ($row + 3) . ':M' . ($row + 3))->applyFromArray([
            'font' => [
            'bold' => true,
            'color' => ['rgb' => '000000'],
            'name' => 'Times New Roman',
            'size' => 13,
        ],
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        ],
        ]);
        
        $sheet->setCellValue('D' . ($row + 4), '(Ký và ghi rõ họ tên)');
        $sheet->setCellValue('G' . ($row + 4), '(Ký và ghi rõ họ tên)');
        $sheet->setCellValue('J' . ($row + 4), '(Ký và ghi rõ họ tên)');
        $sheet->mergeCells('D'.($row + 4) . ':E' . ($row + 4));
        $sheet->mergeCells('G'.($row + 4) . ':H' . ($row + 4));
        $sheet->mergeCells('J'.($row + 4) . ':K' . ($row + 4));
        $sheet->getStyle('A' . ($row + 4) . ':M' . ($row + 4))->applyFromArray([
            'font' => [
            'color' => ['rgb' => '000000'],
            'name' => 'Times New Roman',
            'size' => 13,
        ],
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        ],
        ]);

        $fileName = $tg . '.xlsx';
        $filePath = public_path('baoCaoXNT/' . $fileName);
        $writer = new Xlsx($spreadsheet);
        $writer->save($filePath);
        return response()->download($filePath, $fileName);

    }

    public function luuFileNhap(Request $request){
        $jsonData = $request->input('dataSP');
        $tgDau = $request->input('tgDau');
        $tgCuoi = $request->input('tgCuoi');
        $data = json_decode($jsonData, true);
        // dd($data);

        $loai = $request->input('loai');
        if($loai == "baoCaoN"){
            $s1 = "BÁO CÁO NHẬP KHO";
            $s2 = "NHẬP TRONG KỲ";
            $s3 = 'bao_cao_nhap_'; 
        }elseif($loai == "baoCaoX"){
            $s1 = "BÁO CÁO XUẤT KHO";
            $s2 = "XUẤT TRONG KỲ";
            $s3 = 'bao_cao_xuat_'; 
        }else{
            $s1 = "BÁO CÁO TỒN KHO";
            $s2 = "TỒN TRONG KỲ";
            $s3 = 'bao_cao_ton_';
        }

        $tg = date_format(date_create($tgDau), 'm_Y');
        $tgD = date_format(date_create($tgDau), 'd/m/Y');
        $tgC = date_format(date_create($tgCuoi), 'd/m/Y');
        
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', $s1);
        $sheet->mergeCells('A1:G1');
        $sheet->getStyle('A1')->applyFromArray([
            'font' => [
            'bold' => true,
            'color' => ['rgb' => '0E46A3'],
            'name' => 'Times New Roman',
            'size' => 18,
        ],
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        ],
        ]);
        $sheet->setCellValue('A2', 'Từ ngày: ' . $tgD);
        $sheet->setCellValue('A3', 'Đến ngày: ' . $tgC);
        $sheet->mergeCells('A2:G2');
        $sheet->mergeCells('A3:G3');
        $sheet->getStyle('A2:G3')->applyFromArray([
            'font' => [
            'bold' => true,
            'italic' => true,
            'color' => ['rgb' => '0E46A3'],
            'name' => 'Times New Roman',
            'size' => 13,
        ],
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        ],
        ]);
        
        $sheet->getRowDimension(5)->setRowHeight(30);
        $sheet->getColumnDimension('A')->setWidth(10);
        $sheet->getColumnDimension('B')->setWidth(60);
        $sheet->getColumnDimension('C')->setWidth(5);
        
        $sheet->getColumnDimension('E')->setWidth(10); 
        $sheet->getColumnDimension('F')->setWidth(12); 
        $sheet->getColumnDimension('G')->setWidth(15);
        
        
        $sheet->setCellValue('A5', 'MÃ SẢN PHẨM')
              ->setCellValue('B5', 'TÊN SẢN PHẨM')
              ->setCellValue('C5', 'Mã danh mục')
              ->setCellValue('E5', $s2);
        $sheet->mergeCells('A5:A6');
        $sheet->mergeCells('B5:B6');
        $sheet->mergeCells('D5:D6');
        $sheet->mergeCells('E5:G5');
        $sheet->mergeCells('H5:J5');
        $sheet->mergeCells('K5:M5');
        $sheet->setCellValue('E6', 'SỐ LƯỢNG')
                ->setCellValue('F6', 'GIÁ')
                ->setCellValue('G6', 'THÀNH TIỀN');


        $sheet->getStyle('A5:G6')->applyFromArray([
            'font' => [
            'bold' => true,
            'color' => ['rgb' => '0E46A3'],
            'name' => 'Times New Roman',
            'size' => 13,
        ],
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => ['rgb' => 'BFF6C3'],
        ],
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['rgb' => '000000'],
            ],
        ],
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            'wrapText' => true,
        ],
        ]);
        $sheet->getColumnDimension('C')->setVisible(false);
        $sheet->getColumnDimension('D')->setVisible(false);
        $row = 7;
        $tong = 0;
        $tongSo = 0;
        foreach ($data as $item) {
            $thanhTien = $item['tongSL'] * $item['gia'];
            $tong += $thanhTien;
            $tongSo += $item['tongSL'];
            $sheet->setCellValue('A' . $row, $item['maSanPham'])
                  ->setCellValue('B' . $row, $item['tenSanPham'])
                  ->setCellValue('C' . $row, $item['maDanhMuc'])
                  ->setCellValue('E' . $row, $item['tongSL'])
                  ->setCellValue('F' . $row, $item['gia'])
                  ->setCellValue('G' . $row, $thanhTien);
            $row++;
        }
        $sheet->getStyle('A6:G' . ($row))->applyFromArray([
            'font' => [
            'color' => ['rgb' => '000000'],
            'name' => 'Times New Roman',
            'size' => 13,
        ],
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['rgb' => '000000'],
            ],
        ],
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        ],
        ]);
        $sheet->setCellValue('B' . $row, 'Tổng');
        $sheet->setCellValue('E' . $row, $tongSo);
        $sheet->setCellValue('G' . $row, $tong);
        
        $sheet->getStyle('A' . $row . ':G' . $row)->applyFromArray([
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => ['rgb' => 'FCDC2A'],
        ],
        ]);
        $sheet->getStyle('E7:M' . $row)->getNumberFormat()->setFormatCode('#,##0');

        $sheet->setCellValue('B' . ($row + 3), 'Nguời lập biểu');
        $sheet->setCellValue('G' . ($row + 3), 'Kế toán trưởng');
        $sheet->setCellValue('J' . ($row + 3), 'Giám đốc');
        $sheet->mergeCells('B'.($row + 3) . ':C' . ($row + 3));
        $sheet->mergeCells('G'.($row + 3) . ':H' . ($row + 3));
        $sheet->mergeCells('J'.($row + 3) . ':K' . ($row + 3));
        $sheet->getStyle('A' . ($row + 3) . ':M' . ($row + 3))->applyFromArray([
            'font' => [
            'bold' => true,
            'color' => ['rgb' => '000000'],
            'name' => 'Times New Roman',
            'size' => 13,
        ],
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        ],
        ]);
        
        $sheet->setCellValue('B' . ($row + 4), '(Ký và ghi rõ họ tên)');
        $sheet->setCellValue('G' . ($row + 4), '(Ký và ghi rõ họ tên)');
        $sheet->setCellValue('J' . ($row + 4), '(Ký và ghi rõ họ tên)');
        $sheet->mergeCells('B'.($row + 4) . ':C' . ($row + 4));
        $sheet->mergeCells('G'.($row + 4) . ':H' . ($row + 4));
        $sheet->mergeCells('J'.($row + 4) . ':K' . ($row + 4));
        $sheet->getStyle('A' . ($row + 4) . ':M' . ($row + 4))->applyFromArray([
            'font' => [
            'color' => ['rgb' => '000000'],
            'name' => 'Times New Roman',
            'size' => 13,
        ],
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        ],
        ]);

        $fileName = $s3 . $tg . '.xlsx';
        $filePath = public_path('baoCaoXNT/' . $fileName);
        $writer = new Xlsx($spreadsheet);
        $writer->save($filePath);
        return response()->download($filePath, $fileName);

    }

    public function taiXuong($fileName){
        $filePath = public_path('baoCaoXNT/' . $fileName);

        if (!File::exists($filePath)) {
            abort(404);
        }
    
        return response()->download($filePath, $fileName);
    }

    
}