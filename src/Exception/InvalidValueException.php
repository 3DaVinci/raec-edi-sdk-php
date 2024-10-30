<?php

declare(strict_types=1);


namespace RaecEdiSDK\Exception;

use RuntimeException;

abstract class InvalidValueException extends RuntimeException
{
    public function __construct(string $fieldName, string $invalidValue, string $messageFormat)
    {
        parent::__construct(sprintf($messageFormat, $invalidValue, $fieldName));
    }
}
