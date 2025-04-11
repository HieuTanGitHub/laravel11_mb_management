<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class tblthe extends Model
{
    protected $table = 'tblthe'; // Specify the table name
    protected $primaryKey = 'SoThe'; // Set primary key column
    public $incrementing = false; // If MaKH is not auto-incrementing
    protected $keyType = 'string'; // If MaKH is a string (change to 'int' if it's an integer)
    public $timestamps = false;
    protected $fillable = [
        'SoThe',
        'NgayMo',
        'NgayHetHan',
        'NgayDong',
        'MaLoaiThe',
        'MaNV',
        'MaKH',
        'SoTK',
        'NgayTao'
    ];
    // Quan hệ với loại thẻ
    public function loaiThe()
    {
        return $this->belongsTo(tblloaithe::class, 'MaLoaiThe', 'MaLoaiThe');
    }

    // Quan hệ với nhân viên
    public function nhanvien()
    {
        return $this->belongsTo(tblnhanvien::class, 'MaNV', 'MaNV');
    }

    // Quan hệ với khách hàng
    public function khachhang()
    {
        return $this->belongsTo(tblkhachhang::class, 'MaKH', 'MaKH');
    }
}
