<?php

declare(strict_types=1);


namespace RaecEdiSDK\Response;

abstract class AbstractResponse
{
    /**
     * @var array<string, mixed>
     */
    protected array $data = [];

    private bool $success;

    private string $message;

    /**
     * @var array<string, mixed>
     */
    private array $errors;

    private int $statusCode;

    /**
     * @param array<string, mixed> $data
     * @param int $statusCode
     */
    public function __construct(array $data, int $statusCode)
    {
        $this->data = $data;
        $this->success = ($statusCode === 200);
        $this->message = (string) ($data['message'] ?? '');
        $this->errors = isset($data['errors']) && is_array($data['errors']) ? $data['errors'] : [];
        $this->statusCode = $statusCode;
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return array<string, mixed>
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @return array<string, mixed>
     */
    public function getData(): array
    {
        return $this->data;
    }
}
