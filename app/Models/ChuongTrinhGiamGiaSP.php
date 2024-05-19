<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChuongTrinhGiamGiaSP extends Model
{
    use HasFactory;
    protected $primaryKey = 'MaCTGGSP';
    protected $fillable = ['MaSanPham', 'MaCTGG', 'PhanTramGiam'];
    protected $table = 'tbl_chuongtrinhgiamgiasp';
    public $timestamps = false;
    public function product()
    {
        return $this->belongsTo(SanPham::class, 'MaSanPham', 'MaSanPham');
    }

    public function discountProgram()
    {
        return $this->belongsTo(ChuongTrinhGiamGia::class, 'MaCTGG', 'MaCTGG');
    }
}
