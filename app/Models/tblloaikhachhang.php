<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tblloaikhachhang extends Model
{
    protected $table = 'tblloaikhachhang'; // Specify the table name
    protected $primaryKey = 'MaLoaiKH'; // Set primary key column
    public $incrementing = false; // If MaKH is not auto-incrementing
    protected $keyType = 'string'; // If MaKH is a string (change to 'int' if it's an integer)
    public $timestamps = false;
    protected $fillable = [
        'MaLoaiKH',
        'TenLoaiKH',
        'MoTa'
    ]; // Define mass-assignable fields
}
