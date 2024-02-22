<?php

declare(strict_types=1);


namespace RaecEdiSDK\Message\Invoic;

use DateTimeImmutable;
use JsonSerializable;
use RaecEdiSDK\Message\MessageItemInterface;
use RaecEdiSDK\Message\ObjectSerializeTrait;
use RaecEdiSDK\Utils;

class InvoicItem implements MessageItemInterface, JsonSerializable
{
    use ObjectSerializeTrait;

    private ?string $buyerOrderNumber = null;

    private ?DateTimeImmutable $buyerCreationDateTime = null;

    private string $supplierOrderNumber;

    private DateTimeImmutable $supplierCreationDateTime;

    private ?string $buyerLineNumber = null;

    private ?string $supplierLineNumber = null;

    private string $internalSupplierCode;

    private ?string $manufacturerCode = null;

    private ?string $brandCode = null;

    private ?string $brandName = null;

    private ?string $raecId = null;

    private ?string $supplierProductName = null;

    private string $supplierUnitOfMeasure;

    private int $supplierConfirmedQuantity;

    private float $netAmount;

    private float $netAmountWithVat;

    private int $vatRate;

    private ?float $vatAmount = null;

    private ?string $gtdNumber = null;

    private string $originalCountryIsoCode;

    private ?string $supplierAccountNumber = null;

    private ?DateTimeImmutable $supplierAccountDate = null;

    private ?string $idBuyerDepartmentToReceiveDocuments = null;

    public function __construct(
        string $supplierOrderNumber,
        DateTimeImmutable $supplierCreationDateTime,
        string $internalSupplierCode,
        string $supplierUnitOfMeasure,
        int $supplierConfirmedQuantity,
        float $netAmount,
        float $netAmountWithVat,
        int $vatRate,
        string $originalCountryIsoCode
    )
    {
        $this->supplierOrderNumber = $supplierOrderNumber;
        $this->supplierCreationDateTime = $supplierCreationDateTime;
        $this->internalSupplierCode = $internalSupplierCode;
        $this->supplierUnitOfMeasure = $supplierUnitOfMeasure;
        $this->supplierConfirmedQuantity = $supplierConfirmedQuantity;
        $this->netAmount = $netAmount;
        $this->netAmountWithVat = $netAmountWithVat;
        $this->vatRate = $vatRate;
        $this->originalCountryIsoCode = $originalCountryIsoCode;
    }

    public function getBuyerOrderNumber(): ?string
    {
        return $this->buyerOrderNumber;
    }

    public function getBuyerCreationDateTime(): ?DateTimeImmutable
    {
        return $this->buyerCreationDateTime;
    }

    public function getSupplierOrderNumber(): string
    {
        return $this->supplierOrderNumber;
    }

    public function getSupplierCreationDateTime(): DateTimeImmutable
    {
        return $this->supplierCreationDateTime;
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

    public function getGtdNumber(): ?string
    {
        return $this->gtdNumber;
    }

    public function getOriginalCountryIsoCode(): string
    {
        return $this->originalCountryIsoCode;
    }

    public function getSupplierAccountNumber(): ?string
    {
        return $this->supplierAccountNumber;
    }

    public function getSupplierAccountDate(): ?DateTimeImmutable
    {
        return $this->supplierAccountDate;
    }

    public function getIdBuyerDepartmentToReceiveDocuments(): ?string
    {
        return $this->idBuyerDepartmentToReceiveDocuments;
    }

    /**
     * @param array<string, mixed> $data
     * @return void
     */
    public function populate(array $data): void
    {
        $stringProperties = [
            'buyerOrderNumber',
            'buyerLineNumber',
            'supplierLineNumber',
            'manufacturerCode',
            'brandCode',
            'brandName',
            'raecId',
            'supplierProductName',
            'gtdNumber',
            'supplierAccountNumber',
            'idBuyerDepartmentToReceiveDocuments',
        ];

        foreach ($stringProperties as $property) {
            if (isset($data[$property]) && is_scalar($data[$property])) {
                $this->$property = (string) $data[$property];
            }
        }

        if (isset($data['buyerCreationDateTime']) && $data['buyerCreationDateTime']) {
            $this->buyerCreationDateTime = Utils::stringToDateTime($data['buyerCreationDateTime']);
        }
        if (isset($data['supplierAccountDate']) && $data['supplierAccountDate']) {
            $this->buyerCreationDateTime = Utils::stringToDate($data['supplierAccountDate']);
        }

        if (isset($data['vatAmount']) && $data['vatAmount']) {
            $this->vatAmount = (float) $data['vatAmount'];
        }
    }

    public function jsonSerialize(): mixed
    {
        $data = $this->objectToArray();

        $properties = ['buyerCreationDateTime', 'supplierCreationDateTime'];
        foreach ($properties as $propertyName) {
            if ($this->$propertyName) {
                $data[$propertyName] = Utils::dateTimeToString($this->$propertyName);
            }
        }

        $properties = ['supplierAccountDate'];
        foreach ($properties as $propertyName) {
            if ($this->$propertyName) {
                $data[$propertyName] = Utils::dateToString($this->$propertyName);
            }
        }

        return $data;
    }
}
