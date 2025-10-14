<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public $table = 'permissions';
    protected $dates = [
        'created_at',
        'updated_at',
     
    ];

    protected $fillable = ['id', 'name', 'guard_name', 'created_at', 'updated_at'];
}


