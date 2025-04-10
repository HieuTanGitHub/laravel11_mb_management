<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tblquanhuyen extends Model
{
    protected $table = 'tbl_quanhuyen'; // Specify the table name
    protected $primaryKey = 'maqh'; // Set primary key column
    public $incrementing = false; // If MaKH is not auto-incrementing
    protected $keyType = 'string'; // If MaKH is a string (change to 'int' if it's an integer)
    public $timestamps = false;
    protected $fillable = [
        'name_quanhuyen',
        'type',
        'matp'
    ];
}
