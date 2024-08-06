<?php

declare(strict_types=1);


namespace RaecEdiSDK\Message\Invoic;

use RaecEdiSDK\Message\MessageFactoryInterface;
use RaecEdiSDK\Message\MessageItemInterface;
use RaecEdiSDK\Utils;

abstract class InvoicFactory implements MessageFactoryInterface
{
    /**
     * @param array<string, mixed> $data
     * @return InvoicMessage
     */
    public static function create(array $data): InvoicMessage
    {
        $invoicMessage = new InvoicMessage(
            $data['supplierGLN'],
            $data['buyerGLN'],
            $data['updNumber'],
            Utils::stringToDate($data['updDate']),
            $data['sfNumber'],
            Utils::stringToDate($data['sfDate']),
            $data['invoiceNumber'],
            Utils::stringToDate($data['invoiceDate']),
            $data['shipTo'],
            $data['shipFrom'],
            Utils::stringToDate($data['supplierEstimatedDeliveryDate']),
            $data['supplierInn'],
            $data['supplierKpp'],
            $data['buyerInn'],
            $data['buyerKpp'],
            $data['currencyIsoCode']
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
     */
    public static function createItem(array $data): MessageItemInterface
    {
        $invoicItem = new InvoicItem(
            $data['supplierOrderNumber'],
            Utils::stringToDateTime($data['supplierCreationDateTime']),
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
