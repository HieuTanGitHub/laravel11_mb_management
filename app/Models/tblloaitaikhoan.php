<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tblloaitaikhoan extends Model
{
    protected $table = 'tblloaitaikhoan'; // Specify the table name
    protected $primaryKey = 'MaLoaiTK'; // Set primary key column
    public $incrementing = false; // If MaKH is not auto-incrementing
    protected $keyType = 'string'; // If MaKH is a string (change to 'int' if it's an integer)
    public $timestamps = false;
    protected $fillable = [
        'MaLoaiTK',
        'TenLoaiTK'
    ];
}
