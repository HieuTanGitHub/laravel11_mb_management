<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tblloaithe extends Model
{
    protected $table = 'tblloaithe'; // Specify the table name
    protected $primaryKey = 'MaLoaiThe'; // Set primary key column
    public $incrementing = false; // If MaKH is not auto-incrementing
    protected $keyType = 'string'; // If MaKH is a string (change to 'int' if it's an integer)
    public $timestamps = false;
    protected $fillable = [
        'MaLoaiThe',
        'TenLoaiThe'
    ];

    public function taiKhoans()
    {
        return $this->hasMany(tbltaikhoan::class, 'MaLoaiThe', 'MaLoaiThe');
    }
}
