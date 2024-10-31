<?php

declare(strict_types=1);


namespace RaecEdiSDK\Message\Ordrsp;

use DateTimeImmutable;
use JsonSerializable;
use RaecEdiSDK\Exception\InvalidNumberValueException;
use RaecEdiSDK\Message\MessageItemInterface;
use RaecEdiSDK\Message\MessagePopulateTrait;
use RaecEdiSDK\Message\ObjectSerializeTrait;
use RaecEdiSDK\Utils;

class OrdrspItem implements MessageItemInterface, JsonSerializable
{
    use ObjectSerializeTrait;
    use MessagePopulateTrait;

    protected ?string $buyerLineNumber = null;

    protected ?string $supplierLineNumber = null;

    protected string $internalSupplierCode;

    protected ?string $manufacturerCode = null;

    protected ?int $brandCode = null;

    protected ?string $brandName = null;

    protected ?string $raecId = null;

    protected ?string $supplierProductName = null;

    protected string $supplierUnitOfMeasure;

    protected string $supplierMultiplicity;

    protected int $supplierConfirmedQuantity;

    protected float $netAmount;

    protected int $vatRate;

    protected float $vatAmount;

    protected ?float $netAmountWithVat;

    protected ?DateTimeImmutable $supplierEstimatedDeliveryDate = null;

    protected ?bool $supplierEstimatedDeliveryDateNotSpecified = null;

    protected ?bool $dividedIntoSeveralDeliveries = null;

    protected ?string $supplierLineComment = null;


    public function __construct(
        string $internalSupplierCode,
        string $supplierUnitOfMeasure,
        string $supplierMultiplicity,
        int $supplierConfirmedQuantity,
        float $netAmount,
        int $vatRate,
        float $vatAmount
    )
    {
        $this->internalSupplierCode = $internalSupplierCode;
        $this->supplierUnitOfMeasure = $supplierUnitOfMeasure;
        $this->supplierMultiplicity = $supplierMultiplicity;
        $this->supplierConfirmedQuantity = $supplierConfirmedQuantity;
        $this->netAmount = $netAmount;
        $this->vatRate = $vatRate;
        $this->vatAmount = $vatAmount;

    }

    public function setBuyerLineNumber(?string $buyerLineNumber): OrdrspItem
    {
        $this->buyerLineNumber = $buyerLineNumber;
        return $this;
    }

    public function setSupplierLineNumber(?string $supplierLineNumber): OrdrspItem
    {
        $this->supplierLineNumber = $supplierLineNumber;
        return $this;
    }

    public function setManufacturerCode(?string $manufacturerCode): OrdrspItem
    {
        $this->manufacturerCode = $manufacturerCode;
        return $this;
    }

    public function setBrandCode(?int $brandCode): OrdrspItem
    {
        $this->brandCode = $brandCode;
        return $this;
    }

    public function setBrandName(?string $brandName): OrdrspItem
    {
        $this->brandName = $brandName;
        return $this;
    }

    public function setRaecId(?string $raecId): OrdrspItem
    {
        $this->raecId = $raecId;
        return $this;
    }

    public function setSupplierProductName(?string $supplierProductName): OrdrspItem
    {
        $this->supplierProductName = $supplierProductName;
        return $this;
    }

    public function setSupplierEstimatedDeliveryDate(?DateTimeImmutable $supplierEstimatedDeliveryDate): OrdrspItem
    {
        $this->supplierEstimatedDeliveryDate = $supplierEstimatedDeliveryDate;
        return $this;
    }

    public function setSupplierEstimatedDeliveryDateNotSpecified(?bool $supplierEstimatedDeliveryDateNotSpecified): OrdrspItem
    {
        $this->supplierEstimatedDeliveryDateNotSpecified = $supplierEstimatedDeliveryDateNotSpecified;
        return $this;
    }

    public function setDividedIntoSeveralDeliveries(?bool $dividedIntoSeveralDeliveries): OrdrspItem
    {
        $this->dividedIntoSeveralDeliveries = $dividedIntoSeveralDeliveries;
        return $this;
    }

    public function setSupplierLineComment(?string $supplierLineComment): OrdrspItem
    {
        $this->supplierLineComment = $supplierLineComment;
        return $this;
    }

    public function setNetAmountWithVat(?float $netAmountWithVat): OrdrspItem
    {
        $this->netAmountWithVat = $netAmountWithVat;
        return $this;
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

    public function getSupplierEstimatedDeliveryDate(): ?DateTimeImmutable
    {
        return $this->supplierEstimatedDeliveryDate;
    }

    public function getSupplierEstimatedDeliveryDateNotSpecified(): ?bool
    {
        return $this->supplierEstimatedDeliveryDateNotSpecified;
    }

    public function getDividedIntoSeveralDeliveries(): ?bool
    {
        return $this->dividedIntoSeveralDeliveries;
    }

    public function getSupplierLineComment(): ?string
    {
        return $this->supplierLineComment;
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
            'brandName',
            'raecId',
            'supplierProductName',
            'supplierLineComment',
        ];
        $this->setStringProperties($stringProperties, $data, isItem: true);

        $boolProperties = ['dividedIntoSeveralDeliveries', 'supplierEstimatedDeliveryDateNotSpecified'];
        $this->setBooleanProperties($boolProperties, $data, isItem: true);

        if (isset($data['brandCode']) && $data['brandCode']) {
            if (!is_numeric($data['brandCode'])) {
                throw new InvalidNumberValueException('item.brandCode', gettype($data['brandCode']).': '.$data['brandCode']);
            }
            $this->brandCode = (int) $data['brandCode'];
        }

        if (isset($data['netAmountWithVat']) && $data['netAmountWithVat']) {
            if (!is_numeric($data['netAmountWithVat'])) {
                throw new InvalidNumberValueException('item.netAmountWithVat', gettype($data['netAmountWithVat']).': '.$data['netAmountWithVat']);
            }
            $this->netAmountWithVat = (float) $data['netAmountWithVat'];
        }

        if (isset($data['supplierEstimatedDeliveryDate']) && $data['supplierEstimatedDeliveryDate']) {
            $this->supplierEstimatedDeliveryDate = Utils::stringToDate((string) $data['supplierEstimatedDeliveryDate'], 'supplierEstimatedDeliveryDate');
        }
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $data = $this->objectToArray();

        if ($this->supplierEstimatedDeliveryDate) {
            $data['supplierEstimatedDeliveryDate'] = Utils::dateToString($this->supplierEstimatedDeliveryDate);
        }

        return $data;
    }
}
