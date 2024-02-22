<?php

use RaecEdiSDK\Credentials;
use RaecEdiSDK\RaecEdiClient;
use RaecEdiSDK\Response\GetDocumentResponse;
use RaecEdiSDK\Exception\AuthenticationException;
use RaecEdiSDK\Exception\EdiClientException;
use RaecEdiSDK\Exception\ValidateRequestException;

require_once __DIR__.'/../vendor/autoload.php';

$raecEdiClient = new RaecEdiClient(
    new Credentials(email: 'supplier@3davinci.ru', password: '040222')
);

try {
    /** @var GetDocumentResponse $response */
    $response = $raecEdiClient->getDocument('01HQ2F5AVSH836VSXJRWQ9G63N');
} catch (AuthenticationException | EdiClientException | ValidateRequestException $e) {
    die(sprintf('Exception "%s" thrown', get_class($e)));
}

if ($response->isSuccess()) {
    $document = $response->getDocument();
    // Do something
}
