<?php

namespace App\Http\Requests\Coupon;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCouponRequest extends FormRequest
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

            'code' => 'required|string|max:50|unique:coupons,code',

            'type' => 'required|in:fixed,percentage',

            'value' => 'required|numeric|min:0',

            'minimum_order_amount' => 'nullable|numeric|min:0',

            'usage_limit' => 'nullable|integer|min:1',

            'start_date' => 'required|date',

            'end_date' => 'required|date|after_or_equal:start_date',

            'is_active' => 'required|boolean',
        ];
    }
    public function messages(): array
    {
        return [

            'code.required' => __('coupon.code_required'),
            'code.string' => __('coupon.code_string'),
            'code.max' => __('coupon.code_max'),
            'code.unique' => __('coupon.code_unique'),

            'type.required' => __('coupon.type_required'),
            'type.in' => __('coupon.type_in'),

            'value.required' => __('coupon.value_required'),
            'value.numeric' => __('coupon.value_numeric'),
            'value.min' => __('coupon.value_min'),

            'minimum_order_amount.numeric' => __('coupon.minimum_order_amount_numeric'),
            'minimum_order_amount.min' => __('coupon.minimum_order_amount_min'),

            'usage_limit.integer' => __('coupon.usage_limit_integer'),
            'usage_limit.min' => __('coupon.usage_limit_min'),

            'start_date.required' => __('coupon.start_date_required'),
            'start_date.date' => __('coupon.start_date_date'),

            'end_date.required' => __('coupon.end_date_required'),
            'end_date.date' => __('coupon.end_date_date'),
            'end_date.after_or_equal' => __('coupon.end_date_after_or_equal'),

            'is_active.required' => __('coupon.is_active_required'),
            'is_active.boolean' => __('coupon.is_active_boolean'),
        ];
    }
}
