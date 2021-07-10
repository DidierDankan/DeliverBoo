<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->float('amount', 5,2);
            $table->boolean('status')->default(false);
            $table->string('customer_name', 50);
            $table->string('customer_surname', 50);
            $table->string('customer_address');
            $table->string('customer_mail');
            $table->string('customer_phone', 20);
            $table->string('customer_city', 50);
            $table->string('customer_zip_code', 10);

            $table->unsignedBigInteger('restaurant_id')->nullable();

            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('set null');

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
        Schema::dropIfExists('orders');
    }
}
