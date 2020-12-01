<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingCost extends Model
{
    public $timeStamps = false;
    protected $primaryKey = 'shippingcost_id';
    protected $table = 'tbl_shippingcost';

    protected $fillable = [
        'city_id', 
        'district_id',
        'subdistrict_id',
        'cost',
    ];

    public function city(){
        return $this->belongsTo('App\Models\City_Province', 'city_id');
    }

    public function district(){
        return $this->belongsTo('App\Models\District', 'district_id');
    }

    public function subdistrict(){
        return $this->belongsTo('App\Models\SubDistrict', 'subdistrict_id');
    }
}
