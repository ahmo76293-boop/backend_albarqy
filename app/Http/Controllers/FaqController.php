<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFaqRequest;
use App\Http\Requests\UpdateFaqRequest;
use App\Http\Resources\FaqResource;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $query = Faq::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('question_en', 'like', "%{$search}%")
                    ->orWhere('question_ar', 'like', "%{$search}%")
                    ->orWhere('answer_en', 'like', "%{$search}%")
                    ->orWhere('answer_ar', 'like', "%{$search}%");
            });
        }

        $query->latest();

        if ($request->boolean('paginate', true)) {
            $faqs = $query->paginate(
                $request->integer('per_page', 10)
            );
        } else {
            $faqs = $query->get();
        }

        return FaqResource::collection($faqs);
    }

    public function store(StoreFaqRequest $request)
    {
        $faq = Faq::create(
            $request->validated()
        );

        return response()->json([
            'message' => __('faq.created'),
            'data' => new FaqResource($faq),
        ], 201);
    }

    public function show($id)
    {
        return new FaqResource(
            Faq::findOrFail($id)
        );
    }

    public function update(
        UpdateFaqRequest $request,
        $id
    ) {
        $faq = Faq::findOrFail($id);

        $faq->update(
            $request->validated()
        );

        return response()->json([
            'message' => __('faq.updated'),
            'data' => new FaqResource(
                $faq->fresh()
            ),
        ]);
    }

    public function destroy($id)
    {
        Faq::findOrFail($id)->delete();

        return response()->json([
            'message' => __('faq.deleted'),
        ]);
    }
}
