<?php

declare(strict_types=1);


use RaecEdiSDK\Credentials;
use RaecEdiSDK\Exception\AuthenticationException;
use RaecEdiSDK\Exception\EdiClientException;
use RaecEdiSDK\Exception\InvalidJsonStringException;
use RaecEdiSDK\Exception\ValidateRequestException;
use RaecEdiSDK\RaecEdiClient;
use RaecEdiSDK\Response\SendDocumentResponse;
use RaecEdiSDK\Message\RawDocument;

require_once __DIR__.'/../vendor/autoload.php';


try {
    $jsonString = file_get_contents(__DIR__.'/orders.json');
    $message = new RawDocument($jsonString);
} catch (InvalidJsonStringException $e) {
    die(sprintf('Exception "%s" thrown', get_class($e)));
}


$raecEdiClient = new RaecEdiClient(
    new Credentials(email: 'buyer@3davinci.ru', password: '040555')
);


try {
    /** @var SendDocumentResponse $responseDocument */
    $responseDocument = $raecEdiClient->sendDocument($message);
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
