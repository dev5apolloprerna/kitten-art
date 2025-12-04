<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Model;



class PaymentMode extends Model

{

    public $table = 'payment_mode';
    protected $primaryKey = 'id'; // Define the primary key

        

    protected $fillable = ['id', 'type'];

}





