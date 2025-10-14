<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceImages extends Model
{
    public $table = 'service_images';

    protected $primaryKey = 'service_image_id'; // Define the primary key

    public $timestamps = false; // Disable timestamps


    protected $fillable = ['service_image_id', 'service_id', 'image'];
}


