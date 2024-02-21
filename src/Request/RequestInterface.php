<?php

namespace RaecEdiSDK\Request;

use RaecEdiSDK\Credentials;
use RaecEdiSDK\Response\ResponseInterface;

interface RequestInterface
{
    public function send(): ResponseInterface;

    public function initialize(Credentials $credentials, array $parameters): void;
}
