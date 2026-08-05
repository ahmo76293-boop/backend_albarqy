<?php

namespace App\Http\Requests\Ad;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreAdRequest extends FormRequest
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

            'title_en' => 'nullable|string|max:255',

            'title_ar' => 'nullable|string|max:255',

            'description_en' => 'nullable|string',

            'description_ar' => 'nullable|string',

            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',

            'url' => 'nullable|url|max:255',

            'is_active' => 'required|boolean',

            'sort_order' => 'nullable|integer|min:0',
        ];
    }
    public function messages(): array
    {
        return [

            'title_en.string' => __('validation.string', ['attribute' => 'English title']),
            'title_en.max' => __('validation.max.string', ['attribute' => 'English title', 'max' => 255]),

            'title_ar.string' => __('validation.string', ['attribute' => 'Arabic title']),
            'title_ar.max' => __('validation.max.string', ['attribute' => 'Arabic title', 'max' => 255]),

            'description_en.string' => __('validation.string', ['attribute' => 'English description']),

            'description_ar.string' => __('validation.string', ['attribute' => 'Arabic description']),

            'image.required' => __('validation.required', ['attribute' => 'image']),
            'image.image' => __('validation.image', ['attribute' => 'image']),
            'image.mimes' => __('validation.mimes', [
                'attribute' => 'image',
                'values' => 'jpg, jpeg, png, webp',
            ]),
            'image.max' => __('validation.max.file', [
                'attribute' => 'image',
                'max' => 2048,
            ]),

            'url.url' => __('validation.url', ['attribute' => 'URL']),
            'url.max' => __('validation.max.string', ['attribute' => 'URL', 'max' => 255]),

            'is_active.required' => __('validation.required', ['attribute' => 'status']),
            'is_active.boolean' => __('validation.boolean', ['attribute' => 'status']),

            'sort_order.integer' => __('validation.integer', ['attribute' => 'sort order']),
            'sort_order.min' => __('validation.min.numeric', [
                'attribute' => 'sort order',
                'min' => 0,
            ]),
        ];
    }
}
