<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tblnhanvien extends Model
{
    protected $table = 'tblnhanvien'; // Specify the table name
    protected $primaryKey = 'MaNV'; // Set primary key column
    public $incrementing = false; // If MaKH is not auto-incrementing
    protected $keyType = 'string'; // If MaKH is a string (change to 'int' if it's an integer)
    public $timestamps = false;
    protected $fillable = [
        'MaNV',
        'HoTen',
        'SDT',
        'TenDangNhap',
        'MatKhau',
        'Email',
        'PhanQuyen',
        'MaPB',
        'MaCV'

    ];
    // Define the relationship between NhanVien and PhongBan
    public function phongban()
    {
        return $this->belongsTo(tblphongban::class, 'MaPB', 'MaPB');
    }

    // Define the relationship between NhanVien and ChucVu
    public function chucvu()
    {
        return $this->belongsTo(tblchucvu::class, 'MaCV', 'MaCV');
    }
    public function taiKhoans()
    {
        return $this->hasMany(tbltaikhoan::class, 'MaNV', 'MaNV');
    }
}
