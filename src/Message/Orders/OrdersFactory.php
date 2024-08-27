<?php

declare(strict_types=1);


namespace RaecEdiSDK\Message\Orders;

use RaecEdiSDK\Message\AbstractMessage;
use RaecEdiSDK\Message\MessageFactoryInterface;
use RaecEdiSDK\Message\MessageItemInterface;
use RaecEdiSDK\Utils;

abstract class OrdersFactory implements MessageFactoryInterface
{
    /**
     * @param array<string, mixed> $data
     * @return OrdersMessage
     */
    public static function create(array $data): OrdersMessage
    {
        $ordersMessage = new OrdersMessage(
            $data['supplierGLN'],
            $data['buyerGLN'],
            $data['buyerOrderNumber'],
            Utils::stringToDateTime($data['buyerOrderCreationDateTime']),
            $data['shipTo'],
            $data['isTest'] ?? AbstractMessage::DEFAULT_IS_TEST_VALUE
        );

        if ($data['items']) {
            foreach ($data['items'] as $itemData) {
                $ordersMessage->addItem(self::createItem($itemData));
            }
        }

        $ordersMessage->populate($data);

        return $ordersMessage;
    }

    /**
     * @param array<string, mixed> $data
     * @return MessageItemInterface
     */
    public static function createItem(array $data): MessageItemInterface
    {
        $orderItem = new OrdersItem(
            $data['internalSupplierCode'],
            (int) $data['buyerRequestedQuantity'],
        );

        $orderItem->populate($data);

        return $orderItem;
    }
}
