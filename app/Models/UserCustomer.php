<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCustomer extends Model
{
    public $timeStamps = false;
    protected $primaryKey = 'customer_id';
    protected $table = 'tbl_usercustomer';

    protected $fillable = [
        'customer_name', 
        'customer_email',
        'customer_password',
        'customer_phone',
    ];
}
