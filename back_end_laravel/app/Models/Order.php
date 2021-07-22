<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    public function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }

    public function foods(){
        return $this->belongsToMany(Food::class);
    }
}
