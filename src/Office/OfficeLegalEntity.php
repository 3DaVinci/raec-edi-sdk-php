<?php

declare(strict_types=1);


namespace RaecEdiSDK\Office;

class OfficeLegalEntity
{
    private string $name;

    private string $gln;

    private string $companyName;

    /**
     * @param string $name
     * @param string $gln
     * @param string $companyName
     */
    public function __construct(string $name, string $gln, string $companyName)
    {
        $this->name = $name;
        $this->gln = $gln;
        $this->companyName = $companyName;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getGln(): string
    {
        return $this->gln;
    }

    public function getCompanyName(): string
    {
        return $this->companyName;
    }
}
