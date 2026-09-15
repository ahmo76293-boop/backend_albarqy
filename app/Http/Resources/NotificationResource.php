<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
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

            'user_id' => $this->user_id,

            'title_en' => $this->title_en,
            'title_ar' => $this->title_ar,

            'message_en' => $this->message_en,
            'message_ar' => $this->message_ar,

            'type' => $this->type,

            'reference_type' => $this->reference_type,
            'reference_id' => $this->reference_id,

            'is_read' => $this->read_at !== null,

            'read_at' => $this->read_at?->format('Y-m-d H:i:s'),

            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
