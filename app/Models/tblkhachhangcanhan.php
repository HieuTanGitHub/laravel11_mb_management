<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tblkhachhangcanhan extends Model
{
    protected $table = 'tblkhachhangcanhan'; // Specify the table name
    protected $primaryKey = 'MaKH'; // Set primary key column
    public $incrementing = false; // If MaKH is not auto-incrementing
    protected $keyType = 'string'; // If MaKH is a string (change to 'int' if it's an integer)
    public $timestamps = false;
    protected $fillable = [
        'MaKH',
        'NgheNghiep',
        'DoanhThu',
        'HoSoCaNhan',
        'MaNV'
    ];
    public function khach()
    {
        return $this->belongsTo(tblkhachhang::class, 'MaKH', 'MaKH');
    }
}
