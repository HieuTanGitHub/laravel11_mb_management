<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tblphuongxa extends Model
{
    protected $table = 'tbl_xaphuongthitran'; // Specify the table name
    protected $primaryKey = 'xaid'; // Set primary key column
    public $incrementing = false; // If MaKH is not auto-incrementing
    protected $keyType = 'string'; // If MaKH is a string (change to 'int' if it's an integer)
    public $timestamps = false;
    protected $fillable = [
        'name_xaphuong',
        'type',
        'maqh'
    ];
}
