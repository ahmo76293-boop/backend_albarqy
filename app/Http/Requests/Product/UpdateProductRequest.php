<?php

namespace App\Http\Requests\Product;

use App\Models\ProductUnit;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name_en' => [
                'required',
                'string',
                'max:255',
                Rule::unique('products', 'name_en')->ignore($this->product),
            ],

            'name_ar' => [
                'required',
                'string',
                'max:255',
                Rule::unique('products', 'name_ar')->ignore($this->product),
            ],

            'unique_number' => [
                'required',
                'string',
                'max:255',
                Rule::unique('products', 'unique_number')->ignore($this->product),
            ],

            'description_en' => 'nullable|string',
            'description_ar' => 'nullable|string',

            'status' => 'nullable|boolean',

            'category_id' => 'required|exists:categories,id',

            // Images
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',

            // Units
            'units' => 'required|array|min:1',

            'units.*.unit_id' => 'required|exists:units,id',
            'units.*.quantity' => 'required|integer|min:1',
            'units.*.barcode' => [
                'required',
                'string',
                'max:255',
            ],
        ];
    }

    public function messages(): array
    {
        return [

            // Names
            'name_en.required' => __('product.name_en_required'),
            'name_ar.required' => __('product.name_ar_required'),

            'name_en.unique' => __('product.name_en_unique'),
            'name_ar.unique' => __('product.name_ar_unique'),

            // Product Number
            'unique_number.required' => __('product.unique_number_required'),
            'unique_number.unique' => __('product.unique_number_unique'),

            // Category
            'category_id.required' => __('product.category_required'),
            'category_id.exists' => __('product.category_exists'),

            // Images
            'images.array' => __('product.images_array'),

            'images.*.image' => __('product.image_image'),
            'images.*.mimes' => __('product.image_mimes'),
            'images.*.max' => __('product.image_max'),

            // Units
            'units.required' => __('product.units_required'),
            'units.array' => __('product.units_array'),

            'units.*.unit_id.required' => __('product.unit_required'),
            'units.*.unit_id.exists' => __('product.unit_exists'),

            'units.*.quantity.required' => __('product.quantity_required'),
            'units.*.quantity.integer' => __('product.quantity_integer'),
            'units.*.quantity.min' => __('product.quantity_min'),
        ];
    }
    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {

            $product = $this->product;

            foreach ($this->units ?? [] as $index => $unit) {

                if (empty($unit['barcode']) || empty($unit['unit_id'])) {
                    continue;
                }

                /*
                |--------------------------------------------------------------------------
                | Check barcode
                |--------------------------------------------------------------------------
                |
                | Barcode must be unique.
                |
                | But the current product_unit is allowed to keep
                | its existing barcode.
                |
                */

                $exists = ProductUnit::where(
                    'barcode',
                    $unit['barcode']
                )
                    ->where(function ($query) use ($product, $unit) {

                        $query->where('product_id', '!=', $product->id)
                            ->orWhere(
                                'unit_id',
                                '!=',
                                $unit['unit_id']
                            );
                    })
                    ->exists();

                if ($exists) {

                    $validator->errors()->add(
                        "units.$index.barcode",
                        __('product.unit_barcode_unique')
                    );
                }
            }
        });
    }
}
