<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    public $timeStamps = false;
    protected $primaryKey = 'gallery_id';
    protected $table = 'tbl_gallery';

    protected $fillable = [
        'gallery_image',
        'product_id',
    ];
}
