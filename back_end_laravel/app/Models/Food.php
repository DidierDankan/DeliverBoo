<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $table = 'foods';

    protected $fillable = [
        'title',
        'price',
        'description',
        'type',
        'ingredients',
        'visibility',
        'restaurant_id'
    ];

    public function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }

    public function orders(){
        return $this->belongsToMany(Order::class);
    }
}
