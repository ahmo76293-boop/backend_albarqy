<?php

namespace App\Http\Requests\Order;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreAdminOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'user_id' => 'required|exists:users,id',

            'location_id' => 'required|exists:locations,id',

            'payment_method' => 'required|in:cash,card',

            'delivery_fee' => 'nullable|numeric|min:0',

            'discount' => 'nullable|numeric|min:0',

            'notes' => 'nullable|string|max:1000',

            'items' => 'required|array|min:1',

            'items.*.product_id' => 'required|exists:products,id',

            'items.*.unit_id' => 'required|exists:units,id',

            'items.*.quantity' => 'required|integer|min:1',

            'coupon_code' => 'nullable|string|exists:coupons,code',
        ];
    }

    /**
     * Validation messages.
     */
    public function messages(): array
    {
        return [

            'location_id.required' => __('order.location_required'),
            'location_id.exists' => __('order.location_exists'),

            'payment_method.required' => __('order.payment_method_required'),
            'payment_method.in' => __('order.payment_method_invalid'),

            'delivery_fee.numeric' => __('order.delivery_fee_numeric'),
            'delivery_fee.min' => __('order.delivery_fee_min'),

            'discount.numeric' => __('order.discount_numeric'),
            'discount.min' => __('order.discount_min'),

            'notes.max' => __('order.notes_max'),

            'items.required' => __('order.items_required'),
            'items.array' => __('order.items_array'),
            'items.min' => __('order.items_min'),

            'items.*.product_id.required' => __('order.product_required'),
            'items.*.product_id.exists' => __('order.product_exists'),

            'items.*.unit_id.required' => __('order.unit_required'),
            'items.*.unit_id.exists' => __('order.unit_exists'),

            'items.*.quantity.required' => __('order.quantity_required'),
            'items.*.quantity.integer' => __('order.quantity_integer'),
            'items.*.quantity.min' => __('order.quantity_min'),
        ];
    }
}
