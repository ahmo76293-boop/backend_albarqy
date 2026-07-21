<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Location\StoreLocationRequest;
use App\Http\Requests\Location\UpdateLocationRequest;
use App\Http\Resources\LocationResource;
use App\Models\Location;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display all locations for the authenticated user.
     */
    public function index(Request $request)
    {
        if ($request->boolean('paginate', true)) {
            $locations = auth()->user()
                ->locations()
                ->latest()
                ->paginate(10);
        } else {
            $locations = auth()->user()
                ->locations()
                ->latest()
                ->get();
        }

        return LocationResource::collection($locations);
    }

    /**
     * Store a newly created location.
     */
    public function store(StoreLocationRequest $request)
    {
        DB::beginTransaction();

        try {

            if ($request->boolean('is_default')) {
                auth()->user()
                    ->locations()
                    ->update(['is_default' => false]);
            }

            $location = auth()->user()->locations()->create([
                'title' => $request->title,
                'address' => $request->address,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'is_default' => $request->boolean('is_default'),
            ]);

            DB::commit();

            return response()->json([
                'message' => __('location.created'),
                'data' => new LocationResource($location),
            ], 201);
        } catch (\Throwable $e) {

            DB::rollBack();

            return response()->json([
                'message' => __('location.create_failed'),
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display a specific location.
     */
    public function show(Location $location)
    {
        abort_if($location->user_id !== auth()->id(), 403);

        return new LocationResource($location);
    }

    /**
     * Update the specified location.
     */
    public function update(UpdateLocationRequest $request, Location $location)
    {
        abort_if($location->user_id !== auth()->id(), 403);

        DB::beginTransaction();

        try {

            if ($request->boolean('is_default')) {
                auth()->user()
                    ->locations()
                    ->update(['is_default' => false]);
            }

            $location->update([
                'title' => $request->title,
                'address' => $request->address,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'is_default' => $request->boolean('is_default', $location->is_default),
            ]);

            DB::commit();

            return response()->json([
                'message' => __('location.updated'),
                'data' => new LocationResource($location->fresh()),
            ]);
        } catch (\Throwable $e) {

            DB::rollBack();

            return response()->json([
                'message' => __('location.update_failed'),
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified location.
     */
    public function destroy(Location $location)
    {
        abort_if($location->user_id !== auth()->id(), 403);

        $location->delete();

        return response()->json([
            'message' => __('location.deleted'),
        ]);
    }
}
