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

            'product_id' => 'required|exists:products,id',
            'unit_id' => 'required|exists:units,id',

            'type' => 'required|in:percentage,fixed',

            'value' => 'required|numeric|min:0',

            'start_date' => 'required|date',

            'end_date' => 'required|date|after_or_equal:start_date',

            'is_active' => 'nullable|boolean',

        ];
    }

    public function messages(): array
    {
        return [

            'product_id.required' => __('offer.product_unit_required'),
            'product_id.exists' => __('offer.product_unit_exists'),

            'unit_id.required' => __('offer.product_unit_required'),
            'unit_id.exists' => __('offer.product_unit_exists'),

            'type.required' => __('offer.type_required'),
            'type.in' => __('offer.type_in'),

            'value.required' => __('offer.value_required'),
            'value.numeric' => __('offer.value_numeric'),

            'start_date.required' => __('offer.start_date_required'),
            'start_date.date' => __('offer.start_date_date'),

            'end_date.required' => __('offer.end_date_required'),
            'end_date.after_or_equal' => __('offer.end_date_after'),

        ];
    }
}
