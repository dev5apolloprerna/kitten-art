<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentAttendanceMaster extends Model
{
    public $table = 'student_attendance_master';
    
    protected $dates = [
        'created_at',
        'updated_at',
     
    ];

    protected $primaryKey = 'sattendanceid'; // Define the primary key
    public $incrementing = true; // Ensure incrementing is enabled

    protected $fillable = ['attendance_date', 'batch_id'];
}


