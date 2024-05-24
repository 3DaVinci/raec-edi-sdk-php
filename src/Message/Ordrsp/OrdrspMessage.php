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

    protected ?DateTimeImmutable $buyerCreationDateTime = null;

    protected ?string $shipFrom = null;

    protected ?bool $selfDelivery = null;

    protected ?string $pickupPointAddress = null;

    protected ?string $orderType = null;

    protected ?string $projectNumber = null;

    protected ?string $contractNumber = null;

    protected ?string $shipmentAfterCompleteSet = null;

    protected ?string $combineShipmentWithOtherOrders = null;

    protected ?string $buyerComment = null;

    protected ?string $supplierComment = null;

    public function __construct(
        string $supplierGLN,
        string $buyerGLN,
        string $supplierOrderNumber,
        DateTimeImmutable $supplierCreationDateTime,
        string $shipTo
    )
    {
        $this->supplierOrderNumber = $supplierOrderNumber;
        $this->supplierCreationDateTime = $supplierCreationDateTime;
        $this->shipTo = $shipTo;

        parent::__construct(self::TYPE_ORDRSP, $supplierGLN, $buyerGLN);
    }

    public function setBuyerOrderNumber(?string $buyerOrderNumber): OrdrspMessage
    {
        $this->buyerOrderNumber = $buyerOrderNumber;
        return $this;
    }

    public function setBuyerCreationDateTime(?DateTimeImmutable $buyerCreationDateTime): OrdrspMessage
    {
        $this->buyerCreationDateTime = $buyerCreationDateTime;
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

    public function setShipmentAfterCompleteSet(?string $shipmentAfterCompleteSet): OrdrspMessage
    {
        $this->shipmentAfterCompleteSet = $shipmentAfterCompleteSet;
        return $this;
    }

    public function setCombineShipmentWithOtherOrders(?string $combineShipmentWithOtherOrders): OrdrspMessage
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

    public function getBuyerCreationDateTime(): ?DateTimeImmutable
    {
        return $this->buyerCreationDateTime;
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

        if (isset($data['buyerCreationDateTime']) && $data['buyerCreationDateTime']) {
            $this->buyerCreationDateTime = Utils::stringToDateTime($data['buyerCreationDateTime']);
        }
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $data = $this->objectToArray();
        $data['supplierCreationDateTime'] = Utils::dateTimeToString($this->supplierCreationDateTime);

        if ($this->buyerCreationDateTime) {
            $data['buyerOrderCreationDateTime'] = Utils::dateTimeToString($this->buyerCreationDateTime);
        }

        return $data;
    }
}
