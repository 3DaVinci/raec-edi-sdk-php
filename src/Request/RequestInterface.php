<?php

namespace RaecEdiSDK\Request;

use RaecEdiSDK\Credentials;
use RaecEdiSDK\Response\ResponseInterface;

interface RequestInterface
{
    public function send(): ResponseInterface;

    /**
     * @param Credentials $credentials
     * @param array<string, mixed> $parameters
     * @return void
     */
    public function initialize(Credentials $credentials, array $parameters): void;
}
