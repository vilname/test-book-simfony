<?php

declare(strict_types=1);

namespace App\Admin\Book\Repository;

use App\Common\Dto\PaginationDto;
use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    public function findAllWithPagination(PaginationDto $paginationDto): array
    {
        return $this->createQueryBuilder("book")
            ->orderBy('book.id', 'asc')
            ->setFirstResult($paginationDto->getOffset())
            ->setMaxResults($paginationDto->getLimit())
            ->getQuery()
            ->getResult();
    }
}
