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
        'payment_method',
        'coupon_code',
        'order_total',
        'order_status',
        'order_finishdate'
    ];

    
    public function customer(){
        return $this->belongsTo('App\Models\UserCustomer', 'customer_id');
    }
}
