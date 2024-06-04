<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use App\Models\BaoCaoDoanhThu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function fillter_by_date(Request $request){
        $data = $request->all();
        if($request->ajax()){
            $from_date = $data['from_date'];
            $to_date = $data['to_date'];

            //$get = BaoCaoDoanhThu::whereBetween('order_date', [$from_date, $to_date])->orderBy('order_date', 'ASC')->get();
            $get = BaoCaoDoanhThu::whereBetween('order_date', ['2024-05-01', '2024-06-30'])->orderBy('order_date', 'ASC')->get();
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
            //return view('admin_layout')->with(compact('chart_data'));
        }else{
            return response()->json(['status' => 'fail', 'message' => 'this is not json']);
        }
    }

    public function Test(){
        $get = BaoCaoDoanhThu::whereBetween('order_date', ['2024-05-01', '2024-06-30'])->orderBy('order_date', 'ASC')->get();
        foreach($get as $key => $value){
            $chart_data[] = array(
                'period' => $value->order_date,
                'order' => $value->total_order,
                'sales' => $value->sales,
                'profit' => $value->profit,
                'quantity' => $value->quantity,
            );
        }
        $data = json_encode($chart_data);
        echo '<pre>';
        print_r(json_encode($data));
        echo '</pre>';
    }

}
