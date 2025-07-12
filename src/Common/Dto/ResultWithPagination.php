<?php

declare(strict_types=1);

namespace App\Common\Dto;

class ResultWithPagination
{
    public array $data;
    public array $pagination;

    public function __construct(array $data, PaginationDto $paginationDto)
    {
        $this->data = $data;
        $this->pagination = [
            'limit' => $paginationDto->getLimit(),
            'page' => $paginationDto->getPage(),
        ];
    }
}
