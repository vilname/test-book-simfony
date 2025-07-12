<?php

declare(strict_types=1);

namespace App\Admin\Author\Repository;

use App\Common\Dto\PaginationDto;
use App\Entity\Author;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class AuthorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Author::class);
    }

    public function findAllWithPagination(PaginationDto $paginationDto): array
    {
        return $this->createQueryBuilder("author")
            ->setFirstResult($paginationDto->getOffset())
            ->setMaxResults($paginationDto->getLimit())
            ->getQuery()
            ->getResult();
    }
}
