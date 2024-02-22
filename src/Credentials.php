<?php

declare(strict_types=1);


namespace RaecEdiSDK;

class Credentials
{
    private ?string $token = null;

    public function __construct(
        private string $email,
        private string $password
    )
    {
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): void
    {
        $this->token = $token;
    }
}
