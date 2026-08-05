<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Jobs\CompressCategoryImage;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name_en', 'like', "%{$search}%")
                    ->orWhere('name_ar', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->boolean('status'));
        }

        $query->latest();

        if ($request->boolean('paginate', true)) {
            $categories = $query->paginate(
                $request->integer('per_page', 10)
            );
        } else {
            $categories = $query->get();
        }

        return CategoryResource::collection($categories);
    }

    public function store(StoreCategoryRequest $request)
    {
        $image = null;

        if ($request->hasFile('image')) {

            $image = $request->file('image')
                ->store('categories', 'public');
        }

        $category = Category::create([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,

            'slug' => Str::slug($request->name_en),

            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,

            'image' => $image,

            'status' => $request->boolean('status', true),
        ]);

        if ($image) {
            CompressCategoryImage::dispatch($image);
        }

        return response()->json([
            'message' => __('category.created'),
            'data' => new CategoryResource($category),
        ], 201);
    }

    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        if ($request->hasFile('image')) {

            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }

            $category->image = $request->file('image')
                ->store('categories', 'public');
        }

        $category->update([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,

            'slug' => Str::slug($request->name_en),

            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,

            'status' => $request->boolean('status', $category->status),
        ]);

        $category->save();

        return response()->json([
            'message' => __('category.updated'),
            'data' => new CategoryResource($category->fresh()),
        ]);
    }

    public function destroy(Category $category)
    {
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return response()->json([
            'message' => __('category.deleted'),
        ]);
    }
}
