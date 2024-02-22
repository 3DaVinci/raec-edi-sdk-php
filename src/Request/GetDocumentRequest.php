<?php

declare(strict_types=1);


namespace RaecEdiSDK\Request;

use RaecEdiSDK\Response\ResponseInterface;

class GetDocumentRequest extends AbstractRequest implements RequestInterface
{
    private const ENDPOINT = 'documents/{id}';

    protected ?string $id = null;

    public function send(): ResponseInterface
    {
        return $this->sendRequest(
            method: 'GET',
            endpoint: str_replace('{id}', $this->id, self::ENDPOINT)
        );
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function validate()
    {
        parent::validate('id');
    }
}
