<?php

namespace App\Http\Requests\Order;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AssignDeliveryDriverRequest extends FormRequest
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
            'delivery_driver_id' => [
                'required',
                'integer',
                Rule::exists('users', 'id')
                    ->where(function ($query) {
                        $query->where('role', 'delivery')
                            ->where('is_active', true);
                    }),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'delivery_driver_id.required' =>
            __('order.delivery_driver_required'),

            'delivery_driver_id.integer' =>
            __('order.delivery_driver_integer'),

            'delivery_driver_id.exists' =>
            __('order.delivery_driver_not_found'),
        ];
    }
}
