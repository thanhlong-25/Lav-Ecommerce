<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public $timeStamps = false;
    protected $primaryKey = 'district_id';
    protected $table = 'tbl_district';

    protected $fillable = [
        'district_name', 
        'type',
        'city_id',
    ];
}
