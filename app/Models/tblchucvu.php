<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tblchucvu extends Model
{
    protected $table = 'tblchucvu'; // Specify the table name
    protected $primaryKey = 'MaCV'; // Set primary key column
    public $incrementing = false; // If MaKH is not auto-incrementing
    protected $keyType = 'string'; // If MaKH is a string (change to 'int' if it's an integer)
    public $timestamps = false;
    protected $fillable = [
        'MaCV',
        'TenCV',
        'MaPB'
    ]; // Define mass-assignable fields

    // Define relationship to PhongBan
    public function phongban()
    {
        // This tells Laravel that 'MaPB' in this model references the 'MaPB' in the PhongBan model.
        return $this->belongsTo(tblphongban::class, 'MaPB', 'MaPB');
    }
    // Define the relationship between ChucVu and NhanVien
    public function nhanviens()
    {
        return $this->hasMany(tblnhanvien::class, 'MaCV', 'MaCV');
    }
}
