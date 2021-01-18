<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $timeStamps = false;
    protected $primaryKey = 'comment_id';
    protected $table = 'tbl_comment';

    protected $fillable = [
        'comment_content', 
        'customer_id',
        'product_id',
    ];

    public function customer(){
        return $this->belongsTo('App\Models\UserCustomer', 'customer_id');
    }

    public function product(){
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}
