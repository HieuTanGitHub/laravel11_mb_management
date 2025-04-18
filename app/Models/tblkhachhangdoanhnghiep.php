<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tblkhachhangdoanhnghiep extends Model
{
    protected $table = 'tblkhachhangdoanhnghiep'; // Specify the table name
    protected $primaryKey = 'MaKH'; // Set primary key column
    public $incrementing = false; // If MaKH is not auto-incrementing
    protected $keyType = 'string'; // If MaKH is a string (change to 'int' if it's an integer)
    public $timestamps = false;
    protected $fillable = [
        'MaKH',
        'TenDN',
        'NgayThanhLap',
        'MaSoThue',
        'TenDaiDienPL',
        'ChucVu',
        'TenKeToan',
        'TenDaiDienPL',
        'CCCDKT',
        'EmailKT',
        'VonDieuLe',
        'DiaChiDN',
        'HoSoDN',
        'NgayTao',
        'NguoiTao'

    ];
}
