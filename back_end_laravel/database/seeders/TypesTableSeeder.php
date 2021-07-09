<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;


class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['Italiano', 'Pizzeria', 'Cinese', 'Giapponese', 'Vegetariano', 'Messicano', 'Hawaiano', 'Americano', 'Indiano', 'Brasiliano', 'Thailandese'];

        foreach ($types as $type) {
            $new_type = new Type();

            $new_type->type = $type;
           

            $new_type->save(); }
    }
}
