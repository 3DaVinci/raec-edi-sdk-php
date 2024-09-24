<?php

declare(strict_types=1);


namespace RaecEdiSDK\Warehouse;


class WarehouseAddress
{
    private string $country;

    private ?string $postalCode = null;

    private string $regionCode;

    private string $regionName;

    private ?string $okatoCode = null;

    private ?string $taxCode = null;

    private ?string $municipality = null;

    private ?string $locality = null;

    private ?string $street = null;

    private ?string $house = null;

    private ?string $building = null;

    private ?string $corpus = null;

    private ?string $unit = null;

    /**
     * @param string $country
     * @param string $regionCode
     * @param string $regionName
     */
    public function __construct(
        string $country,
        string $regionCode,
        string $regionName
    )
    {
        $this->country = $country;
        $this->regionCode = $regionCode;
        $this->regionName = $regionName;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function getRegionCode(): string
    {
        return $this->regionCode;
    }

    public function getRegionName(): string
    {
        return $this->regionName;
    }

    public function getOkatoCode(): ?string
    {
        return $this->okatoCode;
    }

    public function getTaxCode(): ?string
    {
        return $this->taxCode;
    }

    public function getMunicipality(): ?string
    {
        return $this->municipality;
    }

    public function getLocality(): ?string
    {
        return $this->locality;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function getHouse(): ?string
    {
        return $this->house;
    }

    public function getBuilding(): ?string
    {
        return $this->building;
    }

    public function getCorpus(): ?string
    {
        return $this->corpus;
    }

    public function getUnit(): ?string
    {
        return $this->unit;
    }

    public function populate(array $data): void
    {
        $stringProperties = [
            'postalCode',
            'okatoCode',
            'taxCode',
            'municipality',
            'locality',
            'street',
            'house',
            'building',
            'corpus',
            'unit'
        ];

        foreach ($stringProperties as $property) {
            if (isset($data[$property]) && is_scalar($data[$property])) {
                $this->$property = (string) $data[$property];
            }
        }
    }
}
