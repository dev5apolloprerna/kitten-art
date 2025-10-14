<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Model;



class Image extends Model

{

    public $table = 'image';



    protected $primaryKey = 'image_id'; // Define the primary key
    public $timestamps = false; // Disable timestamps
    protected $fillable = ['image_id', 'image'];

}





