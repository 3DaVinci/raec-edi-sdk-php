<?php

declare(strict_types=1);


namespace RaecEdiSDK\Request;

use RaecEdiSDK\Exception\ValidateRequestException;
use RaecEdiSDK\Response\ResponseInterface;
use DateTime;

class ReceiveWarehousesRequest extends AbstractRequest implements RequestInterface
{
    private const ENDPOINT = 'warehouses';

    public const DEFAULT_PAGE = 1;
    public const DEFAULT_PER_PAGE = 100;

    protected int $page = self::DEFAULT_PAGE;
    protected int $perPage = self::DEFAULT_PER_PAGE;
    protected ?string $dateFrom = null;

    public function send(): ResponseInterface
    {
        return $this->sendRequest(
            method: 'GET',
            endpoint: self::ENDPOINT,
            queryParameters: ['page' => $this->page, 'perPage' => $this->perPage, 'dateFrom' => $this->dateFrom]
        );
    }

    public function setPage(int $page): void
    {
        $this->page = $page;
    }

    public function setPerPage(int $perPage): void
    {
        if ($perPage >= 1 && $perPage <= 200) {
            $this->perPage = $perPage;
        }
    }

    public function setDateFrom(?string $dateFrom): void
    {
        if ($dateFrom && false === DateTime::createFromFormat('Y.m.d', $dateFrom)) {
            throw new ValidateRequestException(
                'dateFrom',
                'Дата dateFrom должна быть в формате "Y.m.d"'
            );
        }
        $this->dateFrom = $dateFrom;
    }
}
