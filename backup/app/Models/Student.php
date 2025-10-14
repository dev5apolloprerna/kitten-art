<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;use Illuminate\Notifications\Notifiable;

use Spatie\Permission\Traits\HasRoles;

class Student extends Authenticatable
{
        use  Notifiable, HasRoles;

    public $table = 'student_master';
    protected $dates = [
        'created_at',
        'updated_at',
     
    ];

    protected $primaryKey = 'student_id'; // Define the primary key

    protected $fillable = ['student_id', 'student_first_name','student_last_name', 'student_age', 'mobile', 'email', 'parent_name', 'category_id', 'plan_id', 'batch_id', 'login_id', 'password', 'isWaiting', 'isRegister', 'isPaid', 'communication_mode'];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->name}";
    }
}


