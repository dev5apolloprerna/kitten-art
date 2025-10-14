<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    public $table = 'gallery_master';
    protected $dates = [
        'created_at',
        'updated_at',
     
    ];

    protected $primaryKey = 'gallery_id'; // Define the primary key

    protected $fillable = ['gallery_id', 'image', 'comment'];
}


