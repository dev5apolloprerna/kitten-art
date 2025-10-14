<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    public $table = 'plan_master';
    protected $dates = [
        'created_at',
        'updated_at',
     
    ];

    protected $primaryKey = 'planId'; // Define the primary key

    protected $fillable = ['planId', 'category_id', 'plan_name', 'plan_session', 'plan_amount', 'plan_image', 'plan_description'];
}


