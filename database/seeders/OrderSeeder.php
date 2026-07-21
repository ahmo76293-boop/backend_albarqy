<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $orders = [

            [
                'user_id' => 2,
                'location_id' => 1,
                'order_number' => 'ORD-100001',
                'subtotal' => 148.00,
                'delivery_fee' => 10.00,
                'discount' => 8.00,
                'total' => 150.00,
                'payment_method' => 'cash',
                'payment_status' => 'pending',
                'status' => 'pending',
                'notes' => 'Please call before delivery.',
            ],

            [
                'user_id' => 2,
                'location_id' => 1,
                'order_number' => 'ORD-100002',
                'subtotal' => 90.00,
                'delivery_fee' => 5.00,
                'discount' => 0.00,
                'total' => 95.00,
                'payment_method' => 'card',
                'payment_status' => 'paid',
                'status' => 'delivered',
                'notes' => null,
            ],

        ];

        foreach ($orders as $order) {
            Order::create($order);
        }
    }
}
