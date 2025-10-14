<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    public $table = 'batch_master';


    protected $dates = [
        'created_at',
        'updated_at',
     
    ];
    protected $primaryKey = 'batch_id'; // Define the primary key
        
    protected $fillable = ['batch_id', 'category_id', 'batch_name','batch_day', 'batch_to_time','batch_from_time'];
}


