<?php

namespace RaecEdiSDK\Message;

use DateTime;

interface MessageInterface
{
    public const ALLOW_BOOLEAN_VALUES = [true, false, 1, 0, '1', '0', 'true', 'false'];

    public const TYPE_ORDERS = 'ORDERS';
    public const TYPE_ORDRSP = 'ORDRSP';
    public const TYPE_INVOIC = 'INVOIC';

    public const DATE_TIME_FORMAT = 'Y.m.d H:i:s';

    public const DATE_TIME_FORMAT_EXTRA = DateTime::RFC3339;

    public const DATE_FORMAT = 'Y.m.d';
    public const DATE_FORMAT_EXTRA = 'Y-m-d';

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array;

    public function isTest(): bool;
}
