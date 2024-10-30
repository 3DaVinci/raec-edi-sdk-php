<?php

declare(strict_types=1);


namespace RaecEdiSDK\Exception;

use RaecEdiSDK\Message\MessageInterface;

class InvalidDateTimeValueException extends InvalidValueException
{
    public function __construct(string $fieldName, string $invalidValue)
    {
        $messageFormat = 'Incorrect data-time value "%s" in the "%s" field. Allowed formats "'.MessageInterface::DATE_TIME_FORMAT.'" or "'.MessageInterface::DATE_TIME_FORMAT_EXTRA.'"';

        parent::__construct($fieldName, $invalidValue, $messageFormat);
    }
}
