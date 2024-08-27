<?php

declare(strict_types=1);


namespace RaecEdiSDK\Message\Ordrsp;

use DateTimeImmutable;
use JsonSerializable;
use RaecEdiSDK\Message\AbstractMessage;
use RaecEdiSDK\Message\MessageInterface;
use RaecEdiSDK\Message\ObjectSerializeTrait;
use RaecEdiSDK\Utils;

class OrdrspMessage extends AbstractMessage implements MessageInterface, JsonSerializable
{
    use ObjectSerializeTrait;

    protected string $supplierOrderNumber;

    protected DateTimeImmutable $supplierCreationDateTime;

    protected string $shipTo;

    protected ?string $buyerOrderNumber = null;

    protected ?DateTimeImmutable $buyerOrderCreationDateTime = null;

    protected ?string $shipFrom = null;

    protected ?bool $selfDelivery = null;

    protected ?string $pickupPointAddress = null;

    protected ?string $orderType = null;

    protected ?string $projectNumber = null;

    protected ?string $contractNumber = null;

    protected ?bool $shipmentAfterCompleteSet = null;

    protected ?bool $combineShipmentWithOtherOrders = null;

    protected ?string $buyerComment = null;

    protected ?string $supplierComment = null;

    protected ?float $totalNetAmount = null;

    protected ?float $totalNetAmountWithVat = null;

    protected ?float $totalVatAmount = null;

    protected ?string $currencyIsoCode = null;

    public function __construct(
        string $supplierGLN,
        string $buyerGLN,
        string $supplierOrderNumber,
        DateTimeImmutable $supplierCreationDateTime,
        string $shipTo,
        bool $isTest = self::DEFAULT_IS_TEST_VALUE
    )
    {
        $this->supplierOrderNumber = $supplierOrderNumber;
        $this->supplierCreationDateTime = $supplierCreationDateTime;
        $this->shipTo = $shipTo;

        parent::__construct(self::TYPE_ORDRSP, $supplierGLN, $buyerGLN, $isTest);
    }

    public function setBuyerOrderNumber(?string $buyerOrderNumber): OrdrspMessage
    {
        $this->buyerOrderNumber = $buyerOrderNumber;
        return $this;
    }

    public function setBuyerOrderCreationDateTime(?DateTimeImmutable $buyerOrderCreationDateTime): OrdrspMessage
    {
        $this->buyerOrderCreationDateTime = $buyerOrderCreationDateTime;
        return $this;
    }

    public function setShipFrom(?string $shipFrom): OrdrspMessage
    {
        $this->shipFrom = $shipFrom;
        return $this;
    }

    public function setSelfDelivery(?bool $selfDelivery): OrdrspMessage
    {
        $this->selfDelivery = $selfDelivery;
        return $this;
    }

    public function setPickupPointAddress(?string $pickupPointAddress): OrdrspMessage
    {
        $this->pickupPointAddress = $pickupPointAddress;
        return $this;
    }

    public function setOrderType(?string $orderType): OrdrspMessage
    {
        $this->orderType = $orderType;
        return $this;
    }

    public function setProjectNumber(?string $projectNumber): OrdrspMessage
    {
        $this->projectNumber = $projectNumber;
        return $this;
    }

    public function setContractNumber(?string $contractNumber): OrdrspMessage
    {
        $this->contractNumber = $contractNumber;
        return $this;
    }

    public function setShipmentAfterCompleteSet(?bool $shipmentAfterCompleteSet): OrdrspMessage
    {
        $this->shipmentAfterCompleteSet = $shipmentAfterCompleteSet;
        return $this;
    }

    public function setCombineShipmentWithOtherOrders(?bool $combineShipmentWithOtherOrders): OrdrspMessage
    {
        $this->combineShipmentWithOtherOrders = $combineShipmentWithOtherOrders;
        return $this;
    }

    public function setBuyerComment(?string $buyerComment): OrdrspMessage
    {
        $this->buyerComment = $buyerComment;
        return $this;
    }

