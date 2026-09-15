<?php

namespace App\Http\Controllers;

use App\Http\Requests\IntegrationProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IntegrationProductController extends Controller
{
    public function store(IntegrationProductRequest $request)
    {
        DB::beginTransaction();

        try {

            /*
        |--------------------------------------------------------------------------
        | Find Category
        |--------------------------------------------------------------------------
        */

            $categoryName = trim($request->category);

            $category = Category::query()
                ->where(function ($query) use ($categoryName) {
                    $query->where('name_en', $categoryName)
                        ->orWhere('name_ar', $categoryName);
                })
                ->first();

            if (!$category) {
                DB::rollBack();

                return response()->json([
                    'message' => 'Category not found.',
                    'category' => $categoryName,
                ], 422);
            }

            /*
        |--------------------------------------------------------------------------
        | Create Product
        |--------------------------------------------------------------------------
        */

            $product = Product::create([
                'category_id' => $category->id,
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
                'unique_number' => $request->unique_number,
                'description_en' => $request->description_en,
                'description_ar' => $request->description_ar,
                'status' => $request->boolean('status', true),
            ]);

            /*
        |--------------------------------------------------------------------------
        | Find Units
        |--------------------------------------------------------------------------
        */

            $units = [];

            foreach ($request->units as $index => $unitData) {

                $unitName = trim($unitData['unit']);

                $unit = Unit::query()
                    ->where(function ($query) use ($unitName) {
                        $query->where('name_en', $unitName)
                            ->orWhere('name_ar', $unitName);
                    })
                    ->first();

                if (!$unit) {

                    DB::rollBack();

                    return response()->json([
                        'message' => 'Unit not found.',
                        'unit' => $unitName,
                        'index' => $index,
                    ], 422);
                }

                $units[$unit->id] = [
                    'quantity' => $unitData['quantity'],
                    'barcode' => $unitData['barcode'],
                    'price' => $unitData['price'],
                ];
            }

            /*
        |--------------------------------------------------------------------------
        | Attach Product Units
        |--------------------------------------------------------------------------
        */

            $product->units()->sync($units);

            DB::commit();

            /*
        |--------------------------------------------------------------------------
        | Response
        |--------------------------------------------------------------------------
        */

            return response()->json([
                'message' => 'Product uploaded successfully.',

                'data' => new ProductResource(
                    $product->fresh()->load([
                        'category',
                        'images',
                        'productUnits.unit',
                        'productUnits.offers.giftProductUnit.product',
                        'productUnits.offers.giftProductUnit.unit',
                    ])
                ),

            ], 201);
        } catch (\Throwable $e) {

            DB::rollBack();

            return response()->json([
                'message' => 'Failed to upload product.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
