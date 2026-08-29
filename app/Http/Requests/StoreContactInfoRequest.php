<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreContactInfoRequest extends FormRequest
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
            'type' => [
                'required',
                'string',
                'in:phone,telephone,whatsapp,email,website,location,other',
            ],

            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',

            'value_en' => 'required|string',
            'value_ar' => 'required|string',

            'is_active' => 'boolean',
        ];
    }
}
