<?php

declare(strict_types=1);


namespace RaecEdiSDK\Response;

use DateTime;
use RaecEdiSDK\Message\Document;
use RaecEdiSDK\Message\MessageFactory;
use RaecEdiSDK\Message\MessageInterface;

class GetDocumentResponse extends AbstractResponse implements ResponseInterface
{
    public function getDocument(): Document
    {
        return new Document(
            $this->data['id'],
            $this->data['type'],
            $this->data['state'],
            DateTime::createFromFormat(MessageInterface::DATE_TIME_FORMAT, $this->data['createdAt']),
            (isset($this->data['receivedAt']) && $this->data['receivedAt']) ? new DateTime($this->data['receivedAt']) : null,
            MessageFactory::create($this->data['type'], $this->data['document']),
            $this->data['isTest'] ?? false
        );
    }
}
