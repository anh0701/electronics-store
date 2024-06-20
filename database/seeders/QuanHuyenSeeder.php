<?php

namespace Database\Seeders;

use App\Models\QuanHuyen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class QuanHuyenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $json = File::get("database/data/tbl_quanhuyen.json");
        $quanHuyens = json_decode($json, true);

        DB::table('tbl_quanhuyen')->insert($quanHuyens);

//        foreach ($quanHuyens as $quanHuyen){
//            QuanHuyen::firstOrCreate(
//                ['MaQuanHuyen' => $quanHuyen['MaQuanHuyen']], // Điều kiện để kiểm tra
//                $quanHuyen // Dữ liệu để chèn nếu không tồn tại
//            );
//        }

    }
}
