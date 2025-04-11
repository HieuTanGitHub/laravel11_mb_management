<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tblguitien extends Model
{
    protected $table = 'tblguitien'; // Specify the table name
    protected $primaryKey = 'MaGDGuiTien'; // Set primary key column
    public $incrementing = false; // If MaKH is not auto-incrementing
    protected $keyType = 'string'; // If MaKH is a string (change to 'int' if it's an integer)
    public $timestamps = false;
    protected $fillable = [
        'MaGDGuiTien',
        'SoTienGui',
        'PhiGiaoDich',
        'SoDuSauGui',
        'NoiDung',
        'ViTri',
        'NgayTao',
        'MaNV',
        'SoTK',
        'TenNG',
        'SDTNG',
        'TongTien',
        'NganHang'

    ];
}
