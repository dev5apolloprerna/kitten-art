<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public $table = 'home_page';

    protected $primaryKey = 'id'; // Define the primary key
    public $timestamps = false; // Disable timestamps

    protected $fillable = ['id', 'name', 'description'];
}


