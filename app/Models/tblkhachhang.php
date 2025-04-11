<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tblkhachhang extends Model
{
    protected $table = 'tblkhachhang'; // Specify the table name
    protected $primaryKey = 'MaKH'; // Set primary key column
    public $incrementing = false; // If MaKH is not auto-incrementing
    protected $keyType = 'string'; // If MaKH is a string (change to 'int' if it's an integer)
    public $timestamps = false;
    protected $fillable = [
        'MaKH',
        'TenKH',
        'SDT',
        'CCCD',
        'Email',
        'DiaChi',
        'NgaySinh',
        'MaLoaiKH',
        'SoTK',
        'MaLoaiTK',
        'TheCung',
        'LoaiThe',
        'SoThe'
    ]; // Define mass-assignable fields
    public function taiKhoans()
    {
        return $this->hasMany(tbltaikhoan::class, 'MaKH', 'MaKH');
    }
    public function khachhangs()
    {
        return $this->hasOne(tblkhachhangcanhan::class, 'MaKH');
    }
}
