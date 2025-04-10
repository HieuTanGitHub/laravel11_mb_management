<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tblloaihoatdong extends Model
{
    protected $table = 'tblloaihoatdong'; // Specify the table name
    protected $primaryKey = 'MaLoaiHD'; // Set primary key column
    public $incrementing = false; // If MaKH is not auto-incrementing
    protected $keyType = 'string'; // If MaKH is a string (change to 'int' if it's an integer)
    public $timestamps = false;
    protected $fillable = [
        'MaLoaiHD',
        'TenLoaiHD',
        'MoTa'
    ];
}
