<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    public $timeStamps = false;
    protected $primaryKey = 'admin_id';
    protected $table = 'tbl_admin';

    protected $fillable = [
        'admin_email', 
        'admin_password',
    ];
}
