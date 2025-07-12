<?php

declare(strict_types=1);

namespace App\Common\Dto;

use App\Common\Constant\PaginationConstant;
use Symfony\Component\HttpFoundation\Request;

class PaginationDto
{
    private int $limit;
    private int $offset;
    private int $page;

    public function pagination(Request $request): static
    {
        $limit = $request->get('limit');
        $page = $request->get('page');

        $limit = intval($limit ?? PaginationConstant::LIMIT);
        $this->page = intval($page ?? PaginationConstant::PAGE);

        $this->offset = ($this->page - 1) * $limit;
        $this->limit = $limit;

        return $this;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function getPage(): int
    {
        return $this->page;
    }
}
