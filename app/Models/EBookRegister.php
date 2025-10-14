<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EBookRegister extends Model
{
    public $table = 'ebook_registration';

    protected $primaryKey = 'ebook_registration_id'; // Define the primary key

    public $timestamps = false; // Disable timestamps

    protected $fillable = ['ebook_id', 'name','email','mobile'];
}


