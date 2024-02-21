<?php

declare(strict_types=1);


namespace RaecEdiSDK\Exception;

use RuntimeException;

class AuthenticationException extends RuntimeException
{
    public function __construct()
    {
        parent::__construct('Bad credentials');
    }
}
