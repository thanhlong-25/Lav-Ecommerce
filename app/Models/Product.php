<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timeStamps = false;
    protected $primaryKey = 'product_id';
    protected $table = 'tbl_product';

    protected $fillable = [
        'cate_id', 
        'brand_id',
        'product_name',
        'product_slug',
        'product_description',
        'product_inventory',
        'product_sold',
        'product_price',
        'product_image',
        'product_status',
    ];
}
