<?php

declare(strict_types=1);


namespace RaecEdiSDK\Response;

use RaecEdiSDK\Warehouse\WarehouseFactory;

class ReceiveWarehousesResponse extends AbstractResponse implements ResponseInterface
{
    public function getWarehouses(): iterable
    {
        if (false === $this->isSuccess() || !isset($this->data['items']) || empty($this->data['items'])) {
            return;
        }

        foreach ($this->data['items'] as $item) {
            yield WarehouseFactory::create($item);
        }
    }

    public function getPagination(): PaginationResponse
    {
        $pagination = $this->data['pagination'];

        return new PaginationResponse(
            $pagination['totalCount'],
            $pagination['pageCount'],
            $pagination['page'],
            $pagination['perPage']
        );
    }
}
