<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = [

            [
                'name_en' => 'Piece',
                'name_ar' => 'حبة',
                'symbol' => 'pcs',
            ],

            [
                'name_en' => 'Box',
                'name_ar' => 'علبة',
                'symbol' => 'box',
            ],

            [
                'name_en' => 'Carton',
                'name_ar' => 'كرتون',
                'symbol' => 'ctn',
            ],

            [
                'name_en' => 'Pack',
                'name_ar' => 'باكيت',
                'symbol' => 'pack',
            ],

            [
                'name_en' => 'Kilogram',
                'name_ar' => 'كيلوجرام',
                'symbol' => 'kg',
            ],

            [
                'name_en' => 'Gram',
                'name_ar' => 'جرام',
                'symbol' => 'g',
            ],

            [
                'name_en' => 'Liter',
                'name_ar' => 'لتر',
                'symbol' => 'L',
            ],

            [
                'name_en' => 'Milliliter',
                'name_ar' => 'ملليلتر',
                'symbol' => 'ml',
            ],

            [
                'name_en' => 'Bottle',
                'name_ar' => 'زجاجة',
                'symbol' => 'btl',
            ],

            [
                'name_en' => 'Can',
                'name_ar' => 'علبة معدنية',
                'symbol' => 'can',
            ],

            [
                'name_en' => 'Bag',
                'name_ar' => 'كيس',
                'symbol' => 'bag',
            ],

            [
                'name_en' => 'Bundle',
                'name_ar' => 'ربطة',
                'symbol' => 'bdl',
            ],

        ];

        foreach ($units as $unit) {

            Unit::create([
                'name_en' => $unit['name_en'],
                'name_ar' => $unit['name_ar'],
                'symbol' => $unit['symbol'],
                'status' => true,
            ]);
        }
    }
}
