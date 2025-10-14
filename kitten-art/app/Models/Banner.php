<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    public $table = 'banner';
        protected $primaryKey = 'bannerId'; // Define the primary key

    protected $fillable = [
        'bannerId', 'image', 'iStatus', 'isDelete', 'created_at', 'updated_at'
    ];
}
