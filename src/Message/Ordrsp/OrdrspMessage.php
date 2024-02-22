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

    protected ?string $selfDelivery = null;

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

    public function getSelfDelivery(): ?string
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
            'selfDelivery',
            'pickupPointAddress',
            'orderType',
            'projectNumber',
            'contractNumber',
            'shipmentAfterCompleteSet',
            'combineShipmentWithOtherOrders',
            'buyerComment',
            'supplierComment',
        ];

        foreach ($stringProperties as $property) {
            if (isset($data[$property]) && is_scalar($data[$property])) {
                $this->$property = (string) $data[$property];
            }
        }

        if (isset($data['buyerCreationDateTime']) && $data['buyerCreationDateTime']) {
            $this->buyerCreationDateTime = Utils::stringToDateTime($data['buyerCreationDateTime']);
        }
    }

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
