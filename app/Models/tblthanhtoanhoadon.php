<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tblthanhtoanhoadon extends Model
{
    protected $table = 'tblthanhtoanhoadon'; // Specify the table name
    protected $primaryKey = 'MaGDThanhToan'; // Set primary key column
    public $incrementing = false; // If MaKH is not auto-incrementing
    protected $keyType = 'string'; // If MaKH is a string (change to 'int' if it's an integer)
    public $timestamps = false;
    protected $fillable = [
        'MaGDThanhToan',
        'NgayTao',
        'PhiGiaoDich',
        'TongTien',
        'SoHD',
        'NganHang',
        'SoTienThanhToan',
        'NCC',
        'LoaiHD',
        'SoDuSauThanhToan',
        'NoiDung',
        'DiemGD',
        'NgayTao',
        'MaNV',
        'SoTK'
    ];
}
