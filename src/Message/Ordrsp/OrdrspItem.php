<?php

declare(strict_types=1);


namespace RaecEdiSDK\Message\Ordrsp;

use DateTimeImmutable;
use JsonSerializable;
use RaecEdiSDK\Message\MessageItemInterface;
use RaecEdiSDK\Message\ObjectSerializeTrait;
use RaecEdiSDK\Utils;

class OrdrspItem implements MessageItemInterface, JsonSerializable
{
    use ObjectSerializeTrait;

    public ?string $buyerLineNumber = null;

    public ?string $supplierLineNumber = null;

    public string $internalSupplierCode;

    public ?string $manufacturerCode = null;

    public ?string $brandCode = null;

    public ?string $brandName = null;

    public ?string $raecId = null;

    public ?string $supplierProductName = null;

    public string $supplierUnitOfMeasure;

    public string $supplierMultiplicity;

    public int $supplierConfirmedQuantity;

    public float $netAmount;

    public float $netAmountWithVat;

    public int $vatRate;

    public ?float $vatAmount = null;

    public ?DateTimeImmutable $supplierEstimatedDeliveryDate = null;

    public ?string $dividedIntoSeveralDeliveries = null;

    public ?string $supplierLineComment = null;

    public ?string $totalNetAmount = null;

    public ?float $totalNetAmountWithVat = null;

    public ?float $totalVatAmount = null;

    public function __construct(
        string $internalSupplierCode,
        string $supplierUnitOfMeasure,
        string $supplierMultiplicity,
        int $supplierConfirmedQuantity,
        float $netAmount,
        float $netAmountWithVat,
        int $vatRate
    )
    {
        $this->internalSupplierCode = $internalSupplierCode;
        $this->supplierUnitOfMeasure = $supplierUnitOfMeasure;
        $this->supplierMultiplicity = $supplierMultiplicity;
        $this->supplierConfirmedQuantity = $supplierConfirmedQuantity;
        $this->netAmount = $netAmount;
        $this->netAmountWithVat = $netAmountWithVat;
        $this->vatRate = $vatRate;
    }

    public function getBuyerLineNumber(): ?string
    {
        return $this->buyerLineNumber;
    }

    public function getSupplierLineNumber(): ?string
    {
        return $this->supplierLineNumber;
    }

    public function getInternalSupplierCode(): string
    {
        return $this->internalSupplierCode;
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

    public function getSupplierProductName(): ?string
    {
        return $this->supplierProductName;
    }

    public function getSupplierUnitOfMeasure(): string
    {
        return $this->supplierUnitOfMeasure;
    }

    public function getSupplierMultiplicity(): string
    {
        return $this->supplierMultiplicity;
    }

    public function getSupplierConfirmedQuantity(): int
    {
        return $this->supplierConfirmedQuantity;
    }

    public function getNetAmount(): float
    {
        return $this->netAmount;
    }

    public function getNetAmountWithVat(): float
    {
        return $this->netAmountWithVat;
    }

    public function getVatRate(): int
    {
        return $this->vatRate;
    }

    public function getVatAmount(): ?float
    {
        return $this->vatAmount;
    }

    public function getSupplierEstimatedDeliveryDate(): ?DateTimeImmutable
    {
        return $this->supplierEstimatedDeliveryDate;
    }

    public function getDividedIntoSeveralDeliveries(): ?string
    {
        return $this->dividedIntoSeveralDeliveries;
    }

    public function getSupplierLineComment(): ?string
    {
        return $this->supplierLineComment;
    }

    public function getTotalNetAmount(): ?string
    {
        return $this->totalNetAmount;
    }

    public function getTotalNetAmountWithVat(): ?float
    {
        return $this->totalNetAmountWithVat;
    }

    public function getTotalVatAmount(): ?float
    {
        return $this->totalVatAmount;
    }

    /**
     * @param array<string, mixed> $data
     * @return void
     */
    public function populate(array $data): void
    {
        $stringProperties = [
            'buyerLineNumber',
            'supplierLineNumber',
            'manufacturerCode',
            'brandCode',
            'brandName',
            'raecId',
            'supplierProductName',
            'dividedIntoSeveralDeliveries',
            'supplierLineComment',
        ];

        foreach ($stringProperties as $property) {
            if (isset($data[$property]) && is_scalar($data[$property])) {
                $this->$property = (string) $data[$property];
            }
        }

        $floatProperties = [
            'vatAmount',
            'totalNetAmount',
            'totalNetAmountWithVat',
            'totalVatAmount',
        ];

        foreach ($floatProperties as $property) {
            if (isset($data[$property]) && is_numeric($data[$property])) {
                $this->$property = (float) $data[$property];
            }
        }

        if (isset($data['supplierEstimatedDeliveryDate']) && $data['supplierEstimatedDeliveryDate']) {
            $this->buyerCreationDateTime = Utils::stringToDate($data['supplierEstimatedDeliveryDate']);
        }
    }

    public function jsonSerialize(): mixed
    {
        $data = $this->objectToArray();

        if ($this->supplierEstimatedDeliveryDate) {
            $data['supplierEstimatedDeliveryDate'] = Utils::dateToString($this->supplierEstimatedDeliveryDate);
        }

        return $data;
    }
}
