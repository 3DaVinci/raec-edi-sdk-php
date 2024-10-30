<?php

declare(strict_types=1);


namespace RaecEdiSDK\Exception;

class InvalidStringValueException extends InvalidValueException
{
    public function __construct(string $fieldName, string $invalidValue)
    {
        $messageFormat = 'Incorrect string value "%s" in the "%s" field.';

        parent::__construct($fieldName, $invalidValue, $messageFormat);
    }
}
