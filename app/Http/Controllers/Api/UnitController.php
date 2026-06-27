<?php

namespace App\Http\Controllers\Api;

use App\Models\Unit;
use App\Http\Controllers\Controller;
use App\Http\Requests\Unit\StoreUnitRequest;
use App\Http\Requests\Unit\UpdateUnitRequest;
use App\Http\Resources\UnitResource;

class UnitController extends Controller
{
    public function index()
    {
        return UnitResource::collection(
            Unit::latest()->paginate(10)
        );
    }

    public function store(StoreUnitRequest $request)
    {
        $unit = Unit::create([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'symbol' => $request->symbol,
            'status' => $request->boolean('status', true),
        ]);

        return response()->json([
            'message' => __('unit.created'),
            'data' => new UnitResource($unit),
        ], 201);
    }

    public function show(Unit $unit)
    {
        return new UnitResource($unit);
    }

    public function update(UpdateUnitRequest $request, Unit $unit)
    {
        $unit->update([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'symbol' => $request->symbol,
            'status' => $request->boolean('status', $unit->status),
        ]);

        return response()->json([
            'message' => __('unit.updated'),
            'data' => new UnitResource($unit),
        ]);
    }

    public function destroy(Unit $unit)
    {
        $unit->delete();

        return response()->json([
            'message' => __('unit.deleted'),
        ]);
    }
}
