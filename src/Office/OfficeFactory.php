<?php

declare(strict_types=1);


namespace RaecEdiSDK\Office;

class OfficeFactory
{
    public static function create(array $data): Office
    {
        /** @var array{country: string, regionCode: string, regionName: string, locality: string} $addressData */
        $addressData = $data['address'];
        $address = new OfficeAddress(
            $addressData['country'],
            $addressData['regionCode'],
            $addressData['regionName'],
            $addressData['locality']
        );
        $address->populate($addressData);

        $legalEntities = [];
        foreach ($data['legalEntities'] as $legalEntityData) {
            $legalEntities[] = new OfficeLegalEntity(
                $legalEntityData['name'],
                $legalEntityData['gln'],
                $legalEntityData['companyName'] ?? ''
            );
        }

        $office = new Office($data['erpCode'], $data['gln'], $data['name'], $address, $legalEntities);
        $office->populate($data);

        return $office;
    }
}
