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

    protected ?string $buyerOrderNumber = null;

    protected ?DateTimeImmutable $buyerCreationDateTime = null;

    protected string $supplierOrderNumber;

    protected DateTimeImmutable $supplierCreationDateTime;

    protected ?string $buyerLineNumber = null;

    protected ?string $supplierLineNumber = null;

    protected string $internalSupplierCode;

    protected ?string $manufacturerCode = null;

    protected ?int $brandCode = null;

    protected ?string $brandName = null;

    protected ?string $raecId = null;

    protected ?string $supplierProductName = null;

    protected string $supplierUnitOfMeasure;

    protected int $supplierConfirmedQuantity;

    protected float $netAmount;

    protected float $netAmountWithVat;

    protected int $vatRate;

    protected ?float $vatAmount = null;

    protected ?string $gtdNumber = null;

    protected string $originalCountryIsoCode;

    protected ?string $supplierAccountNumber = null;

    protected ?DateTimeImmutable $supplierAccountDate = null;

    protected ?string $idBuyerDepartmentToReceiveDocuments = null;

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

    public function setBuyerOrderNumber(?string $buyerOrderNumber): InvoicItem
    {
        $this->buyerOrderNumber = $buyerOrderNumber;
        return $this;
    }

    public function setBuyerCreationDateTime(?DateTimeImmutable $buyerCreationDateTime): InvoicItem
    {
        $this->buyerCreationDateTime = $buyerCreationDateTime;
        return $this;
    }

    public function setBuyerLineNumber(?string $buyerLineNumber): InvoicItem
    {
        $this->buyerLineNumber = $buyerLineNumber;
        return $this;
    }

    public function setSupplierLineNumber(?string $supplierLineNumber): InvoicItem
    {
        $this->supplierLineNumber = $supplierLineNumber;
        return $this;
    }

    public function setManufacturerCode(?string $manufacturerCode): InvoicItem
    {
        $this->manufacturerCode = $manufacturerCode;
        return $this;
    }

    public function setBrandCode(?int $brandCode): InvoicItem
    {
        $this->brandCode = $brandCode;
        return $this;
    }

    public function setBrandName(?string $brandName): InvoicItem
    {
        $this->brandName = $brandName;
        return $this;
    }

    public function setRaecId(?string $raecId): InvoicItem
    {
        $this->raecId = $raecId;
        return $this;
    }

    public function setSupplierProductName(?string $supplierProductName): InvoicItem
    {
        $this->supplierProductName = $supplierProductName;
        return $this;
    }

    public function setVatAmount(?float $vatAmount): InvoicItem
    {
        $this->vatAmount = $vatAmount;
        return $this;
    }

    public function setGtdNumber(?string $gtdNumber): InvoicItem
    {
        $this->gtdNumber = $gtdNumber;
        return $this;
    }

    public function setSupplierAccountNumber(?string $supplierAccountNumber): InvoicItem
    {
        $this->supplierAccountNumber = $supplierAccountNumber;
        return $this;
    }

    public function setSupplierAccountDate(?DateTimeImmutable $supplierAccountDate): InvoicItem
    {
        $this->supplierAccountDate = $supplierAccountDate;
        return $this;
    }

    public function setIdBuyerDepartmentToReceiveDocuments(?string $idBuyerDepartmentToReceiveDocuments): InvoicItem
    {
        $this->idBuyerDepartmentToReceiveDocuments = $idBuyerDepartmentToReceiveDocuments;
        return $this;
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

    public function getBrandCode(): ?int
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

        if (isset($data['brandCode']) && $data['brandCode']) {
            $this->brandCode = (int) $data['brandCode'];
        }
        if (isset($data['vatAmount']) && $data['vatAmount']) {
            $this->vatAmount = (float) $data['vatAmount'];
        }
    }


    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
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
