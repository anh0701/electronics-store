<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TaiKhoan extends Model
{
    use HasFactory;
    
    protected $table = 'tbl_taikhoan';
    public $timestamps = false;
    protected $primaryKey = 'MaTaiKhoan';
}
