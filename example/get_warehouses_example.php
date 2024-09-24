<?php

declare(strict_types=1);

use RaecEdiSDK\Credentials;
use RaecEdiSDK\RaecEdiClient;
use RaecEdiSDK\Response\PaginationResponse;
use RaecEdiSDK\Response\ReceiveWarehousesResponse;
use RaecEdiSDK\Exception\AuthenticationException;
use RaecEdiSDK\Exception\EdiClientException;
use RaecEdiSDK\Exception\ValidateRequestException;
use RaecEdiSDK\Warehouse\Warehouse;

require_once __DIR__.'/../vendor/autoload.php';

$raecEdiClient = new RaecEdiClient(
    new Credentials(email: 'supplier@3davinci.ru', password: '040222')
);

try {
    /** @var ReceiveWarehousesResponse $response */
    $response = $raecEdiClient->getWarehouses(
        page: 1,
        perPage: 10
    );
} catch (AuthenticationException | EdiClientException | ValidateRequestException $e) {
    die(sprintf('Exception "%s" thrown', get_class($e)));
}

if ($response->isSuccess()) {
    /** @var Warehouse $warehouse */
    foreach ($response->getWarehouses() as $warehouse) {
        // Do something
        //var_dump($warehouse); break;
    }

    /** @var PaginationResponse $pagination */
    $pagination = $response->getPagination();
    var_dump($pagination);
}
