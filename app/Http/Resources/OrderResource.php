<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'order_number' => $this->order_number,

            'user' => new UserResource(
                $this->whenLoaded('user')
            ),

            'location' => new LocationResource(
                $this->whenLoaded('location')
            ),

            'delivery_driver' => $this->whenLoaded(
                'deliveryDriver',
                function () {
                    return $this->deliveryDriver
                        ? [
                            'id' => $this->deliveryDriver->id,
                            'name' => $this->deliveryDriver->name,
                            'email' => $this->deliveryDriver->email,
                            'phone' => $this->deliveryDriver->phone,
                            'role' => $this->deliveryDriver->role,
                        ]
                        : null;
                }
            ),

            'items' => OrderItemResource::collection(
                $this->whenLoaded('items')
            ),

            'subtotal' => (float) $this->subtotal,

            'delivery_fee' => (float) $this->delivery_fee,

            'discount' => (float) $this->discount,

            'total' => (float) $this->total,

            'payment_method' => $this->payment_method,

            'payment_status' => $this->payment_status,

            'coupon' => $this->whenLoaded('coupon', function () {
                return [
                    'id' => $this->coupon->id,
                    'code' => $this->coupon->code,
                    'type' => $this->coupon->type,
                    'value' => (float) $this->coupon->value,
                ];
            }),

            'coupon_discount' => (float) $this->coupon_discount,

            'status' => $this->status,

            'notes' => $this->notes,

            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),

            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
