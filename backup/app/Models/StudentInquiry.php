<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentInquiry extends Model
{
    public $table = 'student_inquiry_master';

    protected $primaryKey = 'student_inquiry_id'; // Define the primary key

    public $timestamps = false; // Disable timestamps

    protected $fillable = ['student_inquiry_id', 'student_first_name','student_last_name', 'student_age', 'mobile', 'email', 'parent_name', 'plan_id', 'batch_id', 'communication_mode', 'status','category_id'];
}


