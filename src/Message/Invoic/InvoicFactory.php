<?php

declare(strict_types=1);


namespace RaecEdiSDK\Message\Invoic;

use RaecEdiSDK\Exception\InvalidValueException;
use RaecEdiSDK\Message\AbstractMessage;
use RaecEdiSDK\Message\MessageFactoryInterface;
use RaecEdiSDK\Message\MessageItemInterface;
use RaecEdiSDK\Utils;

abstract class InvoicFactory implements MessageFactoryInterface
{
    /**
     * @param array<string, mixed> $data
     * @return InvoicMessage
     * @throws InvalidValueException
     */
    public static function create(array $data): InvoicMessage
    {
        $invoicMessage = new InvoicMessage(
            $data['supplierGLN'],
            $data['buyerGLN'],
            $data['updNumber'],
            Utils::stringToDate((string) $data['updDate'], 'updDate'),
            $data['sfNumber'],
            Utils::stringToDate((string) $data['sfDate'], 'sfDate'),
            $data['invoiceNumber'],
            Utils::stringToDate((string) $data['invoiceDate'], 'invoiceDate'),
            $data['shipTo'],
            $data['shipFrom'],
            Utils::stringToDate((string) $data['supplierEstimatedDeliveryDate'], 'supplierEstimatedDeliveryDate'),
            $data['supplierInn'],
            $data['supplierKpp'],
            $data['buyerInn'],
            $data['buyerKpp'],
            $data['currencyIsoCode'],
            $data['isTest'] ?? AbstractMessage::DEFAULT_IS_TEST_VALUE
        );

        if ($data['items']) {
            foreach ($data['items'] as $itemData) {
                $invoicMessage->addItem(self::createItem($itemData));
            }
        }

        $invoicMessage->populate($data);

        return $invoicMessage;
    }

    /**
     * @param array<string, mixed> $data
     * @return MessageItemInterface
     * @throws InvalidValueException
     */
    public static function createItem(array $data): MessageItemInterface
    {
        $invoicItem = new InvoicItem(
            $data['supplierOrderNumber'],
            Utils::stringToDateTime((string) $data['supplierCreationDateTime'], 'item.supplierCreationDateTime'),
            $data['internalSupplierCode'],
            $data['supplierUnitOfMeasure'],
            (int) $data['supplierConfirmedQuantity'],
            (float) $data['netAmount'],
            (int) $data['vatRate'],
            $data['originalCountryIsoCode'],
            $data['vatAmount']
        );

        $invoicItem->populate($data);

        return $invoicItem;
    }

}
