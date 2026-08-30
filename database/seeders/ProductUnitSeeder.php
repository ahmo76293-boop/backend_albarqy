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
                'barcode' => '628100000001',
                'price' => 3.50,
            ],
            [
                'product_id' => 1,
                'unit_id' => 3, // Carton
                'quantity' => 24,
                'barcode' => '628100000002',
                'price' => 78,
            ],

            // Coca Cola
            [
                'product_id' => 2,
                'unit_id' => 1, // Piece
                'quantity' => 1,
                'barcode' => '628100000003',
                'price' => 3.50,
            ],
            [
                'product_id' => 2,
                'unit_id' => 3, // Carton
                'quantity' => 24,
                'barcode' => '628100000004',
                'price' => 78,
            ],

            // 7Up
            [
                'product_id' => 3,
                'unit_id' => 1, // Piece
                'quantity' => 1,
                'barcode' => '628100000005',
                'price' => 3.25,
            ],
            [
                'product_id' => 3,
                'unit_id' => 3, // Carton
                'quantity' => 24,
                'barcode' => '628100000006',
                'price' => 74,
            ],

            // Lays
            [
                'product_id' => 4,
                'unit_id' => 1, // Piece
                'quantity' => 1,
                'barcode' => '628100000007',
                'price' => 5.00,
            ],
            [
                'product_id' => 4,
                'unit_id' => 2, // Box
                'quantity' => 20,
                'barcode' => '628100000008',
                'price' => 90.00,
            ],

            // Milk
            [
                'product_id' => 5,
                'unit_id' => 9, // Bottle
                'quantity' => 1,
                'barcode' => '628100000009',
                'price' => 8.00,
            ],
            [
                'product_id' => 5,
                'unit_id' => 3, // Carton
                'quantity' => 12,
                'barcode' => '628100000010',
                'price' => 90.00,
            ],
        ];

        foreach ($units as $unit) {
            ProductUnit::create($unit);
        }
    }
}
