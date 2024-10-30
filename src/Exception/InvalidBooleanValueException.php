<?php

declare(strict_types=1);


namespace RaecEdiSDK\Exception;

use RaecEdiSDK\Message\MessageInterface;

class InvalidBooleanValueException extends InvalidValueException
{
    public function __construct(string $fieldName, string $invalidValue)
    {
        $messageFormat = 'Incorrect boolean value "%s" in the "%s" field. Allowed values true, false, 1, 0, "1", "0"';

        parent::__construct($fieldName, $invalidValue, $messageFormat);
    }

}
