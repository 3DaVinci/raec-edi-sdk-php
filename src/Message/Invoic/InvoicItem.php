<?php

declare(strict_types=1);


namespace RaecEdiSDK\Message\Invoic;

use DateTimeImmutable;
use JsonSerializable;
use RaecEdiSDK\Exception\InvalidNumberValueException;
use RaecEdiSDK\Message\MessageItemInterface;
use RaecEdiSDK\Message\MessagePopulateTrait;
use RaecEdiSDK\Message\ObjectSerializeTrait;
use RaecEdiSDK\Utils;

class InvoicItem implements MessageItemInterface, JsonSerializable
{
    use ObjectSerializeTrait;
    use MessagePopulateTrait;

    protected ?string $buyerOrderNumber = null;

    protected ?DateTimeImmutable $buyerOrderCreationDateTime = null;

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

    protected ?float $netAmountWithVat;

    protected int $vatRate;

    protected float $vatAmount;

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
        int $vatRate,
        string $originalCountryIsoCode,
        float $vatAmount
    )
    {
        $this->supplierOrderNumber = $supplierOrderNumber;
        $this->supplierCreationDateTime = $supplierCreationDateTime;
        $this->internalSupplierCode = $internalSupplierCode;
        $this->supplierUnitOfMeasure = $supplierUnitOfMeasure;
        $this->supplierConfirmedQuantity = $supplierConfirmedQuantity;
        $this->netAmount = $netAmount;
        $this->vatRate = $vatRate;
        $this->originalCountryIsoCode = $originalCountryIsoCode;
        $this->vatAmount = $vatAmount;
    }

    public function setBuyerOrderNumber(?string $buyerOrderNumber): InvoicItem
    {
        $this->buyerOrderNumber = $buyerOrderNumber;
        return $this;
    }

    public function setBuyerOrderCreationDateTime(?DateTimeImmutable $buyerOrderCreationDateTime): InvoicItem
    {
        $this->buyerOrderCreationDateTime = $buyerOrderCreationDateTime;
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

    public function setNetAmountWithVat(?float $netAmountWithVat): InvoicItem
    {
        $this->netAmountWithVat = $netAmountWithVat;
        return $this;
    }

    public function getBuyerOrderNumber(): ?string
    {
        return $this->buyerOrderNumber;
    }

    public function getBuyerOrderCreationDateTime(): ?DateTimeImmutable
    {
        return $this->buyerOrderCreationDateTime;
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

    public function getNetAmountWithVat(): ?float
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
        $this->setStringProperties($stringProperties, $data, isItem: true);

        if (isset($data['buyerOrderCreationDateTime']) && $data['buyerOrderCreationDateTime']) {
            $this->buyerOrderCreationDateTime = Utils::stringToDateTime((string) $data['buyerOrderCreationDateTime'], 'item.buyerOrderCreationDateTime');
        }
        if (isset($data['supplierAccountDate']) && $data['supplierAccountDate']) {
            $this->buyerOrderCreationDateTime = Utils::stringToDate((string) $data['supplierAccountDate'], 'item.supplierAccountDate');
        }

        if (isset($data['brandCode']) && $data['brandCode']) {
            if (!is_numeric($data['brandCode'])) {
                throw new InvalidNumberValueException('item.'.$data['brandCode'], gettype($data['brandCode']));
            }
            $this->brandCode = (int) $data['brandCode'];
        }

        if (isset($data['netAmountWithVat']) && $data['netAmountWithVat']) {
            if (!is_numeric($data['netAmountWithVat'])) {
                throw new InvalidNumberValueException('item.'.$data['netAmountWithVat'], gettype($data['netAmountWithVat']));
            }
            $this->netAmountWithVat = (float) $data['netAmountWithVat'];
        }
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $data = $this->objectToArray();

        $properties = ['buyerOrderCreationDateTime', 'supplierCreationDateTime'];
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
