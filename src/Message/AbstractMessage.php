<?php

declare(strict_types=1);


namespace RaecEdiSDK\Message;

use JsonSerializable;

abstract class AbstractMessage
{
    public const DEFAULT_IS_TEST_VALUE = false;

    protected string $documentType;

    protected string $supplierGLN;

    protected string $buyerGLN;

    /**
     * @var MessageItemInterface[]
     */
    protected array $items = [];

    protected bool $isTest;

    /**
     * @param string $documentType
     * @param string $supplierGLN
     * @param string $buyerGLN
     * @param bool $isTest
     */
    public function __construct(
        string $documentType,
        string $supplierGLN,
        string $buyerGLN,
        bool $isTest = AbstractMessage::DEFAULT_IS_TEST_VALUE
    )
    {
        $this->documentType = $documentType;
        $this->supplierGLN = $supplierGLN;
        $this->buyerGLN = $buyerGLN;
        $this->isTest = $isTest;
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

    /**
     * @return MessageItemInterface[]
     */
    protected function getSerializedItems(): array
    {
        $items = [];
        /** @var JsonSerializable $item */
        foreach ($this->items as $item) {
            array_push($items, $item->jsonSerialize());
        }

        return $items;
    }
}
