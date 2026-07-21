<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [

            [
                'category_id' => 1,
                'name_en' => 'Pepsi',
                'name_ar' => 'بيبسي',
                'unique_number' => 'PRD0001',
                'barcode' => '628100000001',
                'description_en' => 'Pepsi Soft Drink',
                'description_ar' => 'مشروب بيبسي',
            ],

            [
                'category_id' => 1,
                'name_en' => 'Coca Cola',
                'name_ar' => 'كوكاكولا',
                'unique_number' => 'PRD0002',
                'barcode' => '628100000002',
                'description_en' => 'Coca Cola Soft Drink',
                'description_ar' => 'مشروب كوكاكولا',
            ],

            [
                'category_id' => 1,
                'name_en' => '7 Up',
                'name_ar' => 'سفن أب',
                'unique_number' => 'PRD0003',
                'barcode' => '628100000003',
                'description_en' => '7Up Soft Drink',
                'description_ar' => 'مشروب سفن أب',
            ],

            [
                'category_id' => 2,
                'name_en' => 'Lays Chips',
                'name_ar' => 'شيبس ليز',
                'unique_number' => 'PRD0004',
                'barcode' => '628100000004',
                'description_en' => 'Potato Chips',
                'description_ar' => 'شيبس بطاطس',
            ],

            [
                'category_id' => 3,
                'name_en' => 'Fresh Milk',
                'name_ar' => 'حليب طازج',
                'unique_number' => 'PRD0005',
                'barcode' => '628100000005',
                'description_en' => 'Fresh Milk 1L',
                'description_ar' => 'حليب طازج 1 لتر',
            ],

        ];

        foreach ($products as $product) {

            Product::create([
                ...$product,
                'status' => true,
            ]);
        }
    }
}
