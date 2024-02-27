<?php

namespace RaecEdiSDK\Message;

interface MessageFactoryInterface
{
    /**
     * @param array<string, mixed> $data
     * @return MessageInterface
     */
    public static function create(array $data): MessageInterface;

    /**
     * @param array<string, mixed> $data
     * @return MessageItemInterface
     */
    public static function createItem(array $data): MessageItemInterface;
}
