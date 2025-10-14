<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;
    
    public $table = 'inquiry';
    
    protected $primaryKey='inquiry_id';

    protected $fillable = [
       'inquiry_id', 'name', 'mobileNumber', 'email', 'message', 'subject', 'strIp'
    ];
}
