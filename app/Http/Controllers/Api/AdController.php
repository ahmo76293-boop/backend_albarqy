<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ad\StoreAdRequest;
use App\Http\Requests\Ad\UpdateAdRequest;
use App\Http\Resources\AdResource;
use App\Jobs\CompressAdImage;
use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $ads = Ad::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;

            $ads->where(function ($query) use ($search) {
                $query->where('title_en', 'like', "%{$search}%")
                    ->orWhere('title_ar', 'like', "%{$search}%")
                    ->orWhere('description_en', 'like', "%{$search}%")
                    ->orWhere('description_ar', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->has('is_active')) {
            $ads->where('is_active', $request->boolean('is_active'));
        }

        $ads->latest();

        if ($request->boolean('paginate', true)) {
            $ads = $ads->paginate(10);
        } else {
            $ads = $ads->get();
        }

        return AdResource::collection($ads);
    }

    /**
     * Store a newly created resource.
     */
    public function store(StoreAdRequest $request)
    {
        DB::beginTransaction();

        try {

            $image = $request->file('image')
                ->store('ads', 'public');

            CompressAdImage::dispatch($image);

            $ad = Ad::create([

                'title_en' => $request->title_en,

                'title_ar' => $request->title_ar,

                'description_en' => $request->description_en,

                'description_ar' => $request->description_ar,

                'image' => $image,

                'url' => $request->url,

                'is_active' => $request->boolean('is_active'),
            ]);

            DB::commit();

            return response()->json([
                'message' => __('ad.created'),
                'data' => new AdResource($ad),
            ], 201);
        } catch (\Throwable $e) {

            DB::rollBack();

            return response()->json([
                'message' => __('ad.create_failed'),
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $ad = Ad::findOrFail($id);

        return new AdResource($ad);
    }

    /**
     * Update the specified resource.
     */
    public function update(UpdateAdRequest $request, $id)
    {
        DB::beginTransaction();

        try {

            $ad = Ad::findOrFail($id);

            if ($request->hasFile('image')) {

                if ($ad->image && Storage::disk('public')->exists($ad->image)) {
                    Storage::disk('public')->delete($ad->image);
                }

                $image = $ad->image = $request->file('image')
                    ->store('ads', 'public');

                CompressAdImage::dispatch($image);
            }

            $ad->title_en = $request->title_en;
            $ad->title_ar = $request->title_ar;

            $ad->description_en = $request->description_en;
            $ad->description_ar = $request->description_ar;

            $ad->url = $request->url;

            if ($request->has('is_active')) {
                $ad->is_active = $request->boolean('is_active');
            }

            $ad->save();

            DB::commit();

            return response()->json([
                'message' => __('ad.updated'),
                'data' => new AdResource($ad),
            ]);
        } catch (\Throwable $e) {

            DB::rollBack();

            return response()->json([
                'message' => __('ad.update_failed'),
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource.
     */
    public function destroy($id)
    {
        try {

            $ad = Ad::findOrFail($id);

            if ($ad->image && Storage::disk('public')->exists($ad->image)) {
                Storage::disk('public')->delete($ad->image);
            }

            $ad->delete();

            return response()->json([
                'message' => __('ad.deleted'),
            ]);
        } catch (\Throwable $e) {

            return response()->json([
                'message' => __('ad.delete_failed'),
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
