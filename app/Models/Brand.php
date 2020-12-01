<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public $timeStamps = false;
    protected $primaryKey = 'brand_id';
    protected $table = 'tbl_brand';

    protected $fillable = [
        'brand_name', 
        'brand_description',
        'brand_status',
    ];
}
