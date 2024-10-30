<?php

declare(strict_types=1);


namespace RaecEdiSDK\Exception;

use RaecEdiSDK\Message\MessageInterface;

class InvalidDateValueException extends InvalidValueException
{
    public function __construct(string $fieldName, string $invalidValue)
    {
        $messageFormat = 'Incorrect data value "%s" in the "%s" field. Allowed formats "'.MessageInterface::DATE_FORMAT.'" or "'.MessageInterface::DATE_FORMAT_EXTRA.'"';

        parent::__construct($fieldName, $invalidValue, $messageFormat);
    }
}
