<?php

declare(strict_types=1);


namespace RaecEdiSDK\Warehouse;

class Warehouse
{
    private string $erpId;

    private string $gln;

    private ?string $name = null;

    private string $type;

    private string $comment = '';

    private ?string $consigneeInn = null;

    private ?string $consigneeKpp = null;

    private ?string $consigneeName = null;

    private ?string $consigneeAddress = null;

    private ?WarehouseAddress $address = null;

    private ?string $coordinates;

    /**
     * @param string $erpId
     * @param string $gln
     * @param string $type
     */
    public function __construct(string $erpId, string $gln, string $type)
    {
        $this->erpId = $erpId;
        $this->gln = $gln;
        $this->type = $type;
    }

    public function setAddress(WarehouseAddress $address): void
    {
        $this->address = $address;
    }

    public function getErpId(): string
    {
        return $this->erpId;
    }

    public function getGln(): string
    {
        return $this->gln;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getComment(): string
    {
        return $this->comment;
    }

    public function getConsigneeInn(): ?string
    {
        return $this->consigneeInn;
    }

    public function getConsigneeKpp(): ?string
    {
        return $this->consigneeKpp;
    }

    public function getConsigneeName(): ?string
    {
        return $this->consigneeName;
    }

    public function getConsigneeAddress(): ?string
    {
        return $this->consigneeAddress;
    }

    public function getAddress(): ?WarehouseAddress
    {
        return $this->address;
    }

    public function getCoordinates(): ?string
    {
        return $this->coordinates;
    }

    public function populate(array $data): void
    {
        $stringProperties = [
            'name',
            'comment',
            'consigneeInn',
            'consigneeKpp',
            'consigneeName',
            'consigneeAddress',
            'coordinates'
        ];

        foreach ($stringProperties as $property) {
            if (isset($data[$property]) && is_scalar($data[$property])) {
                $this->$property = (string) $data[$property];
            }
        }
    }
}
