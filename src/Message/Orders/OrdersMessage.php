<?php

declare(strict_types=1);


namespace RaecEdiSDK\Message\Orders;

use DateTimeImmutable;
use JsonSerializable;
use RaecEdiSDK\Message\AbstractMessage;
use RaecEdiSDK\Message\MessageInterface;
use RaecEdiSDK\Message\ObjectSerializeTrait;
use RaecEdiSDK\Utils;

class OrdersMessage extends AbstractMessage implements MessageInterface, JsonSerializable
{
    use ObjectSerializeTrait;

    protected string $buyerOrderNumber;

    protected DateTimeImmutable $buyerOrderCreationDateTime;

    protected string $shipTo;

    protected ?string $shipFrom = null;

    protected ?bool $selfDelivery = null;

    protected ?string $pickupPointAddress = null;

    protected ?string $orderType = null;

    protected ?string $projectNumber = null;

    protected ?string $contractNumber = null;

    protected ?bool $shipmentAfterCompleteSet = null;

    protected ?bool $combineShipmentWithOtherOrders = null;

    protected ?string $buyerComment = null;

    public function __construct(
        string $supplierGLN,
        string $buyerGLN,
        string $buyerOrderNumber,
        DateTimeImmutable $buyerOrderCreationDateTime,
        string $shipTo
    )
    {
        $this->buyerOrderNumber = $buyerOrderNumber;
        $this->buyerOrderCreationDateTime = $buyerOrderCreationDateTime;
        $this->shipTo = $shipTo;

        parent::__construct(self::TYPE_ORDERS, $supplierGLN, $buyerGLN);
    }

    public function getBuyerOrderNumber(): string
    {
        return $this->buyerOrderNumber;
    }

    public function getBuyerOrderCreationDateTime(): DateTimeImmutable
    {
        return $this->buyerOrderCreationDateTime;
    }

    public function getShipTo(): string
    {
        return $this->shipTo;
    }

    public function getShipFrom(): ?string
    {
        return $this->shipFrom;
    }

    public function setShipFrom(?string $shipFrom): OrdersMessage
    {
        $this->shipFrom = $shipFrom;
        return $this;
    }

    public function getSelfDelivery(): ?bool
    {
        return $this->selfDelivery;
    }

    public function setSelfDelivery(?bool $selfDelivery): OrdersMessage
    {
        $this->selfDelivery = $selfDelivery;
        return $this;
    }

    public function getPickupPointAddress(): ?string
    {
        return $this->pickupPointAddress;
    }

    public function setPickupPointAddress(?string $pickupPointAddress): OrdersMessage
    {
        $this->pickupPointAddress = $pickupPointAddress;
        return $this;
    }

    public function getOrderType(): ?string
    {
        return $this->orderType;
    }

    public function setOrderType(?string $orderType): OrdersMessage
    {
        $this->orderType = $orderType;
        return $this;
    }

    public function getProjectNumber(): ?string
    {
        return $this->projectNumber;
    }

    public function setProjectNumber(?string $projectNumber): OrdersMessage
    {
        $this->projectNumber = $projectNumber;
        return $this;
    }

    public function getContractNumber(): ?string
    {
        return $this->contractNumber;
    }

    public function setContractNumber(?string $contractNumber): OrdersMessage
    {
        $this->contractNumber = $contractNumber;
        return $this;
    }

    public function getShipmentAfterCompleteSet(): ?bool
    {
        return $this->shipmentAfterCompleteSet;
    }

    public function setShipmentAfterCompleteSet(?bool $shipmentAfterCompleteSet): OrdersMessage
    {
        $this->shipmentAfterCompleteSet = $shipmentAfterCompleteSet;
        return $this;
    }

    public function getCombineShipmentWithOtherOrders(): ?bool
    {
        return $this->combineShipmentWithOtherOrders;
    }

    public function setCombineShipmentWithOtherOrders(?bool $combineShipmentWithOtherOrders): OrdersMessage
    {
        $this->combineShipmentWithOtherOrders = $combineShipmentWithOtherOrders;
        return $this;
    }

    public function getBuyerComment(): ?string
    {
        return $this->buyerComment;
    }

    public function setBuyerComment(?string $buyerComment): OrdersMessage
    {
        $this->buyerComment = $buyerComment;
        return $this;
    }

    public function jsonSerialize(): array
    {
        $data = $this->objectToArray();
        $data['buyerOrderCreationDateTime'] = Utils::dateTimeToString($this->buyerOrderCreationDateTime);

        return $data;
    }
}
