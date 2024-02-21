<?php

namespace RaecEdiSDK\Message;

interface MessageInterface
{
    public const TYPE_ORDERS = 'ORDERS';
    public const TYPE_ORDRSP = 'ORDRSP';
    public const TYPE_INVOIC = 'INVOIC';

    public const DATE_TIME_FORMAT = 'Y.m.d H:i:s';
    public const DATE_FORMAT = 'Y.m.d';

    public function jsonSerialize(): array;
}
