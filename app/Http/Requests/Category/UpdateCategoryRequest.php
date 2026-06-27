<?php

namespace App\Http\Requests\Category;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $categoryId = $this->route('category')->id;

        return [

            'name_en' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories', 'name_en')->ignore($this->category),
            ],

            'name_ar' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories', 'name_ar')->ignore($this->category),
            ],

            'description_en' => 'nullable|string',
            'description_ar' => 'nullable|string',

            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'status' => 'nullable|boolean',
        ];
    }
    public function messages(): array
    {
        return [
            'name_en.required' => __('category.name_en_required'),
            'name_ar.required' => __('category.name_ar_required'),

            'name_en.unique' => __('category.name_en_unique'),
            'name_ar.unique' => __('category.name_ar_unique'),

            'image.image' => __('category.image_image'),
            'image.mimes' => __('category.image_mimes'),
            'image.max' => __('category.image_max'),
        ];
    }
}
