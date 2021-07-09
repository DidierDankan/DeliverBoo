<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Food;

use Faker\Generator as Faker;

class FoodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        //populating with faker data need to delete after

        for ($i = 0; $i < 15; $i++){
            $new_food = new Food();

            $faker = \Faker\Factory::create();
            $faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($faker));

            $new_food->title = $faker->foodName();
            $new_food->price = rand(10,20);
            $new_food->type = 'food';
            $new_food->description = $faker->text();
            $new_food->ingredients = $faker->vegetableName(). ' ' . $faker->vegetableName(). ' ' . $faker->vegetableName(). ' ' . $faker->vegetableName();
            // $new_food->restaurant_id = rand(1,4);

            $new_food->save();
        }
    }
}
