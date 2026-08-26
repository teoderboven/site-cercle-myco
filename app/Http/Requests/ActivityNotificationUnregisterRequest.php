<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ActivityNotificationUnregisterRequest
 *
 * This request class is responsible for validating the incoming request to unregister for activity notifications.
 */
class ActivityNotificationUnregisterRequest extends FormRequest
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
            'subscriber'       => ['required', 'array'],
            'subscriber.id'    => ['required', 'uuid'],
            'subscriber.email' => ['required', 'email'],
            'subscriber.token' => ['required', 'string'],
        ];
    }
}
