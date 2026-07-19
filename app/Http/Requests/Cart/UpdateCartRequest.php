<?php

namespace App\Http\Requests\Cart;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCartRequest extends FormRequest
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
            'quantity' => 'required|integer|min:1',
        ];
    }

    /**
     * Validation messages.
     */
    public function messages(): array
    {
        return [
            'quantity.required' => __('cart.quantity_required'),
            'quantity.integer' => __('cart.quantity_integer'),
            'quantity.min' => __('cart.quantity_min'),
        ];
    }
}