    public function setSupplierComment(?string $supplierComment): OrdrspMessage
    {
        $this->supplierComment = $supplierComment;
        return $this;
    }

    public function setTotalNetAmount(?float $totalNetAmount): OrdrspMessage
    {
        $this->totalNetAmount = $totalNetAmount;
        return $this;
    }

    public function setTotalNetAmountWithVat(?float $totalNetAmountWithVat): OrdrspMessage
    {
        $this->totalNetAmountWithVat = $totalNetAmountWithVat;
        return $this;
    }

    public function setTotalVatAmount(?float $totalVatAmount): OrdrspMessage
    {
        $this->totalVatAmount = $totalVatAmount;
        return $this;
    }

    public function getSupplierOrderNumber(): string
    {
        return $this->supplierOrderNumber;
    }

    public function getSupplierCreationDateTime(): DateTimeImmutable
    {
        return $this->supplierCreationDateTime;
    }

    public function getShipTo(): string
    {
        return $this->shipTo;
    }

    public function getBuyerOrderNumber(): ?string
    {
        return $this->buyerOrderNumber;
    }

    public function getBuyerOrderCreationDateTime(): ?DateTimeImmutable
    {
        return $this->buyerOrderCreationDateTime;
    }

    public function getShipFrom(): ?string
    {
        return $this->shipFrom;
    }

    public function getSelfDelivery(): ?bool
    {
        return $this->selfDelivery;
    }

    public function getPickupPointAddress(): ?string
    {
        return $this->pickupPointAddress;
    }

    public function getOrderType(): ?string
    {
        return $this->orderType;
    }

    public function getProjectNumber(): ?string
    {
        return $this->projectNumber;
    }

    public function getContractNumber(): ?string
    {
        return $this->contractNumber;
    }

    public function getShipmentAfterCompleteSet(): ?string
    {
        return $this->shipmentAfterCompleteSet;
    }

    public function getCombineShipmentWithOtherOrders(): ?string
    {
        return $this->combineShipmentWithOtherOrders;
    }

    public function getBuyerComment(): ?string
    {
        return $this->buyerComment;
    }

    public function getSupplierComment(): ?string
    {
        return $this->supplierComment;
    }

    public function getTotalNetAmount(): ?float
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

    public function getCurrencyIsoCode(): ?string
    {
        return $this->currencyIsoCode;
    }

    /**
     * @param array<string, mixed> $data
     * @return void
     */
    public function populate(array $data): void
    {
        $stringProperties = [
            'buyerOrderNumber',
            'shipFrom',
            'pickupPointAddress',
            'orderType',
            'projectNumber',
            'contractNumber',
            'buyerComment',
            'supplierComment',
            'currencyIsoCode',
        ];

        foreach ($stringProperties as $property) {
            if (isset($data[$property]) && is_scalar($data[$property])) {
                $this->$property = (string) $data[$property];
            }
        }

        $boolProperties = [
            'selfDelivery',
            'shipmentAfterCompleteSet',
            'combineShipmentWithOtherOrders',
        ];
        foreach ($boolProperties as $property) {
            if (isset($data[$property])) {
                $this->$property = (bool) $data[$property];
            }
        }

        $floatProperties = [
            'totalNetAmount',
            'totalNetAmountWithVat',
            'totalVatAmount',
        ];

        foreach ($floatProperties as $property) {
            if (isset($data[$property]) && is_numeric($data[$property])) {
                $this->$property = (float) $data[$property];
            }
        }

        if (isset($data['buyerOrderCreationDateTime']) && $data['buyerOrderCreationDateTime']) {
            $this->buyerOrderCreationDateTime = Utils::stringToDateTime($data['buyerOrderCreationDateTime']);
        }
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $data = $this->objectToArray();
        $data['supplierCreationDateTime'] = Utils::dateTimeToString($this->supplierCreationDateTime);

        if ($this->buyerOrderCreationDateTime) {
            $data['buyerOrderCreationDateTime'] = Utils::dateTimeToString($this->buyerOrderCreationDateTime);
        }

        return $data;
    }
}
