<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tblruttien extends Model
{
    protected $table = 'tblruttien'; // Specify the table name
    protected $primaryKey = 'MaGDRutTien'; // Set primary key column
    public $incrementing = false; // If MaKH is not auto-incrementing
    protected $keyType = 'string'; // If MaKH is a string (change to 'int' if it's an integer)
    public $timestamps = false;
    protected $fillable = [
        'MaGDRutTien',
        'SoTienRut',
        'PhiGiaoDich',
        'SoDuSauRut',
        'NoiDung',
        'ViTri',
        'NgayTao',
        'MaNV',
        'SoTK'
    ];
}
