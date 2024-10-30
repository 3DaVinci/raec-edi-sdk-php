<?php

namespace RaecEdiSDK\Message;

use RaecEdiSDK\Exception\InvalidValueException;

interface MessageFactoryInterface
{
    /**
     * @param array<string, mixed> $data
     * @return MessageInterface
     * @throws InvalidValueException
     */
    public static function create(array $data): MessageInterface;

    /**
     * @param array<string, mixed> $data
     * @return MessageItemInterface
     * @throws InvalidValueException
     */
    public static function createItem(array $data): MessageItemInterface;
}
