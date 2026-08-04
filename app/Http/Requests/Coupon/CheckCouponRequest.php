<?php

namespace App\Http\Requests\Coupon;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CheckCouponRequest extends FormRequest
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
            'coupon_code' => [
                'required',
                'string'
            ],

            'subtotal' => [
                'nullable',
                'numeric',
                'min:0'
            ],
        ];
    }


    public function messages(): array
    {
        return [

            'coupon_code.required' => __('coupon.code_required'),

            'subtotal.numeric' => __('coupon.subtotal_invalid'),

        ];
    }
}
