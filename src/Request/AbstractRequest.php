<?php

declare(strict_types=1);


namespace RaecEdiSDK\Request;

use Exception;
use RaecEdiSDK\Credentials;
use RaecEdiSDK\Exception\AuthenticationException;
use RaecEdiSDK\Exception\EdiClientException;
use RaecEdiSDK\Exception\ValidateRequestException;
use RaecEdiSDK\Response\ResponseInterface;
use RuntimeException;
use Symfony\Contracts\HttpClient\HttpClientInterface;

abstract class AbstractRequest
{
    protected HttpClientInterface $httpClient;

    protected ?ResponseInterface $response = null;

    protected string $responseClassName;

    private ?string $token = null;

    public function __construct(
        HttpClientInterface $httpClient,
        string $responseClassName
    )
    {
        $this->httpClient = $httpClient;
        $this->responseClassName = $responseClassName;
    }

    /**
     * @param Credentials $credentials
     * @param array<string, mixed> $parameters
     * @return void
     * @throws AuthenticationException
     */
    public function initialize(Credentials $credentials, array $parameters): void
    {
        foreach ($parameters as $key => $value) {
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }

        if (is_null($this->token)) {
            $this->login($credentials);
        }
    }

    /**
     * @param string $method
     * @param string $endpoint
     * @param array<string, mixed> $queryParameters
     * @param array<string, mixed> $requestData
     * @return ResponseInterface
     * @throws EdiClientException
     * @throws ValidateRequestException
     */
    protected function sendRequest(
        string $method,
        string $endpoint,
        array $queryParameters = [],
        array $requestData = []
    ): ResponseInterface
    {
        $this->validate();

        $options = [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token
            ]
        ];

        if ($queryParameters) {
            $options['query'] = $queryParameters;
        }

        if ($method === 'POST' && $requestData) {
            $options['json'] = $requestData;
        }

        try {
            $httpResponse = $this->httpClient->request($method, $endpoint, $options);
        } catch (RuntimeException $e) {
            throw new EdiClientException($e->getMessage());
        }

        $content = $httpResponse->toArray(false);

        $responseClassName = $this->responseClassName;

        return new $responseClassName($content, $httpResponse->getStatusCode());
    }

    /**
     * @param Credentials $credentials
     * @return void
     * @throws AuthenticationException
     */
    private function login(Credentials $credentials): void
    {
        try {
            $httpResponse = $this->httpClient->request('POST', 'login', [
                'json' => [
                    'email' => $credentials->getEmail(),
                    'password' => $credentials->getPassword()
                ]
            ]);
            $content = $httpResponse->toArray();
        } catch (Exception) {
            throw new AuthenticationException();
        }

        $this->token = $content['token'];
    }

    /**
     * @return void
     * @throws ValidateRequestException
     */
    protected function validate()
    {
        /** @var string $property */
        foreach (func_get_args() as $property) {
            if (! property_exists($this, $property) || empty($this->$property)) {
                throw new ValidateRequestException($property);
            }
        }
    }
}
