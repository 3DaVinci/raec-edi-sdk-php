<?php

declare(strict_types=1);


use RaecEdiSDK\Credentials;
use RaecEdiSDK\Exception\AuthenticationException;
use RaecEdiSDK\Exception\EdiClientException;
use RaecEdiSDK\Exception\ValidateRequestException;
use RaecEdiSDK\RaecEdiClient;
use RaecEdiSDK\Response\SendConfirmResponse;

require_once __DIR__.'/../vendor/autoload.php';


$raecEdiClient = new RaecEdiClient(
    new Credentials(email: 'buyer@3davinci.ru', password: '040555')
);

try {
    /** @var SendConfirmResponse $response */
    $response = $raecEdiClient->sendConfirm('01J46RV8Q0MA4XG5SH5FGPB38X');
} catch (AuthenticationException | EdiClientException | ValidateRequestException $e) {
    die(sprintf('Exception "%s" thrown', get_class($e)));
}

if ($response->isSuccess()) {
    var_dump($response->isConfirmed());

    // Do something

} else {

    // Error handling
    $errors = $response->getErrors();

    var_dump($errors, $response->getData());
}
