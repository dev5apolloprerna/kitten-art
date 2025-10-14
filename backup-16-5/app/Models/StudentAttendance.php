<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Model;



class StudentAttendance extends Model

{

    public $table = 'student_attendance';

    



    protected $primaryKey = 'attendence_id'; // Define the primary key



    protected $fillable = ['attendence_id', 'sattendanceid', 'student_id', 'attendance', 'subscription_id', 'plan_id', 'batch_id', 'day'];

}





