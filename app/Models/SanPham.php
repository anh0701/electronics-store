<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'TenSanPham', 'SlugSanPham', 'MaThuongHieu', 'MaDanhMuc', 'MaNhaCungCap',
        'HinhAnh', 'TrangThai', 'MoTa', 'SoLuongHienTai', 'SoLuongBan', 'SoLuongTrongKho',
        'GiaSanPham', 'ThoiGianTao', 'ThoiGianSua'
    ];
    protected $primaryKey = 'MaSanPham';
    protected $table = 'tbl_sanpham';

    public function DanhMuc(){
        return $this->belongsTo(DanhMuc::class, 'MaDanhMuc');
    }

    public function ThuongHieu(){
        return $this->belongsTo(ThuongHieu::class, 'MaThuongHieu');
    }
}
