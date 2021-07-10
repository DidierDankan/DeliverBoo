<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $orders = [
            [
                'amount' => rand(20,34),
                'customer_name' => 'raimundo',
                'customer_surname' => 'browser',
                'customer_address' => 'viale giulio cesare 35',
                'customer_mail' => 'cicco@hotmail.com',
                'customer_phone' => '3713999654',
                'customer_city' => 'rome',
                'customer_zip_code' => '00132',
                'restaurant_id' => rand(1,2),
            ],
            [
                'amount' => rand(20,34),
                'customer_name' => 'cristian',
                'customer_surname' => 'due',
                'customer_address' => 'via amilcare cucchini 12',
                'customer_mail' => 'loremo@hotmail.com',
                'customer_phone' => '3713999648',
                'customer_city' => 'rome',
                'customer_zip_code' => '00122',
                'restaurant_id' => rand(1,2),
            ],
            
        ];

        foreach($orders as $order) {
            $new_order = new Order();

            $new_order->amount = $order['amount'];
            $new_order->customer_name = $order['customer_name'];
            $new_order->customer_surname = $order['customer_surname'];
            $new_order->customer_address = $order['customer_address'];
            $new_order->customer_mail = $order['customer_mail'];
            $new_order->customer_phone = $order['customer_phone'];
            $new_order->customer_city = $order['customer_city'];
            $new_order->customer_zip_code = $order['customer_zip_code'];
            $new_order->restaurant_id = $order['restaurant_id'];

            $new_order->save();
        }
    }
}

