<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'amount','status','customer_name','customer_surname','customer_address','customer_mail','customer_phone','customer_city','customer_zip_code'
    ];

    public function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }

    public function foods(){
        return $this->belongsToMany(Food::class);
    }
}
