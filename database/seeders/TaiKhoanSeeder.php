<?php

namespace Database\Seeders;

use App\Models\TaiKhoan;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaiKhoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $taiKhoans = [
            [
                'MaTaiKhoan' => 'TK' . date('YmdHis'),
                'Email' => 'test@gmail.com',
                'TenTaiKhoan' => 'test',
                'TenNguoiDung' => null,
                'DiaChi' => null,
                'SoDienThoai' => null,
                'MatKhau' => bcrypt('test'),
                'HinhAnh' => null,
                'TrangThai' => '1',
                'BacNguoiDung' => null,
                'ThoiGianTao' => Carbon::now(),
                'ThoiGianSua' => null,
                'Quyen' => 'Quản trị viên cấp cao',
                'Pin' => null,
            ],
        ];

        DB::table('tbl_taikhoan')->insert($taiKhoans);

//        foreach ($taiKhoan as $tk){
//            TaiKhoan::firstOrCreate(
//                ['Email' => $tk['Email']], // Điều kiện để kiểm tra
//                $tk // Dữ liệu để chèn nếu không tồn tại
//            );
//        }

    }
}
