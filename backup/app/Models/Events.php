<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    public $table = 'event_master';
   
    protected $primaryKey = 'event_id'; // Define the primary key

    protected $dates = [
        'created_at',
        'updated_at',
     
    ];

    protected $fillable = ['event_id', 'event_name', 'category_id', 'capacity', 'Instructors', 'discounts', 'location', 'detail_description', 'to_date', 'from_date', 'to_time', 'from_time', 'image', 'created_at', 'updated_at'];
}


