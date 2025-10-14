<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Model;



class StudentSubscription extends Model

{

    public $table = 'student_subscription';

    protected $dates = [

        'created_at',

        'updated_at',

     

    ];



    protected $primaryKey = 'subscription_id'; // Define the primary key



    protected $fillable = ['subscription_id', 'student_id', 'plan_id', 'total_session', 'amount', 'activate_date', 'expired_date', 'expired_date', 'created_at'];

}





