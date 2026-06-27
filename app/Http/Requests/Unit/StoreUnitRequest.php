<?php

namespace App\Http\Requests\Unit;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUnitRequest extends FormRequest
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
            'name_en' => 'required|string|max:100|unique:units,name_en',
            'name_ar' => 'required|string|max:100|unique:units,name_ar',

            'symbol' => 'nullable|string|max:20',

            'status' => 'nullable|boolean',
        ];
    }
    public function messages(): array
    {
        return [
            'name_en.required' => __('unit.name_en_required'),
            'name_ar.required' => __('unit.name_ar_required'),
        ];
    }
}
