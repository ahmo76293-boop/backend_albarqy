<?php

namespace App\Http\Requests\Cart;

use Illuminate\Foundation\Http\FormRequest;

class AddToCartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules.
     */
    public function rules(): array
    {
        return [
            'product_id' => 'required|exists:products,id',

            'unit_id' => 'required|exists:units,id',

            'quantity' => 'required|integer|min:1',
        ];
    }

    /**
     * Validation messages.
     */
    public function messages(): array
    {
        return [

            'product_id.required' => __('cart.product_required'),
            'product_id.exists' => __('cart.product_exists'),

            'unit_id.required' => __('cart.unit_required'),
            'unit_id.exists' => __('cart.unit_exists'),

            'quantity.required' => __('cart.quantity_required'),
            'quantity.integer' => __('cart.quantity_integer'),
            'quantity.min' => __('cart.quantity_min'),
        ];
    }
}
