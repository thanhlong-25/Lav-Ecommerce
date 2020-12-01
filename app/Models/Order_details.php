<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_details extends Model
{
    public $timeStamps = false;
    protected $primaryKey = 'order_detail_id';
    protected $table = 'tbl_order_details';

    protected $fillable = [
        'order_id', 
        'product_id',
        'product_sale_quantity',
    ];

    public function product(){
        return $this->belongsTo('App\Models\Order', 'product_id');
    }
}