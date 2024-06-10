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
            $tongXuat = $item->sum(5);
            $tongTon = $item->sum(6);

            $tenDanhMuc = $danhMuc->firstWhere('MaDanhMuc', $maDanhMuc)->TenDanhMuc;
            return [$tenDanhMuc => [
                'tongNhap' => $tongNhap,
                'tongXuat' => $tongXuat,
                'tongTon' => $tongTon,
            ]];
        });
        
        
        $page = 10;
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
        }
        


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
                'maDanhMuc' => $sanPham->MaDanhMuc,
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
        $user = Session::get('user');

        $tgDau = $request->input('tgDau');

        $tg = date_format(date_create($tgDau), 'm_Y');
        
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Báo cáo xuất nhập tồn');

        
        $sheet->setCellValue('A2', 'Tên người lập: ' . $user['TenTaiKhoan']);
        $sheet->setCellValue('D2', 'Thời gian:  ' . $tg);

        $sheet->getColumnDimension('A')->setWidth(10);
        $sheet->getColumnDimension('B')->setWidth(40);
        $sheet->getColumnDimension('C')->setWidth(10);
        $sheet->getColumnDimension('D')->setWidth(10);
        $sheet->getColumnDimension('E')->setWidth(10); 
        $sheet->getColumnDimension('F')->setWidth(10); 
        $sheet->getColumnDimension('G')->setWidth(10); 

        $sheet->setCellValue('A3', 'Mã sản phẩm')
              ->setCellValue('B3', 'Tên sản phẩm')
              ->setCellValue('C3', 'Mã danh mục')
              ->setCellValue('D3', 'Tồn đầu kỳ')
              ->setCellValue('E3', 'Số lượng nhập')
              ->setCellValue('F3', 'Số lượng xuất')
              ->setCellValue('G3', 'Tồn cuối kỳ');
        $row = 4;
        foreach ($data as $item) {
            $sltd = $item['soLuongSP'] + $item['tongSLXuat'] - $item['tongSLNhap'];
            $sheet->setCellValue('A' . $row, $item['maSanPham'])
                  ->setCellValue('B' . $row, $item['tenSanPham'])
                  ->setCellValue('C' . $row, $item['maDanhMuc'])
                  ->setCellValue('D' . $row, $sltd)
                  ->setCellValue('E' . $row, $item['tongSLNhap'])
                  ->setCellValue('F' . $row, $item['tongSLXuat'])
                  ->setCellValue('G' . $row, $item['soLuongSP']);
            $row++;
        }
        $sheet->setCellValue('A' . $row, 'Nguời xác nhận (giám đốc)');
        $sheet->setCellValue('A' . ($row + 1), '(Ký và ghi rõ họ tên)');
        $sheet->setCellValue('D' . $row, 'Nguời lập');
        $sheet->setCellValue('D' . ($row + 1), '(Ký và ghi rõ họ tên)');

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