<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFoodOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('food_order', function (Blueprint $table) {


            $table->tinyInteger('quantity');
            $table->timestamps();


        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('food_order', function (Blueprint $table) {


            $table->dropColumn('quantity');
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');



        });
    }
}
