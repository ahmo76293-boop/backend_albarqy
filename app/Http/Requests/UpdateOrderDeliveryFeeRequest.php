<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderDeliveryFeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'delivery_fee' => [
                'required',
                'numeric',
                'min:0',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'delivery_fee.required' => __('order.delivery_fee_required'),
            'delivery_fee.numeric' => __('order.delivery_fee_numeric'),
            'delivery_fee.min' => __('order.delivery_fee_min'),
        ];
    }
}
