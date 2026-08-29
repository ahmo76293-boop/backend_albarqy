<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAboutUsRequest;
use App\Http\Requests\UpdateAboutUsRequest;
use App\Http\Resources\AboutUsResource;
use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index(Request $request)
    {
        $query = AboutUs::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('title_en', 'like', "%{$search}%")
                    ->orWhere('title_ar', 'like', "%{$search}%")
                    ->orWhere('content_en', 'like', "%{$search}%")
                    ->orWhere('content_ar', 'like', "%{$search}%");
            });
        }

        $query->latest();

        if ($request->boolean('paginate', true)) {
            $aboutUs = $query->paginate(
                $request->integer('per_page', 10)
            );
        } else {
            $aboutUs = $query->get();
        }

        return AboutUsResource::collection($aboutUs);
    }

    public function store(StoreAboutUsRequest $request)
    {
        $aboutUs = AboutUs::create($request->validated());

        return response()->json([
            'message' => __('about_us.created'),
            'data' => new AboutUsResource($aboutUs),
        ], 201);
    }

    public function show($id)
    {
        return new AboutUsResource(
            AboutUs::findOrFail($id)
        );
    }

    public function update(
        UpdateAboutUsRequest $request,
        $id
    ) {
        $aboutUs = AboutUs::findOrFail($id);

        $aboutUs->update($request->validated());

        return response()->json([
            'message' => __('about_us.updated'),
            'data' => new AboutUsResource(
                $aboutUs->fresh()
            ),
        ]);
    }

    public function destroy($id)
    {
        $aboutUs = AboutUs::findOrFail($id);

        $aboutUs->delete();

        return response()->json([
            'message' => __('about_us.deleted'),
        ]);
    }
}
