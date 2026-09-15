<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreNotificationRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',

            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',

            'message_en' => 'required|string',
            'message_ar' => 'required|string',

            'type' => 'nullable|string|max:100',

            'reference_type' => 'nullable|string|max:100',
            'reference_id' => 'nullable|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => __('notification.user_required'),
            'user_id.exists' => __('notification.user_exists'),

            'title_en.required' => __('notification.title_en_required'),
            'title_ar.required' => __('notification.title_ar_required'),

            'message_en.required' => __('notification.message_en_required'),
            'message_ar.required' => __('notification.message_ar_required'),
        ];
    }
}
