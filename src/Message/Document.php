<?php

declare(strict_types=1);


namespace RaecEdiSDK\Message;

use DateTime;

class Document
{
    public string $id;

    public string $type;

    public string $state;

    public DateTime $createdAt;

    public ?DateTime $receivedAt = null;

    public MessageInterface $message;

    public bool $isTest;

    public function __construct(
        string $id,
        string $type,
        string $state,
        DateTime $createdAt,
        ?DateTime $receivedAt,
        MessageInterface $message,
        bool $isTest = false
    )
    {
        $this->id = $id;
        $this->type = $type;
        $this->state = $state;
        $this->createdAt = $createdAt;
        $this->receivedAt = $receivedAt;
        $this->message = $message;
        $this->isTest = $isTest;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getReceivedAt(): ?DateTime
    {
        return $this->receivedAt;
    }

    public function getMessage(): MessageInterface
    {
        return $this->message;
    }

    public function isTest(): bool
    {
        return $this->getMessage()->isTest();
    }
}
