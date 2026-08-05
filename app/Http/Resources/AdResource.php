<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            'id' => $this->id,

            'title_en' => $this->title_en,

            'title_ar' => $this->title_ar,

            'description_en' => $this->description_en,

            'description_ar' => $this->description_ar,

            'image' => asset('storage/' . $this->image),

            'url' => $this->url,

            'is_active' => (bool) $this->is_active,

            'sort_order' => $this->sort_order,

            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),

            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
