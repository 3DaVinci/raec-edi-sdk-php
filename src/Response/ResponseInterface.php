<?php

namespace RaecEdiSDK\Response;

interface ResponseInterface
{
    public function isSuccess(): bool;

    public function getMessage(): string;

    /**
     * @return array<string, mixed>
     */
    public function getErrors(): array;

    public function getStatusCode(): int;

    /**
     * @return array<string, mixed>
     */
    public function getData(): array;
}
