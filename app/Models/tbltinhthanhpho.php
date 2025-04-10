<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tbltinhthanhpho extends Model
{
    protected $table = 'tbl_tinhthanhpho'; // Specify the table name
    protected $primaryKey = 'matp'; // Set primary key column
    public $incrementing = false; // If MaKH is not auto-incrementing
    protected $keyType = 'string'; // If MaKH is a string (change to 'int' if it's an integer)
    public $timestamps = false;
    protected $fillable = [
        'name_city',
        'type'
    ];
}
