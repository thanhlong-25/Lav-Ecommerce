<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    public $timeStamps = false;
    protected $primaryKey = 'visitor_id';
    protected $table = 'tbl_visitor';

    protected $fillable = [
        'visitor_ip', 
        'visitor_date',
    ];
}
