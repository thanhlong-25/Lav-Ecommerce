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
        'product_views'
    ];

    public function comment(){
        return $this->hasMany('App\Models\Comment');
    }

    public function rating(){
        return $this->hasMany('App\Models\Rating');
    }

    public function brand(){
        return $this->belongsTo('App\Models\Brand', 'brand_id');
    } // cơ bản là để thay thế câu lệnh join kiểu Product::join('tbl_brand', 'tbl_brand.brand_id' ,'=', 'tbl_product.brand_id')

    public function category(){
        return $this->belongsTo('App\Models\Category', 'cate_id');
    }
}
