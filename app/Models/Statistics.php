<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistics extends Model
{
    public $timeStamps = false;
    protected $primaryKey = 'stat_id';
    protected $table = 'tbl_statistics';

    protected $fillable = [
        'stat_date', 
        'stat_sales',
        'stat_profit',
        'stat_quantities',
        'total_orders'
    ];
}
