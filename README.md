# RAEC EDI SDK для PHP

Библиотека для работы с API системы электронного документооборота в формате RAEC EDI.

Пример отпраки документа ORDERS

```php
<?php

declare(strict_types=1);


use RaecEdiSDK\Credentials;
use RaecEdiSDK\Exception\AuthenticationException;
use RaecEdiSDK\Exception\EdiClientException;
use RaecEdiSDK\Exception\ValidateRequestException;
use RaecEdiSDK\Message\Orders\OrdersItem;
use RaecEdiSDK\Message\Orders\OrdersMessage;
use RaecEdiSDK\RaecEdiClient;
use RaecEdiSDK\Response\SendDocumentResponse;

require_once __DIR__.'/../vendor/autoload.php';


$ordersMessage = new OrdersMessage(
    supplierGLN: '6971267350013',
    buyerGLN: '6974796060019',
    buyerOrderNumber: '2024-ЭК00-001052',
    buyerOrderCreationDateTime: new DateTimeImmutable(),
    shipTo: 'Склад №3'
);

$ordersItem = new OrdersItem(
    internalSupplierCode: 'CKK10',
    buyerProductName: 'IEK Кабель-канал 60х40 \"ЭЛЕКОР\" (18м)',
    buyerRequestedQuantity: 20,
    buyerUnitOfMeasure: 'шт',
    buyerMultiplicity: 1
);

$ordersItem
    ->setManufacturerCode('CKK10-060-040-1-K01-018')
    ->setRaecId('123456');

$ordersMessage->addItem($ordersItem);

$raecEdiClient = new RaecEdiClient(
    new Credentials(email: 'buyer@3davinci.ru', password: '040555')
);

try {
    /** @var SendDocumentResponse $responseDocument */
    $responseDocument = $raecEdiClient->sendDocument($ordersMessage);
} catch (AuthenticationException | EdiClientException | ValidateRequestException $e) {
    die(sprintf('Exception "%s" thrown', get_class($e)));
}


if ($responseDocument->isSuccess()) {
    $documentId = $responseDocument->getId();

    var_dump($responseDocument->getData());

    // Do something

} else {

    // Error handling
    $message = $responseDocument->getMessage();
    $errors = $responseDocument->getErrors();

    var_dump($errors);
}
```

См. больше примеров в ./example
