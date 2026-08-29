<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePrivacyPolicyRequest;
use App\Http\Requests\UpdatePrivacyPolicyRequest;
use App\Http\Resources\PrivacyPolicyResource;
use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    public function index(Request $request)
    {
        $query = PrivacyPolicy::query();

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

        // Filter by sort order
        if ($request->filled('sort_order')) {
            $query->where('sort_order', $request->sort_order);
        }

        $query->orderBy('sort_order');

        if ($request->boolean('paginate', true)) {
            $privacyPolicies = $query->paginate(
                $request->integer('per_page', 10)
            );
        } else {
            $privacyPolicies = $query->get();
        }

        return PrivacyPolicyResource::collection($privacyPolicies);
    }

    public function store(StorePrivacyPolicyRequest $request)
    {
        $policy = PrivacyPolicy::create(
            $request->validated()
        );

        return response()->json([
            'message' => __('privacy_policy.created'),
            'data' => new PrivacyPolicyResource($policy),
        ], 201);
    }

    public function show($id)
    {
        return new PrivacyPolicyResource(
            PrivacyPolicy::findOrFail($id)
        );
    }

    public function update(
        UpdatePrivacyPolicyRequest $request,
        $id
    ) {
        $policy = PrivacyPolicy::findOrFail($id);

        $policy->update(
            $request->validated()
        );

        return response()->json([
            'message' => __('privacy_policy.updated'),
            'data' => new PrivacyPolicyResource(
                $policy->fresh()
            ),
        ]);
    }

    public function destroy($id)
    {
        PrivacyPolicy::findOrFail($id)->delete();

        return response()->json([
            'message' => __('privacy_policy.deleted'),
        ]);
    }
}
