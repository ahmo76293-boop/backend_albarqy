<?php

namespace Database\Seeders;

use App\Models\OrderItem;
use Illuminate\Database\Seeder;

class OrderItemSeeder extends Seeder
{
    public function run(): void
    {
        $items = [

            // Order 1

            [
                'order_id' => 1,
                'product_id' => 1,
                'unit_id' => 1,
                'quantity' => 20,
                'price' => 3.50,
                'total' => 70.00,
            ],

            [
                'order_id' => 1,
                'product_id' => 4,
                'unit_id' => 1,
                'quantity' => 10,
                'price' => 5.00,
                'total' => 50.00,
            ],

            [
                'order_id' => 1,
                'product_id' => 5,
                'unit_id' => 9,
                'quantity' => 3,
                'price' => 8.00,
                'total' => 24.00,
            ],

            // Order 2

            [
                'order_id' => 2,
                'product_id' => 2,
                'unit_id' => 3,
                'quantity' => 1,
                'price' => 78.00,
                'total' => 78.00,
            ],

            [
                'order_id' => 2,
                'product_id' => 3,
                'unit_id' => 1,
                'quantity' => 4,
                'price' => 3.00,
                'total' => 12.00,
            ],

        ];

        foreach ($items as $item) {
            OrderItem::create($item);
        }
    }
}
