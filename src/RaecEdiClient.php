<?php

declare(strict_types=1);


namespace RaecEdiSDK;

use RaecEdiSDK\Exception\AuthenticationException;
use RaecEdiSDK\Exception\EdiClientException;
use RaecEdiSDK\Exception\ValidateRequestException;
use RaecEdiSDK\Message\MessageInterface;
use RaecEdiSDK\Request\GetDocumentRequest;
use RaecEdiSDK\Request\ReceiveDocumentsRequest;
use RaecEdiSDK\Request\ReceiveOfficesRequest;
use RaecEdiSDK\Request\ReceiveWarehousesRequest;
use RaecEdiSDK\Request\RequestInterface;
use RaecEdiSDK\Request\SendConfirmRequest;
use RaecEdiSDK\Request\SendDocumentRequest;
use RaecEdiSDK\Response\GetDocumentResponse;
use RaecEdiSDK\Response\ReceiveDocumentsResponse;
use RaecEdiSDK\Response\ReceiveOfficesResponse;
use RaecEdiSDK\Response\ReceiveWarehousesResponse;
use RaecEdiSDK\Response\ResponseInterface;
use RaecEdiSDK\Response\SendConfirmResponse;
use RaecEdiSDK\Response\SendDocumentResponse;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class RaecEdiClient
{
    public const DEFAULT_BASE_URI = 'https://test.raec.pro/api/v1/';

    private const DEFAULT_TIMEOUT_SEC = 10;

    /**
     * @var array<string, mixed>
     */
    private array $options = [
        'timeout' => self::DEFAULT_TIMEOUT_SEC,
        'baseUri' => self::DEFAULT_BASE_URI
    ];

    private HttpClientInterface $httpClient;

    /**
     * @param Credentials $credentials
     * @param array<string, mixed> $options
     */
    public function __construct(
        private Credentials $credentials,
        array $options = []
    )
    {
        $this->options = array_merge($this->options, $options);

        $this->httpClient = HttpClient::createForBaseUri($this->options['baseUri'], [
            'headers' => ['Content-Type' => 'application/json'],
            'timeout' => $this->options['timeout']
        ]);
    }

    public function getDocument(string $id): ResponseInterface
    {
        $request = $this->createRequest(
            GetDocumentRequest::class,
            GetDocumentResponse::class,
            ['id' => $id]
        );

        return $request->send();
    }

    public function sendConfirm(string $documentId): ResponseInterface
    {
        $request = new SendConfirmRequest($this->httpClient, SendConfirmResponse::class);
        $request->initialize($this->credentials, ['documentId' => $documentId]);

        return $request->send();
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

    public function getWarehouses(
        int $page = 1,
        int $perPage = 100,
        ?string $dateFrom = null
    ): ResponseInterface
    {
        $request = $this->createRequest(
            ReceiveWarehousesRequest::class,
            ReceiveWarehousesResponse::class,
            ['page' => $page, 'perPage' => $perPage, 'dateFrom' => $dateFrom]
        );

        return $request->send();
    }

    public function getOffices(
        int $page = 1,
        int $perPage = 100,
        ?string $dateFrom = null
    ): ResponseInterface
    {
        $request = $this->createRequest(
            ReceiveOfficesRequest::class,
            ReceiveOfficesResponse::class,
            ['page' => $page, 'perPage' => $perPage, 'dateFrom' => $dateFrom]
        );

        return $request->send();
    }

    /**
     * @param int $maxResults
     * @return ResponseInterface
     * @throws AuthenticationException
     * @throws EdiClientException
     * @throws ValidateRequestException
     */
    public function getDocuments(
        int $maxResults = ReceiveDocumentsRequest::MAX_RESULTS_DEFAULT_VALUE
    ): ResponseInterface
    {
        $request = $this->createRequest(
            ReceiveDocumentsRequest::class,
            ReceiveDocumentsResponse::class,
            ['maxResults' => $maxResults]
        );

        return $request->send();
    }

    /**
     * @param string $classRequest
     * @param string $classResponse
     * @param array<string, mixed> $parameters
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
