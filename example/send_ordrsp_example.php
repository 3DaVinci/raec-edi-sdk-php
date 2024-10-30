<?php

declare(strict_types=1);


use RaecEdiSDK\Credentials;
use RaecEdiSDK\Exception\AuthenticationException;
use RaecEdiSDK\Exception\EdiClientException;
use RaecEdiSDK\Exception\ValidateRequestException;
use RaecEdiSDK\Message\Ordrsp\OrdrspItem;
use RaecEdiSDK\Message\Ordrsp\OrdrspMessage;
use RaecEdiSDK\RaecEdiClient;
use RaecEdiSDK\Response\SendDocumentResponse;

require_once __DIR__.'/../vendor/autoload.php';


$ordrspMessage = new OrdrspMessage(
    supplierGLN: '1234023894117',
    buyerGLN: '6971267350013',
    supplierOrderNumber: '2024-ЭК00-001052',
    supplierCreationDateTime: new DateTimeImmutable(),
    shipTo: 'Склад №3'
);

$ordrspItem = new OrdrspItem(
    internalSupplierCode: 'CKK10',
    supplierUnitOfMeasure: 'шт',
    supplierMultiplicity: '1',
    supplierConfirmedQuantity: 21,
    netAmount: 2100,
    vatRate: 20,
    vatAmount: 2500
);

$ordrspItem
    ->setManufacturerCode('CKK10-060-040-1-K01-018')
    ->setRaecId('123456')
    ->setSupplierEstimatedDeliveryDateNotSpecified(true);

$ordrspMessage->addItem($ordrspItem);

$raecEdiClient = new RaecEdiClient(
    new Credentials(email: 'buyer@3davinci.ru', password: '040555')
);

try {
    /** @var SendDocumentResponse $responseDocument */
    $responseDocument = $raecEdiClient->sendDocument($ordrspMessage);
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
