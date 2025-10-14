<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentLedger extends Model
{
    public $table = 'student_ledger';
    
    protected $dates = [
        'created_at',
        'updated_at',
     
    ];

    protected $primaryKey = 'ledger_id'; // Define the primary key

    protected $fillable = ['ledger_id', 'attendence_id', 'attendence_detail_id', 'student_id', 'subscription_id', 'opening_balance', 'credit_balance', 'debit_balance', 'closing_balance'];
}


