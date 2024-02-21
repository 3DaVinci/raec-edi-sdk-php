<?php

declare(strict_types=1);


namespace RaecEdiSDK;

use RaecEdiSDK\Exception\AuthenticationException;
use RaecEdiSDK\Exception\EdiClientException;
use RaecEdiSDK\Exception\ValidateRequestException;
use RaecEdiSDK\Message\MessageInterface;
use RaecEdiSDK\Request\RequestInterface;
use RaecEdiSDK\Request\SendDocumentRequest;
use RaecEdiSDK\Response\ResponseInterface;
use RaecEdiSDK\Response\SendDocumentResponse;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class RaecEdiClient
{
    public const BASE_URI = 'http://10.4.0.217/api/v1/';

    private const DEFAULT_TIMEOUT_SEC = 10;

    private array $options = [
        'timeout' => self::DEFAULT_TIMEOUT_SEC
    ];

    private HttpClientInterface $httpClient;

    public function __construct(
        private Credentials $credentials,
        array $options = []
    )
    {
        $this->options = array_merge($this->options, $options);

        $this->httpClient = HttpClient::createForBaseUri(self::BASE_URI, [
            'headers' => ['Content-Type' => 'application/json'],
            'timeout' => $this->options['timeout']
        ]);
    }

    /**
     * @param MessageInterface $message
     * @return ResponseInterface
     * @throws AuthenticationException
     * @throws EdiClientException
     * @throws ValidateRequestException
     */
    public function sendDocument(MessageInterface $message): ResponseInterface
    {
        $request = $this->createRequest(
            SendDocumentRequest::class,
            SendDocumentResponse::class,
            ['message' => $message]
        );

        return $request->send();
    }

    /**
     * @param string $classRequest
     * @param string $classResponse
     * @param array $parameters
     * @return RequestInterface
     * @throws AuthenticationException
     * @throws EdiClientException
     * @throws ValidateRequestException
     */
    private function createRequest(
        string $classRequest,
        string $classResponse,
        array $parameters = []
    ): RequestInterface
    {
        /** @var RequestInterface $request */
        $request = new $classRequest($this->httpClient, $classResponse);
        $request->initialize($this->credentials, $parameters);

        return $request;
    }
}
