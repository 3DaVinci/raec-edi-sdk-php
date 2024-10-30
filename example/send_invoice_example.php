<?php

declare(strict_types=1);


use RaecEdiSDK\Credentials;
use RaecEdiSDK\Exception\AuthenticationException;
use RaecEdiSDK\Exception\EdiClientException;
use RaecEdiSDK\Exception\ValidateRequestException;
use RaecEdiSDK\Message\Invoic\InvoicItem;
use RaecEdiSDK\Message\Invoic\InvoicMessage;
use RaecEdiSDK\RaecEdiClient;
use RaecEdiSDK\Response\SendDocumentResponse;

require_once __DIR__.'/../vendor/autoload.php';


$invoicMessage = new InvoicMessage(
    supplierGLN: '1234023894117',
    buyerGLN: '6971267350013',updNumber: '2232',
    updDate: new DateTimeImmutable(),
    sfNumber: '22',
    sfDate: new DateTimeImmutable(),
    invoiceNumber: '33',
    invoiceDate: new DateTimeImmutable(),
    shipTo: 'Склад №3',shipFrom: 'Склад 15',
    supplierEstimatedDeliveryDate: new DateTimeImmutable(),
    supplierInn: '12345678912',
    supplierKpp: '321546451',
    buyerInn: '123452154121',
    buyerKpp: '123123123',
    currencyIsoCode: 'RUS',
    isTest: true
);
$invoicMessage->setPaidByFactoring(true);

$invoicItem = new InvoicItem(
    supplierOrderNumber: '324f',
    supplierCreationDateTime: new DateTimeImmutable(),
    internalSupplierCode: 'CKK10',
    supplierUnitOfMeasure: 'шт',
    supplierConfirmedQuantity: 21,
    netAmount: 2100,
    vatRate: 20,
    originalCountryIsoCode: 'RUS',
    vatAmount: 2500
);

$invoicItem
    ->setManufacturerCode('CKK10-060-040-1-K01-018')
    ->setRaecId('123456');

$invoicMessage->addItem($invoicItem);

$raecEdiClient = new RaecEdiClient(
    new Credentials(email: 'buyer@3davinci.ru', password: '040555')
);

try {
    /** @var SendDocumentResponse $responseDocument */
    $responseDocument = $raecEdiClient->sendDocument($invoicMessage);
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
