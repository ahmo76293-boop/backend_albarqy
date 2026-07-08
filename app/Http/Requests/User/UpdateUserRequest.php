<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required|string|max:255',

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->route('user')->id),
            ],

            'role' => 'required|in:admin,customer,customer_service',

            'is_active' => 'required|boolean',
        ];
    }

    /**
     * Validation messages.
     */
    public function messages(): array
    {
        return [
            'name.required' => __('user.name_required'),
            'name.string' => __('user.name_string'),
            'name.max' => __('user.name_max'),

            'email.required' => __('user.email_required'),
            'email.email' => __('user.email_email'),
            'email.max' => __('user.email_max'),
            'email.unique' => __('user.email_unique'),

            'role.required' => __('user.role_required'),
            'role.in' => __('user.role_in'),

            'is_active.required' => __('user.is_active_required'),
            'is_active.boolean' => __('user.is_active_boolean'),
        ];
    }
}
