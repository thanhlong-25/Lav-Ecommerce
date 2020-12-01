<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City_Province extends Model
{
    public $timeStamps = false;
    protected $primaryKey = 'city_id';
    protected $table = 'tbl_city_province';

    protected $fillable = [
        'city_name', 
        'type',
    ];
}
