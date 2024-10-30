<?php

declare(strict_types=1);


namespace RaecEdiSDK\Exception;

class InvalidNumberValueException extends InvalidValueException
{
    public function __construct(string $fieldName, string $invalidValue)
    {
        $messageFormat = 'Incorrect number value "%s" in the "%s" field.';

        parent::__construct($fieldName, $invalidValue, $messageFormat);
    }
}
