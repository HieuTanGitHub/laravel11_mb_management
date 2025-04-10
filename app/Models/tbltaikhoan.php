<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tbltaikhoan extends Model
{
    protected $table = 'tbltaikhoan'; // Specify the table name
    protected $primaryKey = 'SoTK'; // Set primary key column
    public $incrementing = false; // If MaKH is not auto-incrementing
    protected $keyType = 'string'; // If MaKH is a string (change to 'int' if it's an integer)
    public $timestamps = false;
    protected $fillable = [
        'SoTK',
        'SoDuTK',
        'NgayMo',
        'NgayDong',
        'TrangThai',
        'MaLoaiThe',
        'MaNV',
        'MaKH',
        'NgayTao'
    ];
    protected $casts = [
        'TrangThai' => 'boolean',
    ];

    // Quan hệ với loại thẻ
    public function loaiThe()
    {
        return $this->belongsTo(tblloaithe::class, 'MaLoaiThe', 'MaLoaiThe');
    }

    // Quan hệ với nhân viên
    public function nhanVien()
    {
        return $this->belongsTo(tblnhanvien::class, 'MaNV', 'MaNV');
    }

    // Quan hệ với khách hàng
    public function khachHang()
    {
        return $this->belongsTo(tblkhachhang::class, 'MaKH', 'MaKH');
    }
}
