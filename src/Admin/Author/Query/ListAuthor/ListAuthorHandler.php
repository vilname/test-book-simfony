<?php

declare(strict_types=1);

namespace App\Admin\Author\Query\ListAuthor;

use App\Admin\Author\Repository\AuthorRepository;
use App\Common\Dto\PaginationDto;
use App\Entity\Author;
use Doctrine\ORM\EntityManagerInterface;

class ListAuthorHandler
{
    public function __construct(private AuthorRepository $authorRepository) {}

    /**
     * @param PaginationDto $paginationDto
     * @return ListAuthorResult[]
     */
    public function handler(PaginationDto $paginationDto): array
    {
        $authors = $this->authorRepository->findAllWithPagination($paginationDto);

        return array_map(function (Author $author) {
            return new ListAuthorResult($author);
        }, $authors);
    }
}
