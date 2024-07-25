<?php

declare(strict_types=1);


namespace RaecEdiSDK\Message\Ordrsp;

use RaecEdiSDK\Message\MessageFactoryInterface;
use RaecEdiSDK\Message\MessageItemInterface;
use RaecEdiSDK\Utils;

abstract class OrdrspFactory implements MessageFactoryInterface
{
    /**
     * @param array<string, mixed> $data
     * @return OrdrspMessage
     */
    public static function create(array $data): OrdrspMessage
    {
        $ordrspMessage = new OrdrspMessage(
            $data['supplierGLN'],
            $data['buyerGLN'],
            $data['supplierOrderNumber'],
            Utils::stringToDateTime($data['supplierCreationDateTime']),
            $data['shipTo']
        );

        if ($data['items']) {
            foreach ($data['items'] as $itemData) {
                $ordrspMessage->addItem(self::createItem($itemData));
            }
        }

        $ordrspMessage->populate($data);

        return $ordrspMessage;
    }

    /**
     * @param array<string, mixed> $data
     * @return MessageItemInterface
     */
    public static function createItem(array $data): MessageItemInterface
    {
        $ordrspItem = new OrdrspItem(
            $data['internalSupplierCode'],
            $data['supplierUnitOfMeasure'],
            $data['supplierMultiplicity'],
            (int) $data['supplierConfirmedQuantity'],
            (float) $data['netAmount'],
            (float) $data['netAmountWithVat'],
            (int) $data['vatRate'],
            (float) $data['vatAmount'],
        );

        $ordrspItem->populate($data);

        return $ordrspItem;
    }
}
