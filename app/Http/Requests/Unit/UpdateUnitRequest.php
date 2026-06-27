<?php

namespace App\Http\Requests\Unit;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUnitRequest extends FormRequest
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

            'name_en' => [
                'required',
                'string',
                'max:100',
                Rule::unique('units')->ignore($this->unit),
            ],

            'name_ar' => [
                'required',
                'string',
                'max:100',
                Rule::unique('units', 'name_ar')->ignore($this->unit),
            ],

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
