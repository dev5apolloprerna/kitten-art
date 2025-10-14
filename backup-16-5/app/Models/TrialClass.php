<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Model;



class TrialClass extends Model

{

    public $table = 'trial_master';

    protected $dates = [

        'created_at',

        'updated_at',

     

    ];



    protected $primaryKey = 'trialclass_student_id'; // Define the primary key



    protected $fillable = ['trialclass_student_id', 'student_first_name', 'student_last_name','student_age', 'mobile', 'email', 'parent_name', 'category_id','no_of_reminder_sent', 'status'];

}





