<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $table = 'category_master';
   
    protected $primaryKey = 'category_id'; // Define the primary key

    protected $dates = [
        'created_at',
        'updated_at',
     
    ];

    protected $fillable = ['category_id', 'category_name'];
}


