<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    public $timeStamps = false;
    protected $primaryKey = 'rating_id';
    protected $table = 'tbl_rating';

    protected $fillable = [
        'product_id',
        'customer_id', 
        'rating_value',
    ];
}
