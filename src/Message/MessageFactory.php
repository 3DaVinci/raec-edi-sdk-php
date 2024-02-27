<?php

declare(strict_types=1);


namespace RaecEdiSDK\Message;

use RaecEdiSDK\Message\Invoic\InvoicFactory;
use RaecEdiSDK\Message\Orders\OrdersFactory;
use RaecEdiSDK\Message\Ordrsp\OrdrspFactory;
use RuntimeException;

abstract class MessageFactory
{
    /**
     * @param string $type
     * @param array<string, mixed> $data
     * @return MessageInterface
     */
    public static function create(string $type, array $data): MessageInterface
    {
        return match ($type) {
            MessageInterface::TYPE_ORDERS => OrdersFactory::create($data),
            MessageInterface::TYPE_ORDRSP => OrdrspFactory::create($data),
            MessageInterface::TYPE_INVOIC => InvoicFactory::create($data),
            default => throw new RuntimeException(sprintf('Unsupported EDI-Message type "%s"', $type)),
        };
    }
}
