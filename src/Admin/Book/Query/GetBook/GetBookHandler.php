<?php

declare(strict_types=1);

namespace App\Admin\Book\Query\GetBook;

use App\Entity\Book;
use Doctrine\ORM\EntityManagerInterface;

class GetBookHandler
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    public function handler(int $id): GetBookResult
    {
        $book = $this->entityManager->find(Book::class, $id);

        return new GetBookResult($book);
    }
}
