<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;



class StudentSubscription extends Model

{

    public $table = 'student_subscription';

    protected $dates = [

        'created_at',

        'updated_at',

     

    ];



    protected $primaryKey = 'subscription_id'; // Define the primary key



    protected $fillable = ['subscription_id', 'student_id', 'plan_id', 'total_session', 'amount', 'activate_date', 'expired_date', 'expired_date', 'payment_mode','payment_date','created_at'];

    public function ledger()
    {
        return $this->hasMany(StudentLedger::class, 'subscription_id', 'subscription_id');
    }

    public function getPlanNameAttribute()
    {
        return DB::table('plan_master')->where('planId', $this->plan_id)->value('plan_name');
    }

    public function getBatchNameAttribute()
    {
        return DB::table('batch_master')->where('batch_id', $this->batch_id)->value('batch_name');
    }


}





