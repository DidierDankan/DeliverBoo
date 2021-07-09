<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Seeder;

class RestaurantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $restaurants = [
            [
                'name' => 'Napoli 1820 Pizzeria - Milano',
                'address' => 'Alzaia Naviglio Grande, 62',
                'city' => 'Milano',
                'zip_code' => '20144',
                'user_id' => rand(1, 4),

            ],
            [
                'name' => 'Pizza Am',
                'address' => 'Corso di Porta Romana, 83',
                'city' => 'Milano',
                'zip_code' => '20122',
                'user_id' => rand(1, 4),

            ],
            [
                'name' => 'VUN Andrea Aprea',
                'address' => 'Via Silvio Pellico, 3',
                'city' => 'Milano',
                'zip_code' => '20121',
                'user_id' => rand(1, 4),

            ],
            [
                'name' => 'Primè - Ristorante Milano',
                'address' => 'Viale Francesco Crispi, 2',
                'city' => 'Milano',
                'zip_code' => '20121',
                'user_id' => rand(1, 4),

            ],
        ];

        foreach ($restaurants as $restaurants) {
            $new_restaurant = new Restaurant();
            $new_restaurant->name = $restaurants['name'];
            $new_restaurant->address = $restaurants['address']; 
            $new_restaurant->city = $restaurants['city'];
            $new_restaurant->zip_code = $restaurants['zip_code']; 
            $new_restaurant->user_id = $restaurants['user_id']; 

            $new_restaurant->save();
        }

        
    }
}
