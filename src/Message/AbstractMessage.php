<?php

declare(strict_types=1);


namespace RaecEdiSDK\Message;

abstract class AbstractMessage
{
    protected string $documentType;

    protected string $supplierGLN;

    protected string $buyerGLN;

    /**
     * @var MessageItemInterface[]
     */
    protected array $items = [];

    protected bool $isTest = false;

    /**
     * @param string $documentType
     * @param string $supplierGLN
     * @param string $buyerGLN
     */
    public function __construct(string $documentType, string $supplierGLN, string $buyerGLN)
    {
        $this->documentType = $documentType;
        $this->supplierGLN = $supplierGLN;
        $this->buyerGLN = $buyerGLN;
    }

    public function addItem(MessageItemInterface $item): void
    {
        array_push($this->items, $item);
    }

    /**
     * @return MessageItemInterface[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function getDocumentType(): string
    {
        return $this->documentType;
    }

    public function getSupplierGLN(): string
    {
        return $this->supplierGLN;
    }

    public function getBuyerGLN(): string
    {
        return $this->buyerGLN;
    }

    public function isTest(): bool
    {
        return $this->isTest;
    }

    public function setIsTest(bool $isTest): void
    {
        $this->isTest = $isTest;
    }
}
