<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    public $timeStamps = false;
    protected $primaryKey = 'admin_id';
    protected $table = 'tbl_admin';

    protected $fillable = [
        'admin_email', 
        'admin_password',
        'admin_name',
        'admin_phone',
    ];

    public function roles(){
        return $this->belongsToMany('App\Models\Admin');
    }

    public function getAuthPassword()
    {
        return $this->admin_password;
    }
}
