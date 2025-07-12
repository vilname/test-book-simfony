<?php

declare(strict_types=1);

namespace App\Admin\Book\Query\ListBook;

use App\Admin\Book\Repository\BookRepository;
use App\Common\Dto\PaginationDto;
use App\Entity\Book;
use Doctrine\ORM\EntityManagerInterface;

class ListBookHandler
{
    public function __construct(private BookRepository $bookRepository) {}

    /**
     * @param PaginationDto $paginationDto
     * @return ListBookResult[]
     */
    public function handler(PaginationDto $paginationDto): array
    {
        $books = $this->bookRepository->findAllWithPagination($paginationDto);

        return array_map(function (Book $book) {
            return new ListBookResult($book);
        }, $books);
    }
}
