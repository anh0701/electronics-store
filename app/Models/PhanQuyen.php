<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhanQuyen extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'TenPhanQuyen'
    ];
    protected $primaryKey = 'MaPhanQuyen';
    protected $table = 'tbl_phanquyen';

    public function PhanQuyenNguoiDung(){
        return $this->hasMany(PhanQuyenNguoiDung::class, 'MaPhanQuyen', 'MaTaiKhoan');
    }

    public function TaiKhoan(){
        return $this->belongsToMany(TaiKhoan::class);
    }
}
