<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactInfoRequest;
use App\Http\Requests\UpdateContactInfoRequest;
use App\Http\Resources\ContactInfoResource;
use App\Models\ContactInfo;
use Illuminate\Http\Request;

class ContactInfoController extends Controller
{
    public function index(Request $request)
    {
        $query = ContactInfo::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('type', 'like', "%{$search}%")
                    ->orWhere('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $query->latest();

        if ($request->boolean('paginate', true)) {
            $contacts = $query->paginate(
                $request->integer('per_page', 10)
            );
        } else {
            $contacts = $query->get();
        }

        return ContactInfoResource::collection($contacts);
    }

    public function store(StoreContactInfoRequest $request)
    {
        $contact = ContactInfo::create(
            $request->validated()
        );

        return response()->json([
            'message' => __('contact.created'),
            'data' => new ContactInfoResource($contact),
        ], 201);
    }

    public function show($id)
    {
        return new ContactInfoResource(
            ContactInfo::findOrFail($id)
        );
    }

    public function update(
        UpdateContactInfoRequest $request,
        $id
    ) {
        $contact = ContactInfo::findOrFail($id);

        $contact->update(
            $request->validated()
        );

        return response()->json([
            'message' => __('contact.updated'),
            'data' => new ContactInfoResource(
                $contact->fresh()
            ),
        ]);
    }

    public function destroy($id)
    {
        ContactInfo::findOrFail($id)->delete();

        return response()->json([
            'message' => __('contact.deleted'),
        ]);
    }
}
