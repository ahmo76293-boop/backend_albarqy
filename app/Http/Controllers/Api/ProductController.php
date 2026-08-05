<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Jobs\CompressProductImage;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::with([
            'category',
            'images',
            'units',
            'productUnits.offers' => function ($query) {
                $query->where('is_active', true)
                    ->whereDate('start_date', '<=', now())
                    ->whereDate('end_date', '>=', now());
            },
        ]);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name_en', 'like', "%{$search}%")
                    ->orWhere('name_ar', 'like', "%{$search}%")
                    ->orWhere('barcode', 'like', "%{$search}%")
                    ->orWhere('unique_number', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->boolean('status'));
        }

        $query->latest();

        if ($request->boolean('paginate', true)) {
            $products = $query->paginate(
                $request->integer('per_page', 10)
            );
        } else {
            $products = $query->get();
        }

        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        DB::beginTransaction();

        try {

            $product = Product::create([
                'category_id' => $request->category_id,

                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,

                'unique_number' => $request->unique_number,
                'barcode' => $request->barcode,

                'description_en' => $request->description_en,
                'description_ar' => $request->description_ar,

                'status' => $request->boolean('status', true),
            ]);

            // Images
            if ($request->hasFile('images')) {

                foreach ($request->file('images') as $image) {

                    $path = $image->store('products', 'public');

                    ProductImage::create([
                        'product_id' => $product->id,
                        'image' => $path,
                    ]);

                    CompressProductImage::dispatch($path);
                }
            }

            // Units
            $units = [];

            foreach ($request->units as $unit) {

                $units[$unit['unit_id']] = [
                    'quantity' => $unit['quantity'],
                    'price' => $unit['price'],
                ];
            }

            $product->units()->sync($units);

            DB::commit();

            return response()->json([
                'message' => __('product.created'),
                'data' => new ProductResource(
                    $product->load('category', 'images', 'units')
                ),
            ], 201);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load([
            'category',
            'images',
            'units'
        ]);

        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        DB::beginTransaction();

        try {

            // Replace old images if new ones are uploaded
            if ($request->hasFile('images')) {

                // Delete old image files
                foreach ($product->images as $oldImage) {
                    Storage::disk('public')->delete($oldImage->image);
                }

                // Delete old image records
                $product->images()->delete();

                // Upload new images
                foreach ($request->file('images') as $image) {

                    $path = $image->store('products', 'public');

                    $product->images()->create([
                        'image' => $path,
                    ]);

                    CompressProductImage::dispatch($path);
                }
            }

            $product->update([

                'category_id' => $request->category_id,

                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,

                'unique_number' => $request->unique_number,
                'barcode' => $request->barcode,

                'description_en' => $request->description_en,
                'description_ar' => $request->description_ar,

                'status' => $request->boolean('status', $product->status),
            ]);

            $units = [];

            foreach ($request->units as $unit) {

                $units[$unit['unit_id']] = [
                    'quantity' => $unit['quantity'],
                    'price' => $unit['price'],
                ];
            }

            $product->units()->sync($units);

            DB::commit();

            return response()->json([
                'message' => __('product.updated'),
                'data' => new ProductResource(
                    $product->fresh()->load('category', 'images', 'units')
                ),
            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        foreach ($product->images as $image) {

            Storage::disk('public')->delete($image->image);
        }

        $product->delete();

        return response()->json([
            'message' => __('product.deleted'),
        ]);
    }

    public function productsByCategory(Request $request, Category $category)
    {
        $query = $category->products()->with([
            'category',
            'images',
            'productUnits.unit',
            'productUnits.offers',
        ]);

        $query->latest();

        if ($request->boolean('paginate', true)) {
            $products = $query->paginate(
                $request->integer('per_page', 10)
            );
        } else {
            $products = $query->get();
        }

        return ProductResource::collection($products);
    }
}
