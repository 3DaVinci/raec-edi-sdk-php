<?php

declare(strict_types=1);


namespace RaecEdiSDK\Message\Orders;

use DateTimeImmutable;
use JsonSerializable;
use RaecEdiSDK\Message\MessageItemInterface;
use RaecEdiSDK\Message\ObjectSerializeTrait;
use RaecEdiSDK\Utils;

class OrdersItem implements MessageItemInterface, JsonSerializable
{
    use ObjectSerializeTrait;

    private string $internalSupplierCode;

    private string $buyerProductName;

    private int $buyerRequestedQuantity;

    private string $buyerUnitOfMeasure;

    private int $buyerMultiplicity;

    private ?string $buyerLineNumber = null;

    private ?string $manufacturerCode = null;

    private ?string $brandCode = null;

    private ?string $brandName = null;

    private ?string $raecId = null;

    private ?DateTimeImmutable $buyerRequestedDeliveryDate = null;

    public function __construct(
        string $internalSupplierCode,
        string $buyerProductName,
        int $buyerRequestedQuantity,
        string $buyerUnitOfMeasure,
        int $buyerMultiplicity
    )
    {
        $this->internalSupplierCode = $internalSupplierCode;
        $this->buyerProductName = $buyerProductName;
        $this->buyerRequestedQuantity = $buyerRequestedQuantity;
        $this->buyerUnitOfMeasure = $buyerUnitOfMeasure;
        $this->buyerMultiplicity = $buyerMultiplicity;
    }

    public function setBuyerLineNumber(?string $buyerLineNumber): OrdersItem
    {
        $this->buyerLineNumber = $buyerLineNumber;
        return $this;
    }

    public function setManufacturerCode(?string $manufacturerCode): OrdersItem
    {
        $this->manufacturerCode = $manufacturerCode;
        return $this;
    }

    public function setBrandCode(?string $brandCode): OrdersItem
    {
        $this->brandCode = $brandCode;
        return $this;
    }

    public function setBrandName(?string $brandName): OrdersItem
    {
        $this->brandName = $brandName;
        return $this;
    }

    public function setRaecId(?string $raecId): OrdersItem
    {
        $this->raecId = $raecId;
        return $this;
    }

    public function setBuyerRequestedDeliveryDate(?DateTimeImmutable $buyerRequestedDeliveryDate): OrdersItem
    {
        $this->buyerRequestedDeliveryDate = $buyerRequestedDeliveryDate;
        return $this;
    }

    public function getInternalSupplierCode(): string
    {
        return $this->internalSupplierCode;
    }

    public function getBuyerProductName(): string
    {
        return $this->buyerProductName;
    }

    public function getBuyerRequestedQuantity(): int
    {
        return $this->buyerRequestedQuantity;
    }

    public function getBuyerUnitOfMeasure(): string
    {
        return $this->buyerUnitOfMeasure;
    }

    public function getBuyerMultiplicity(): int
    {
        return $this->buyerMultiplicity;
    }

    public function getBuyerLineNumber(): ?string
    {
        return $this->buyerLineNumber;
    }

    public function getManufacturerCode(): ?string
    {
        return $this->manufacturerCode;
    }

    public function getBrandCode(): ?string
    {
        return $this->brandCode;
    }

    public function getBrandName(): ?string
    {
        return $this->brandName;
    }

    public function getRaecId(): ?string
    {
        return $this->raecId;
    }

    public function getBuyerRequestedDeliveryDate(): ?DateTimeImmutable
    {
        return $this->buyerRequestedDeliveryDate;
    }

    /**
     * @param array<string, mixed> $data
     * @return void
     */
    public function populate(array $data): void
    {
        $stringProperties = [
            'buyerLineNumber',
            'manufacturerCode',
            'brandCode',
            'brandName',
            'raecId',
        ];

        foreach ($stringProperties as $property) {
            if (isset($data[$property]) && is_scalar($data[$property])) {
                $this->$property = (string) $data[$property];
            }
        }
    }

    public function jsonSerialize(): mixed
    {
        $data = $this->objectToArray();

        if ($this->buyerRequestedDeliveryDate) {
            $data['buyerRequestedDeliveryDate'] = Utils::dateToString($this->buyerRequestedDeliveryDate);
        }

        return $data;
    }
}
