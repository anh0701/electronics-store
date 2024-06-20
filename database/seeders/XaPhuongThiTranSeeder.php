<?php

namespace Database\Seeders;

use App\Models\XaPhuongThiTran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
class XaPhuongThiTranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $json = File::get("database/data/tbl_xaphuongthitran.json");
        $xaPhuongThiTrans = json_decode($json, true);

        DB::table('tbl_xaphuongthitran')->insert($xaPhuongThiTrans);

//        foreach ($xaPhuongThiTrans as $xaPhuongThiTran){
//            XaPhuongThiTran::firstOrCreate(
//                ['MaXaPhuong' => $xaPhuongThiTran['MaXaPhuong']], // Điều kiện để kiểm tra
//                $xaPhuongThiTran // Dữ liệu để chèn nếu không tồn tại
//            );
//        }
    }
}
