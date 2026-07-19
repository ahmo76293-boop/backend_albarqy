<?php

namespace App\Http\Requests\Favorite;

use Illuminate\Foundation\Http\FormRequest;

class StoreFavoriteRequest extends FormRequest
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
        ];
    }

    /**
     * Validation messages.
     */
    public function messages(): array
    {
        return [
            'product_id.required' => __('favorite.product_required'),
            'product_id.exists'   => __('favorite.product_exists'),
        ];
    }
}
