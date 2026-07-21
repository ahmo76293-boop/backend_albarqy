<?php

namespace Database\Seeders;

use App\Models\ProductUnit;
use Illuminate\Database\Seeder;

class ProductUnitSeeder extends Seeder
{
    public function run(): void
    {
        $units = [

            // Pepsi
            [
                'product_id' => 1,
                'unit_id' => 1, // Piece
                'quantity' => 1,
                'price' => 3.50,
            ],
            [
                'product_id' => 1,
                'unit_id' => 3, // Carton
                'quantity' => 24,
                'price' => 78,
            ],

            // Coca Cola
            [
                'product_id' => 2,
                'unit_id' => 1,
                'quantity' => 1,
                'price' => 3.50,
            ],
            [
                'product_id' => 2,
                'unit_id' => 3,
                'quantity' => 24,
                'price' => 78,
            ],

            // 7Up
            [
                'product_id' => 3,
                'unit_id' => 1,
                'quantity' => 1,
                'price' => 3.25,
            ],
            [
                'product_id' => 3,
                'unit_id' => 3,
                'quantity' => 24,
                'price' => 74,
            ],

            // Lays
            [
                'product_id' => 4,
                'unit_id' => 1,
                'quantity' => 1,
                'price' => 5,
            ],
            [
                'product_id' => 4,
                'unit_id' => 2, // Box
                'quantity' => 20,
                'price' => 90,
            ],

            // Milk
            [
                'product_id' => 5,
                'unit_id' => 9, // Bottle
                'quantity' => 1,
                'price' => 8,
            ],
            [
                'product_id' => 5,
                'unit_id' => 3, // Carton
                'quantity' => 12,
                'price' => 90,
            ],

        ];

        foreach ($units as $unit) {
            ProductUnit::create($unit);
        }
    }
}
