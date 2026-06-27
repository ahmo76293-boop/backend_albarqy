<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UnitResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $lang = $request->header('Accept-Language', 'en');

        return [
            'id' => $this->id,

            'name' => $lang == 'ar'
                ? $this->name_ar
                : $this->name_en,

            'symbol' => $this->symbol,

            'status' => $this->status,
        ];
    }
}
