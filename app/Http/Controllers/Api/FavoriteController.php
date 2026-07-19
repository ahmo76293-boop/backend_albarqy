<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Favorite\StoreFavoriteRequest;
use App\Http\Resources\FavoriteResource;
use App\Models\Favorite;
use Illuminate\Support\Facades\DB;

class FavoriteController extends Controller
{
    /**
     * Display all favorite products for the authenticated user.
     */
    public function index()
    {
        $favorites = Favorite::with([
            'product.category',
            'product.images',
            'product.units',
        ])
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return FavoriteResource::collection($favorites);
    }

    /**
     * Add a product to favorites.
     */
    public function store(StoreFavoriteRequest $request)
    {
        DB::beginTransaction();

        try {

            $favorite = Favorite::firstOrCreate([
                'user_id' => auth()->id(),
                'product_id' => $request->product_id,
            ]);

            DB::commit();

            return response()->json([
                'message' => __('favorite.created'),
                'data' => new FavoriteResource(
                    $favorite->load(
                        'product.category',
                        'product.images',
                        'product.units'
                    )
                ),
            ], 201);
        } catch (\Throwable $e) {

            DB::rollBack();

            return response()->json([
                'message' => __('favorite.create_failed'),
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display a specific favorite.
     */
    public function show($id)
    {
        $favorite = Favorite::with([
            'product.category',
            'product.images',
            'product.units',
        ])
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        return new FavoriteResource($favorite);
    }

    /**
     * Favorites cannot be updated.
     */
    public function update($id)
    {
        return response()->json([
            'message' => __('favorite.update_not_supported'),
        ], 405);
    }

    /**
     * Remove a favorite.
     */
    public function destroy($id)
    {
        try {

            $favorite = Favorite::where('user_id', auth()->id())
                ->findOrFail($id);

            $favorite->delete();

            return response()->json([
                'message' => __('favorite.deleted'),
            ]);
        } catch (\Throwable $e) {

            return response()->json([
                'message' => __('favorite.delete_failed'),
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
