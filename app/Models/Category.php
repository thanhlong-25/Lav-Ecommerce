<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timeStamps = false;
    protected $primaryKey = 'cate_id';
    protected $table = 'tbl_category';

    protected $fillable = [
        'cate_name', 
        'cate_slug',
        'cate_status',
    ];
}
