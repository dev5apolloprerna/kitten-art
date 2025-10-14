<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Role extends Model
{
    use HasFactory;
    public $table = 'roles';
    protected $fillable = [
        'id', 'name', 'guard_name', 'deleted_at', 'created_at', 'updated_at'
    ];

    // public function permissions()
    // {
    //     return $this->belongsToMany(Permission::class);
    // }
}
