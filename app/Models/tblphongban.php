<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tblphongban extends Model
{
    protected $table = 'tblphongban'; // Specify the table name
    protected $primaryKey = 'MaPB'; // Set primary key column
    public $incrementing = false; // If MaKH is not auto-incrementing
    protected $keyType = 'string'; // If MaKH is a string (change to 'int' if it's an integer)
    public $timestamps = false;
    protected $fillable = [
        'MaPB',
        'TenPB'
    ];
    // Define the inverse of the relationship (One-to-Many)
    public function chucvus()
    {
        return $this->hasMany(tblchucvu::class, 'MaPB', 'MaPB');
    }
    public function nhanviens()
    {
        return $this->hasMany(tblnhanvien::class, 'MaPB', 'MaPB');
    }
}
