<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public $table = 'service_master';

    protected $primaryKey = 'service_id'; // Define the primary key

    protected $fillable = ['service_id', 'service_name', 'image', 'description'];
}


