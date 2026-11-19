<?php

namespace App\DTOs\API;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;

/**
 * Class APIResponse
 *
 * A generic API response DTO that can be used to standardize responses across the application.
 */
readonly class APIResponse implements Responsable
{
    /**
     * SubscriptionResponse constructor.
     *
     * @param int $status HTTP status code.
     * @param bool $success Indicates if the operation succeeded.
     * @param string|null $message Response message.
     * @param array<string, string>|null $errors Validation or business errors.
     */
    public function __construct(
        public int $status,
        public bool $success,
        public ?string $message = null,
        public ?array $errors = null
    ) {}

    /**
     * Get the payload for the API response.
     *
     * @return array The payload containing success, message, and errors.
     */
    protected function getPayload(): array
    {
        return array_filter([
            'success' => $this->success,
            'message' => $this->message,
            'errors' => $this->errors
        ], fn ($value) => $value !== null);
    }

    /**
     * Create an HTTP response that represents the object.
     */
    public function toResponse($request): JsonResponse
    {
        return response()->json($this->getPayload(), $this->status);
    }
}