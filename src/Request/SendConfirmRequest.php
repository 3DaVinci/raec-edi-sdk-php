<?php

declare(strict_types=1);


namespace RaecEdiSDK\Request;

use RaecEdiSDK\Response\ResponseInterface;

class SendConfirmRequest extends AbstractRequest implements RequestInterface
{
    private string $documentId = '';

    public function send(): ResponseInterface
    {
        return $this->sendRequest(
            method: 'POST',
            endpoint: sprintf('documents/%s/confirm', $this->documentId)
        );
    }

    public function setDocumentId(string $documentId): void
    {
        $this->documentId = $documentId;
    }
}
