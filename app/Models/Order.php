<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timeStamps = false;
    protected $primaryKey = 'order_id';
    protected $table = 'tbl_order';

    protected $fillable = [
        'customer_id', 
        'shipping_id',
        'payment_method',
        'coupon_code',
        'order_total',
        'order_status',
    ];

    
    public function customer(){
        return $this->belongsTo('App\Models\UserCustomer', 'customer_id');
    }

    public function shipping(){
        return $this->belongsTo('App\Models\Shipping', 'shipping_id');
    }
}
