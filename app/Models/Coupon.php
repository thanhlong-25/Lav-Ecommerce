<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    public $timeStamps = false;
    protected $primaryKey = 'coupon_id';
    protected $table = 'tbl_coupon';

    protected $fillable = [
        'coupon_name', 
        'coupon_code',
        'coupon_qty',
        'coupon_mode', 
        'coupon_value',
        'max_promote_value'
    ];
}
