<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    public $timeStamps = false;
    protected $primaryKey = 'role_id';
    protected $table = 'tbl_roles';

    protected $fillable = [
        'name_role', 
    ];

    public function admin(){
        return $this->belongsToMany('App\Models\UserCustomer');
    }
}
