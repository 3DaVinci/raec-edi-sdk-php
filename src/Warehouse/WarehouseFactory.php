<?php

declare(strict_types=1);


namespace RaecEdiSDK\Warehouse;

abstract class WarehouseFactory
{
    public static function create(array $data): Warehouse
    {
        $warehouse = new Warehouse(
            $data['erpId'],
            $data['gln'],
            $data['type'],
            (string) $data['companyName']
        );
        $warehouse->populate($data);

        if ($addressData = $data['address']) {
            $address = new WarehouseAddress($addressData['country'], $addressData['regionCode'], $addressData['regionName']);
            $address->populate($addressData);
            $warehouse->setAddress($address);
        }

        return $warehouse;
    }
}
