<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThuongHieuThuocDanhMuc extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'MaThuongHieu', 'MaDanhMuc'
    ];
    protected $primaryKey = 'MaTHDM';
    protected $table = 'tbl_thuonghieuthuocdm';

    public function DanhMuc()
    {
        return $this->belongsTo(DanhMuc::class, 'MaDanhMuc');
    }

    public function ThuongHieu(){
        return $this->belongsTo(ThuongHieu::class, 'MaThuongHieu');
    }
}
