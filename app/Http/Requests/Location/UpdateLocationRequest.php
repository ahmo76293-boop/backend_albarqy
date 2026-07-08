<?php

namespace App\Http\Requests\Location;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateLocationRequest extends FormRequest
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
            'title' => 'required|string|max:100',
            'address' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'is_default' => 'nullable|boolean',
        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => __('location.title_required'),
            'title.string' => __('location.title_string'),
            'title.max' => __('location.title_max'),

            'address.required' => __('location.address_required'),
            'address.string' => __('location.address_string'),

            'latitude.numeric' => __('location.latitude_numeric'),
            'longitude.numeric' => __('location.longitude_numeric'),

            'is_default.boolean' => __('location.is_default_boolean'),
        ];
    }
}
