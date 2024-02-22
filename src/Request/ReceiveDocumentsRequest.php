<?php

declare(strict_types=1);


namespace RaecEdiSDK\Request;

use RaecEdiSDK\Response\ResponseInterface;

class ReceiveDocumentsRequest extends AbstractRequest implements RequestInterface
{
    private const ENDPOINT = 'documents';
    public const MAX_RESULTS_DEFAULT_VALUE = 10;

    protected int $maxResults = self::MAX_RESULTS_DEFAULT_VALUE;

    public function send(): ResponseInterface
    {
        return $this->sendRequest(
            method: 'GET',
            endpoint: self::ENDPOINT,
            queryParameters: ['maxResults' => $this->maxResults]
        );
    }

    public function setMaxResults(int $maxResults): void
    {
        if ($maxResults >= 1 && $maxResults <= 100) {
            $this->maxResults = $maxResults;
        }
    }
}
