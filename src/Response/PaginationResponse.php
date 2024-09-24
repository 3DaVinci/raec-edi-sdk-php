<?php

declare(strict_types=1);


namespace RaecEdiSDK\Response;

class PaginationResponse
{
    private int $totalCount;

    private int $pageCount;

    private int $page;

    private int $perPage;

    /**
     * @param int $totalCount
     * @param int $pageCount
     * @param int $page
     * @param int $perPage
     */
    public function __construct(int $totalCount, int $pageCount, int $page, int $perPage)
    {
        $this->totalCount = $totalCount;
        $this->pageCount = $pageCount;
        $this->page = $page;
        $this->perPage = $perPage;
    }

    public function getTotalCount(): int
    {
        return $this->totalCount;
    }

    public function getPageCount(): int
    {
        return $this->pageCount;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getPerPage(): int
    {
        return $this->perPage;
    }
}
