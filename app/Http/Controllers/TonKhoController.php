<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use App\Models\BaoCaoDoanhThu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TonKhoController extends Controller
{
    public function lietKe(){

        $dataTK = DB::table('tbl_sanpham')
                ->orderByDesc('tbl_sanpham.SoLuongTrongKho')
                ->paginate(10);

        $dataDM = DB::table('tbl_sanpham')
                ->join('tbl_danhmuc', 'tbl_danhmuc.MaDanhMuc', '=', 'tbl_sanpham.MaDanhMuc')
                ->select('tbl_danhmuc.MaDanhMuc', 'tbl_danhmuc.TenDanhMuc', 
                DB::raw('SUM(tbl_sanpham.SoLuongTrongKho) as tongSLTK'))
                ->groupBy('tbl_danhmuc.MaDanhMuc')
                ->orderByDesc('tongSLTK');

        $labels = $dataDM ->pluck('TenDanhMuc');
        
        $data = $dataDM ->pluck('tongSLTK');
//        dd($data);
//        dd($labels);
        return view('admin.TonKho.lietKeTK', compact('data', 'labels', 'dataTK' ));
    }

    public function filter_by_date(Request $request){
        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];

        $get = BaoCaoDoanhThu::whereBetween('order_date', [$from_date, $to_date])->orderBy('order_date', 'ASC')->get();
        foreach($get as $key => $value){
            $chart_data[] = array(
                'period' => $value->order_date,
                'order' => $value->total_order,
                'sales' => $value->sales,
                'profit' => $value->profit,
                'quantity' => $value->quantity,
            );
        }
        echo $data = json_encode($chart_data);
    }

    public function dashboard_filter(Request $request){
        $data = $request->all();
        
        $dauThangNay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dauThangTruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $BaThangTruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth(3)->startOfMonth()->toDateString();
        $cuoiThangTruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
        $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
        $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        if($data['dashboard_value'] == '7ngay'){
            $get = BaoCaoDoanhThu::whereBetween('order_date', [$sub7days, $now])->orderBy('order_date', 'ASC')->get();
        }elseif($data['dashboard_value'] == 'thangtruoc'){
            $get = BaoCaoDoanhThu::whereBetween('order_date', [$dauThangTruoc, $cuoiThangTruoc])->orderBy('order_date', 'ASC')->get();
        }elseif($data['dashboard_value'] == 'thangnay'){
            $get = BaoCaoDoanhThu::whereBetween('order_date', [$dauThangNay, $now])->orderBy('order_date', 'ASC')->get();
        }elseif($data['dashboard_value'] == '365ngayqua'){
            $get = BaoCaoDoanhThu::whereBetween('order_date', [$sub365days, $now])->orderBy('order_date', 'ASC')->get();
        }elseif($data['dashboard_value'] == '3thangtruoc'){
            $get = BaoCaoDoanhThu::whereBetween('order_date', [$BaThangTruoc, $now])->orderBy('order_date', 'ASC')->get();
        }

        foreach($get as $key => $value){
            $chart_data[] = array(
                'period' => $value->order_date,
                'order' => $value->total_order,
                'sales' => $value->sales,
                'profit' => $value->profit,
                'quantity' => $value->quantity,
            );
        }
        echo $data = json_encode($chart_data);
    }

    public function days_order(){
        $sub30days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(30)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        $get = BaoCaoDoanhThu::whereBetween('order_date', [$sub30days, $now])->orderBy('order_date', 'ASC')->get();
        foreach($get as $key => $value){
            $chart_data[] = array(
                'period' => $value->order_date,
                'order' => $value->total_order,
                'sales' => $value->sales,
                'profit' => $value->profit,
                'quantity' => $value->quantity,
            );
        }
        echo $data = json_encode($chart_data);
    }

    public function TrangLietKeBCDT(){
        $baoCaoDoanhThu = BaoCaoDoanhThu::orderBy('MaBCDT', 'DESC')->paginate(20);
        return view('admin.BaoCaoDoanhThu.TrangLietKeBCDT')->with(compact('baoCaoDoanhThu'));
    }

}
