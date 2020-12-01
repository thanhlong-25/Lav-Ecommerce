<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    public $timeStamps = false;
    protected $primaryKey = 'banner_id';
    protected $table = 'tbl_banner';

    protected $fillable = [
        'banner_name', 
        'banner_status',
        'banner_image',
    ];
}
