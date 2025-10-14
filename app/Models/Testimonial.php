<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    public $table = 'testimonial';

    protected $primaryKey = 'testimonial_id'; // Define the primary key

    public $timestamps = false; // Disable timestamps

    protected $fillable = ['testimonial_id', 'parent_name', 'parent_photo', 'student_name', 'student_photo', 'description', 'status'];
}


