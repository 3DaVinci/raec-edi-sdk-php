<?php

namespace RaecEdiSDK\Message;

interface MessageFactoryInterface
{
    public static function create(array $data): MessageInterface;

    public static function createItem(array $data): MessageItemInterface;
}
