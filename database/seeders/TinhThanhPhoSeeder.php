<?php

namespace Database\Seeders;

use App\Models\TinhThanhPho;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
class TinhThanhPhoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $json = File::get("database/data/tbl_tinhthanhpho.json");
        $tinhThanhPhos = json_decode($json, true);

        DB::table('tbl_tinhthanhpho')->insert($tinhThanhPhos);

//        foreach ($tinhThanhPhos as $tinhThanhPho){
//            TinhThanhPho::firstOrCreate(
//                ['MaThanhPho' => $tinhThanhPho['MaThanhPho']], // Điều kiện để kiểm tra
//                $tinhThanhPhos // Dữ liệu để chèn nếu không tồn tại
//            );
//        }

    }
}
