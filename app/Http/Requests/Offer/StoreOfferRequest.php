<?php

namespace App\Http\Requests\Offer;

use Illuminate\Foundation\Http\FormRequest;

class StoreOfferRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            // Offer information
            'title_en' => 'nullable|string|max:255',
            'title_ar' => 'nullable|string|max:255',

            'description_en' => 'nullable|string',
            'description_ar' => 'nullable|string',

            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            // Products / Units that trigger the offer
            'products' => 'required|array|min:1',

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
            'type' => 'required|in:fixed,percentage,gift',

            // Fixed / Percentage
            'value' => [
                'nullable',
                'numeric',
                'min:0',
                'required_unless:type,gift',
            ],

            // Gift offer
            'buy_quantity' => [
                'nullable',
                'integer',
                'min:1',
                'required_if:type,gift',
            ],

            'gift_product_id' => [
                'nullable',
                'integer',
                'exists:products,id',
                'required_if:type,gift',
            ],

            'gift_unit_id' => [
                'nullable',
                'integer',
                'exists:units,id',
                'required_if:type,gift',
            ],

            'gift_quantity' => [
                'nullable',
                'integer',
                'min:1',
                'required_if:type,gift',
            ],

            // Dates
            'start_date' => 'required|date',

            'end_date' => [
                'required',
                'date',
                'after_or_equal:start_date',
            ],

            'is_active' => 'nullable|boolean',
        ];
    }

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
            'products.required' => __('offer.products_required'),
            'products.array' => __('offer.products_array'),
            'products.min' => __('offer.products_min'),

            'products.*.product_id.required' => __('offer.product_id_required'),
            'products.*.product_id.integer' => __('offer.product_id_integer'),
            'products.*.product_id.exists' => __('offer.product_id_exists'),

            'products.*.unit_id.required' => __('offer.unit_id_required'),
            'products.*.unit_id.integer' => __('offer.unit_id_integer'),
            'products.*.unit_id.exists' => __('offer.unit_id_exists'),

            // Type
            'type.required' => __('offer.type_required'),
            'type.in' => __('offer.type_in'),

            // Value
            'value.required_unless' => __('offer.value_required'),
            'value.numeric' => __('offer.value_numeric'),
            'value.min' => __('offer.value_min'),

            // Gift
            'buy_quantity.required_if' => __('offer.buy_quantity_required'),
            'buy_quantity.integer' => __('offer.buy_quantity_integer'),
            'buy_quantity.min' => __('offer.buy_quantity_min'),

            'gift_product_id.required_if' => __('offer.gift_product_id_required'),
            'gift_product_id.integer' => __('offer.gift_product_id_integer'),
            'gift_product_id.exists' => __('offer.gift_product_id_exists'),

            'gift_unit_id.required_if' => __('offer.gift_unit_id_required'),
            'gift_unit_id.integer' => __('offer.gift_unit_id_integer'),
            'gift_unit_id.exists' => __('offer.gift_unit_id_exists'),

            'gift_quantity.required_if' => __('offer.gift_quantity_required'),
            'gift_quantity.integer' => __('offer.gift_quantity_integer'),
            'gift_quantity.min' => __('offer.gift_quantity_min'),

            // Dates
            'start_date.required' => __('offer.start_date_required'),
            'start_date.date' => __('offer.start_date_date'),

            'end_date.required' => __('offer.end_date_required'),
            'end_date.date' => __('offer.end_date_date'),
            'end_date.after_or_equal' => __('offer.end_date_after'),
        ];
    }
}
