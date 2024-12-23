<?php

declare(strict_types=1);

use RaecEdiSDK\Credentials;
use RaecEdiSDK\RaecEdiClient;
use RaecEdiSDK\Response\PaginationResponse;
use RaecEdiSDK\Response\ReceiveOfficesResponse;
use RaecEdiSDK\Exception\AuthenticationException;
use RaecEdiSDK\Exception\EdiClientException;
use RaecEdiSDK\Exception\ValidateRequestException;
use RaecEdiSDK\Office\Office;

require_once __DIR__.'/../vendor/autoload.php';

$raecEdiClient = new RaecEdiClient(
    new Credentials(email: 'buyer@3davinci.ru', password: '040555'),
    options: []
);

try {
    /** @var ReceiveOfficesResponse $response */
    $response = $raecEdiClient->getOffices(
        page: 1,
        perPage: 10
    );
} catch (AuthenticationException | EdiClientException | ValidateRequestException $e) {
    die(sprintf('Exception "%s" thrown', get_class($e)));
}

if ($response->isSuccess()) {
    /** @var Office $office */
    foreach ($response->getOffices() as $office) {
        // Do something
        //var_dump($office); break;
    }

    /** @var PaginationResponse $pagination */
    $pagination = $response->getPagination();
    //var_dump($pagination);
}
