<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FoodOrder;

class FoodOrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i = 0; $i < 5; $i++){
            $new_correlation = new FoodOrder();


            $new_correlation->order_id = 1;
            $new_correlation->food_id = 3;


            $new_correlation->save();
        }
    }
}
