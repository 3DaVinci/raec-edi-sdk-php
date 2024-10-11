<?php

declare(strict_types=1);


namespace RaecEdiSDK\Response;

use DateTime;
use RaecEdiSDK\Message\Document;
use RaecEdiSDK\Message\MessageFactory;
use RaecEdiSDK\Message\MessageInterface;

class ReceiveDocumentsResponse extends AbstractResponse implements ResponseInterface
{
    /**
     * @return iterable|Document[]
     * @throws \Exception
     */
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
                DateTime::createFromFormat(MessageInterface::DATE_TIME_FORMAT, $item['createdAt']),
                (isset($item['receivedAt']) && $item['receivedAt'])
                    ? DateTime::createFromFormat(MessageInterface::DATE_TIME_FORMAT, $item['receivedAt'])
                    : null,
                MessageFactory::create($item['type'], $item['document']),
                $item['isTest'] ?? false
            );

            yield $document;
        }
    }
}
