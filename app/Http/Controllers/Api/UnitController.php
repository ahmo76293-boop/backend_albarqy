<?php

namespace App\Http\Controllers\Api;

use App\Models\Unit;
use App\Http\Controllers\Controller;
use App\Http\Requests\Unit\StoreUnitRequest;
use App\Http\Requests\Unit\UpdateUnitRequest;
use App\Http\Resources\UnitResource;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index(Request $request)
    {
        $query = Unit::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name_en', 'like', "%{$search}%")
                    ->orWhere('name_ar', 'like', "%{$search}%")
                    ->orWhere('symbol', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->boolean('status'));
        }

        $query->latest();

        if ($request->boolean('paginate', true)) {
            return UnitResource::collection(
                $query->paginate(
                    $request->integer('per_page', 10)
                )
            );
        }

        return UnitResource::collection(
            $query->get()
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
