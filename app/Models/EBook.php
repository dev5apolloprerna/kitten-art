<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EBook extends Model
{
    public $table = 'ebook_master';

    protected $primaryKey = 'ebook_id'; // Define the primary key

    public $timestamps = false; // Disable timestamps

    protected $fillable = ['ebook_id', 'ebook_name', 'ebook_pdf','ebook_image'];
}


