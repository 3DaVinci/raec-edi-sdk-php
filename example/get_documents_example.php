<?php

declare(strict_types=1);

use RaecEdiSDK\Credentials;
use RaecEdiSDK\RaecEdiClient;
use RaecEdiSDK\Response\ReceiveDocumentsResponse;
use RaecEdiSDK\Exception\AuthenticationException;
use RaecEdiSDK\Exception\EdiClientException;
use RaecEdiSDK\Exception\ValidateRequestException;

require_once __DIR__.'/../vendor/autoload.php';

$raecEdiClient = new RaecEdiClient(
    new Credentials(email: 'supplier@3davinci.ru', password: '040222')
);

try {
    /** @var ReceiveDocumentsResponse $response */
    $response = $raecEdiClient->getDocuments(maxResults: 10);
} catch (AuthenticationException | EdiClientException | ValidateRequestException $e) {
    die(sprintf('Exception "%s" thrown', get_class($e)));
}

if ($response->isSuccess()) {
    foreach ($response->getDocuments() as $document) {
        // Do something
    }
}
