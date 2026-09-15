<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class IntegrationProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'category' => ['required', 'string', 'max:255',],
            'name_en' => ['required', 'string', 'max:255',],
            'name_ar' => ['required', 'string', 'max:255',],
            'unique_number' => ['required', 'string', 'max:255',],
            'description_en' => ['nullable', 'string',],
            'description_ar' =>  ['nullable', 'string',],
            'status' => ['nullable', 'boolean',],
            'units' => ['required', 'array', 'min:1',],
            'units.*.unit' =>  ['required', 'string', 'max:255',],
            'units.*.quantity' => ['required', 'numeric', 'min:0.001',],
            'units.*.barcode' => ['required', 'string', 'max:255', 'distinct',],
            'units.*.price' => ['required', 'numeric', 'min:0',],
        ];
    }
}
