<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Renewplan extends Model
{
    public $table = 'student_renew_plan';


    protected $dates = [
        'created_at',
        'updated_at',
     
    ];
    protected $primaryKey = 'renewplan_id'; // Define the primary key
    public $timestamps = false; // Disable timestamps
        
    protected $fillable = ['renewplan_id', 'student_id', 'category_id', 'plan_id','batch_id','amount', 'plan_session', 'status'];
}


