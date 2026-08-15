<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class GetActivityNotificationSubscriptionsRequest
 *
 * This request class is responsible for validating the incoming request to retrieve activity notification subscriptions.
 */
class GetActivityNotificationSubscriptionsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare token from header for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'token' => $this->header('X-Subscriber-Token'),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'token' => ['required', 'string'],
        ];
    }

    /**
     * Get the custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'token.required' => __('validation.required', ['attribute' => 'X-Subscriber-Token']),
            'token.string' => __('validation.string', ['attribute' => 'X-Subscriber-Token']),
        ];
    }
}
