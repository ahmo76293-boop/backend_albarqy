<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductUnit;
use App\Models\Unit;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows): void
    {
        DB::beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | Group products
            |--------------------------------------------------------------------------
            */

            $products = $rows->groupBy('رقم الصنف');

            foreach ($products as $productNumber => $productRows) {

                $firstRow = $productRows->first();

                /*
                |--------------------------------------------------------------------------
                | Find Category
                |--------------------------------------------------------------------------
                */

                $category = Category::where(
                    'name_ar',
                    trim($firstRow['القسم'])
                )
                    ->orWhere(
                        'name_en',
                        trim($firstRow['القسم'])
                    )
                    ->first();

                if (!$category) {
                    throw new \Exception(
                        "القسم غير موجود: {$firstRow['القسم']}"
                    );
                }

                /*
                |--------------------------------------------------------------------------
                | Create / Update Product
                |--------------------------------------------------------------------------
                */

                $product = Product::updateOrCreate(
                    [
                        'unique_number' => (string) $productNumber,
                    ],
                    [
                        'category_id' => $category->id,

                        'name_en' => trim($firstRow['اسم الصنف']),

                        'name_ar' => trim($firstRow['اسم الصنف']),

                        'unique_number' => (string) $productNumber,

                        'description_en' => null,

                        'description_ar' => null,

                        'status' => true,
                    ]
                );

                /*
                |--------------------------------------------------------------------------
                | Product Units
                |--------------------------------------------------------------------------
                */

                foreach ($productRows as $row) {

                    /*
                    |--------------------------------------------------------------------------
                    | Find Unit
                    |--------------------------------------------------------------------------
                    */

                    $unit = Unit::where(
                        'name_ar',
                        trim($row['الوحدة'])
                    )
                        ->orWhere(
                            'name_en',
                            trim($row['الوحدة'])
                        )
                        ->first();

                    if (!$unit) {
                        throw new \Exception(
                            "الوحدة غير موجودة: {$row['الوحدة']}"
                        );
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | Barcode
                    |--------------------------------------------------------------------------
                    */

                    $barcode = trim(
                        (string) $row['الباركود']
                    );

                    if (!$barcode) {
                        throw new \Exception(
                            "الباركود مطلوب للصنف: {$productNumber}"
                        );
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | Create / Update Product Unit
                    |--------------------------------------------------------------------------
                    */

                    ProductUnit::updateOrCreate(
                        [
                            'product_id' => $product->id,

                            'unit_id' => $unit->id,
                        ],
                        [
                            'quantity' => (int) $row['العبوة'],

                            'barcode' => $barcode,

                            'price' => (float) $row['السعر الاول'],
                        ]
                    );
                }
            }

            DB::commit();
        } catch (\Throwable $e) {

            DB::rollBack();

            throw $e;
        }
    }
}
