<?php

declare(strict_types=1);


namespace RaecEdiSDK\Request;

use RaecEdiSDK\Message\MessageInterface;
use RaecEdiSDK\Response\ResponseInterface;

class SendDocumentRequest extends AbstractRequest implements RequestInterface
{
    private const ENDPOINT = 'documents';

    protected ?MessageInterface $message = null;

    public function send(): ResponseInterface
    {
        return $this->sendRequest(
            method: 'POST',
            endpoint: self::ENDPOINT,
            requestData: $this->getRequestData()
        );
    }

    public function setMessage(MessageInterface $message): void
    {
        $this->message = $message;
    }

    private function getRequestData(): array
    {
        assert($this->message instanceof MessageInterface);

        return $this->message->jsonSerialize();
    }

    public function validate()
    {
        parent::validate('message');
    }
}
