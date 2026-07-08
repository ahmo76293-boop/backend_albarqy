<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Location\StoreLocationRequest;
use App\Http\Requests\Location\UpdateLocationRequest;
use App\Http\Resources\LocationResource;
use App\Models\Location;
use Illuminate\Support\Facades\DB;

class AdminLocationController extends Controller
{
    /**
     * Display all locations.
     */
    public function index()
    {
        $locations = Location::with('user')
            ->latest()
            ->paginate(10);

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
                Location::where('user_id', $request->user_id)
                    ->update(['is_default' => false]);
            }

            $location = Location::create([
                'user_id' => $request->user_id,

                'title' => $request->title,
                'address' => $request->address,

                'latitude' => $request->latitude,
                'longitude' => $request->longitude,

                'is_default' => $request->boolean('is_default'),
            ]);

            DB::commit();

            return response()->json([
                'message' => __('location.created'),
                'data' => new LocationResource($location->load('user')),
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
     * Display the specified location.
     */
    public function show(Location $locations_admin)
    {
        return new LocationResource(
            $locations_admin->load('user')
        );
    }

    /**
     * Update the specified location.
     */
    public function update(UpdateLocationRequest $request, Location $locations_admin)
    {
        try {

            if ($request->boolean('is_default')) {
                Location::where('user_id', $locations_admin->user_id)
                    ->update(['is_default' => false]);
            }

            $locations_admin->update([
                'title' => $request->title,
                'address' => $request->address,

                'latitude' => $request->latitude,
                'longitude' => $request->longitude,

                'is_default' => $request->boolean('is_default', $locations_admin->is_default),
            ]);

            return response()->json([
                'message' => __('location.updated'),
                'data' => new LocationResource($locations_admin->fresh()->load('user')),
            ]);
        } catch (\Throwable $e) {

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
        $location->delete();

        return response()->json([
            'message' => __('location.deleted'),
        ]);
    }
}
