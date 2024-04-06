<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TaiKhoan extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'TenTaiKhoan', 'Email', 'HinhAnh', 'SoDienThoai', 'MatKhau', 'ThoiGianTao', 'ThoiGianSua'
    ];
    protected $primaryKey = 'MaTaiKhoan';
    protected $table = 'tbl_taikhoan';

    public function PhanQuyenNguoiDung() {
        return $this->hasMany(PhanQuyenNguoiDung::class);
    }
}
