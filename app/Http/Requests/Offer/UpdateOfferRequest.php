<?php

namespace App\Http\Requests\Offer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOfferRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [

            // Offer information
            'title_en' => [
                'sometimes',
                'nullable',
                'string',
                'max:255',
            ],

            'title_ar' => [
                'sometimes',
                'nullable',
                'string',
                'max:255',
            ],

            'description_en' => [
                'sometimes',
                'nullable',
                'string',
            ],

            'description_ar' => [
                'sometimes',
                'nullable',
                'string',
            ],

            'image' => [
                'sometimes',
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            // Products / Units
            'products' => [
                'sometimes',
                'array',
                'min:1',
            ],

            'products.*.product_id' => [
                'required',
                'integer',
                'exists:products,id',
            ],

            'products.*.unit_id' => [
                'required',
                'integer',
                'exists:units,id',
            ],

            // Offer type
            'type' => [
                'sometimes',
                'in:fixed,percentage,gift',
            ],

            // Fixed / Percentage value
            'value' => [
                'sometimes',
                'nullable',
                'numeric',
                'min:0',
            ],

            // Gift offer
            'buy_quantity' => [
                'sometimes',
                'nullable',
                'integer',
                'min:1',
            ],

            'gift_product_id' => [
                'sometimes',
                'nullable',
                'integer',
                'exists:products,id',
            ],

            'gift_unit_id' => [
                'sometimes',
                'nullable',
                'integer',
                'exists:units,id',
            ],

            'gift_quantity' => [
                'sometimes',
                'nullable',
                'integer',
                'min:1',
            ],

            // Dates
            'start_date' => [
                'sometimes',
                'date',
            ],

            'end_date' => [
                'sometimes',
                'date',
                'after_or_equal:start_date',
            ],

            // Status
            'is_active' => [
                'sometimes',
                'boolean',
            ],
        ];
    }

    /**
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [

            // Title
            'title_en.string' => __('offer.title_en_string'),
            'title_en.max' => __('offer.title_en_max'),

            'title_ar.string' => __('offer.title_ar_string'),
            'title_ar.max' => __('offer.title_ar_max'),

            // Description
            'description_en.string' => __('offer.description_en_string'),
            'description_ar.string' => __('offer.description_ar_string'),

            // Image
            'image.image' => __('offer.image_image'),
            'image.mimes' => __('offer.image_mimes'),
            'image.max' => __('offer.image_max'),

            // Products
            'products.array' => __('offer.products_array'),
            'products.min' => __('offer.products_min'),

            'products.*.product_id.required' => __('offer.product_id_required'),
            'products.*.product_id.integer' => __('offer.product_id_integer'),
            'products.*.product_id.exists' => __('offer.product_id_exists'),

            'products.*.unit_id.required' => __('offer.unit_id_required'),
            'products.*.unit_id.integer' => __('offer.unit_id_integer'),
            'products.*.unit_id.exists' => __('offer.unit_id_exists'),

            // Type
            'type.in' => __('offer.type_in'),

            // Value
            'value.numeric' => __('offer.value_numeric'),
            'value.min' => __('offer.value_min'),

            // Gift
            'buy_quantity.integer' => __('offer.buy_quantity_integer'),
            'buy_quantity.min' => __('offer.buy_quantity_min'),

            'gift_product_id.integer' => __('offer.gift_product_id_integer'),
            'gift_product_id.exists' => __('offer.gift_product_id_exists'),

            'gift_unit_id.integer' => __('offer.gift_unit_id_integer'),
            'gift_unit_id.exists' => __('offer.gift_unit_id_exists'),

            'gift_quantity.integer' => __('offer.gift_quantity_integer'),
            'gift_quantity.min' => __('offer.gift_quantity_min'),

            // Dates
            'start_date.date' => __('offer.start_date_date'),

            'end_date.date' => __('offer.end_date_date'),
            'end_date.after_or_equal' => __('offer.end_date_after'),

            // Status
            'is_active.boolean' => __('offer.is_active_boolean'),
        ];
    }
}
