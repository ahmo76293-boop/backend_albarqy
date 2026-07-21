<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [

            [
                'name_en' => 'Beverages',
                'name_ar' => 'المشروبات',
                'description_en' => 'All kinds of beverages.',
                'description_ar' => 'جميع أنواع المشروبات.',
            ],

            [
                'name_en' => 'Snacks',
                'name_ar' => 'الوجبات الخفيفة',
                'description_en' => 'Chips, biscuits and snacks.',
                'description_ar' => 'الشيبس والبسكويت والوجبات الخفيفة.',
            ],

            [
                'name_en' => 'Dairy',
                'name_ar' => 'الألبان',
                'description_en' => 'Milk, cheese and yogurt.',
                'description_ar' => 'الحليب والجبن والزبادي.',
            ],

            [
                'name_en' => 'Frozen Foods',
                'name_ar' => 'المجمدات',
                'description_en' => 'Frozen food products.',
                'description_ar' => 'منتجات الأغذية المجمدة.',
            ],

            [
                'name_en' => 'Cleaning Products',
                'name_ar' => 'مواد التنظيف',
                'description_en' => 'Home cleaning products.',
                'description_ar' => 'منتجات تنظيف المنزل.',
            ],

        ];

        foreach ($categories as $category) {

            Category::create([

                'name_en' => $category['name_en'],

                'name_ar' => $category['name_ar'],

                'slug' => Str::slug($category['name_en']),

                'description_en' => $category['description_en'],

                'description_ar' => $category['description_ar'],

                'image' => null,

                'status' => true,

            ]);
        }
    }
}
