<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubDistrict extends Model
{
    public $timeStamps = false;
    protected $primaryKey = 'subdistrict_id';
    protected $table = 'tbl_subdistrict';

    protected $fillable = [
        'subdistrict_name', 
        'type',
        'district_id',
    ];
}
