<?php

declare(strict_types=1);


namespace RaecEdiSDK\Office;

class Office
{
    private string $erpCode;

    private string $gln;

    private string $name;

    private string $comment = '';

    private OfficeAddress $address;

    /** @var OfficeLegalEntity[] */
    private array $legalEntities;

    public function __construct(string $erpCode, string $gln, string $name, OfficeAddress $address, array $legalEntities)
    {
        $this->erpCode = $erpCode;
        $this->gln = $gln;
        $this->name = $name;
        $this->address = $address;
        $this->legalEntities = $legalEntities;
    }

    public function getErpCode(): string
    {
        return $this->erpCode;
    }

    public function getGln(): string
    {
        return $this->gln;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getComment(): string
    {
        return $this->comment;
    }

    public function getAddress(): OfficeAddress
    {
        return $this->address;
    }

    public function getLegalEntities(): array
    {
        return $this->legalEntities;
    }

    public function populate(array $data): void
    {
        $stringProperties = ['comment'];

        foreach ($stringProperties as $property) {
            if (isset($data[$property]) && is_scalar($data[$property])) {
                $this->$property = (string) $data[$property];
            }
        }
    }
}
