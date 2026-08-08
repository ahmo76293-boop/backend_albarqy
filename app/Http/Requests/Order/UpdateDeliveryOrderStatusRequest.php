<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDeliveryOrderStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => [
                'required',
                Rule::in([
                    'delivered',
                    'cancelled',
                ]),
            ],

            'payment_status' => [
                'required',
                Rule::in([
                    'pending',
                    'paid',
                    'failed',
                ]),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'status.required' => __('order.status_required'),
            'status.in' => __('order.invalid_delivery_status'),

            'payment_status.required' => __('order.payment_status_required'),
            'payment_status.in' => __('order.invalid_payment_status'),
        ];
    }
}
