<?php

declare(strict_types=1);

namespace RaecEdiSDK\Exception;

use RuntimeException;

class ValidateRequestException extends RuntimeException
{
    public function __construct(string $fieldName)
    {
        $message = sprintf('В запросе отсутствует обязательное поле %s', $fieldName);

        parent::__construct($message);
    }
}
