<?php

declare(strict_types=1);


namespace RaecEdiSDK\Response;

use DateTime;
use RaecEdiSDK\Message\Document;
use RaecEdiSDK\Message\MessageFactory;

class ReceiveDocumentsResponse extends AbstractResponse implements ResponseInterface
{
    public function getDocuments(): iterable
    {
        if (false === $this->isSuccess() || !isset($this->data['items']) || empty($this->data['items'])) {
            return;
        }

        foreach ($this->data['items'] as $item) {
            $document = new Document(
                $item['id'],
                $item['type'],
                $item['state'],
                new DateTime($item['createdAt']),
                (isset($item['receivedAt']) && $item['receivedAt']) ? new DateTime($item['receivedAt']) : null,
                MessageFactory::create($item['type'], $item['document']),
            );

            yield $document;
        }
    }
}
