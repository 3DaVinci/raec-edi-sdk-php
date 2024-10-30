<?php

declare(strict_types=1);


namespace RaecEdiSDK\Message\Orders;

use DateTimeImmutable;
use JsonSerializable;
use RaecEdiSDK\Exception\InvalidBooleanValueException;
use RaecEdiSDK\Exception\InvalidStringValueException;
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

    protected ?string $buyerProjectNumber = null;

    protected ?string $buyerContactManager = null;

    protected ?string $buyerContactManagerEmail = null;

    protected ?string $buyerContactManagerPhone = null;

    protected ?string $contractNumber = null;

    protected ?bool $shipmentAfterCompleteSet = null;

    protected ?bool $combineShipmentWithOtherOrders = null;

    protected ?string $buyerComment = null;

    public function __construct(
        string $supplierGLN,
        string $buyerGLN,
        string $buyerOrderNumber,
        DateTimeImmutable $buyerOrderCreationDateTime,
        string $shipTo,
        bool $isTest = self::DEFAULT_IS_TEST_VALUE
    )
    {
        $this->buyerOrderNumber = $buyerOrderNumber;
        $this->buyerOrderCreationDateTime = $buyerOrderCreationDateTime;
        $this->shipTo = $shipTo;

        parent::__construct(self::TYPE_ORDERS, $supplierGLN, $buyerGLN, $isTest);
    }

    public function setShipFrom(?string $shipFrom): OrdersMessage
    {
        $this->shipFrom = $shipFrom;
        return $this;
    }

    public function setSelfDelivery(?bool $selfDelivery): OrdersMessage
    {
        $this->selfDelivery = $selfDelivery;
        return $this;
    }

    public function setPickupPointAddress(?string $pickupPointAddress): OrdersMessage
    {
        $this->pickupPointAddress = $pickupPointAddress;
        return $this;
    }

    public function setOrderType(?string $orderType): OrdersMessage
    {
        $this->orderType = $orderType;
        return $this;
    }

    public function setBuyerProjectNumber(?string $buyerProjectNumber): OrdersMessage
    {
        $this->buyerProjectNumber = $buyerProjectNumber;
        return $this;
    }

    public function setBuyerContactManager(?string $buyerContactManager): OrdersMessage
    {
        $this->buyerContactManager = $buyerContactManager;
        return $this;
    }

    public function setBuyerContactManagerEmail(?string $buyerContactManagerEmail): OrdersMessage
    {
        $this->buyerContactManagerEmail = $buyerContactManagerEmail;
        return $this;
    }

    public function setBuyerContactManagerPhone(?string $buyerContactManagerPhone): OrdersMessage
    {
        $this->buyerContactManagerPhone = $buyerContactManagerPhone;
        return $this;
    }

    public function setContractNumber(?string $contractNumber): OrdersMessage
    {
        $this->contractNumber = $contractNumber;
        return $this;
    }

    public function setShipmentAfterCompleteSet(?bool $shipmentAfterCompleteSet): OrdersMessage
    {
        $this->shipmentAfterCompleteSet = $shipmentAfterCompleteSet;
        return $this;
    }

    public function setCombineShipmentWithOtherOrders(?bool $combineShipmentWithOtherOrders): OrdersMessage
    {
        $this->combineShipmentWithOtherOrders = $combineShipmentWithOtherOrders;
        return $this;
    }

    public function setBuyerComment(?string $buyerComment): OrdersMessage
    {
        $this->buyerComment = $buyerComment;
        return $this;
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

    public function getBuyerProjectNumber(): ?string
    {
        return $this->buyerProjectNumber;
    }

    public function getBuyerContactManager(): ?string
    {
        return $this->buyerContactManager;
    }

    public function getBuyerContactManagerEmail(): ?string
    {
        return $this->buyerContactManagerEmail;
    }

    public function getBuyerContactManagerPhone(): ?string
    {
        return $this->buyerContactManagerPhone;
    }

    public function getContractNumber(): ?string
    {
        return $this->contractNumber;
    }

    public function getShipmentAfterCompleteSet(): ?bool
    {
        return $this->shipmentAfterCompleteSet;
    }

    public function getCombineShipmentWithOtherOrders(): ?bool
    {
        return $this->combineShipmentWithOtherOrders;
    }

    public function getBuyerComment(): ?string
    {
        return $this->buyerComment;
    }

    /**
     * @param array<string, mixed> $data
     * @return void
     */
    public function populate(array $data): void
    {
        $stringProperties = [
            'shipFrom',
            'pickupPointAddress',
            'orderType',
            'buyerProjectNumber',
            'buyerContactManager',
            'buyerContactManagerEmail',
            'buyerContactManagerPhone',
            'contractNumber',
            'buyerComment',
        ];

        foreach ($stringProperties as $property) {
            if (isset($data[$property]) && $data[$property]) {
                if (!is_scalar($data[$property])) {
                    throw new InvalidStringValueException($property, gettype($data[$property]));
                }
                $this->$property = (string) $data[$property];
            }
        }

        $boolProperties = [
            'selfDelivery',
            'shipmentAfterCompleteSet',
            'combineShipmentWithOtherOrders',
        ];
        foreach ($boolProperties as $property) {
            if (isset($data[$property]) && $data[$property] !== '') {
                if (!in_array($data[$property], MessageInterface::ALLOW_BOOLEAN_VALUES, true)) {
                    throw new InvalidBooleanValueException($property, (string) $data[$property]);
                }
                $this->$property = (bool) $data[$property];
            }
        }
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $data = $this->objectToArray();
        $data['buyerOrderCreationDateTime'] = Utils::dateTimeToString($this->buyerOrderCreationDateTime);

        $data['items'] = $this->getSerializedItems();

        return $data;
    }
}
