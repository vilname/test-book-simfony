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

    public function removeWithBook(int $id): void
    {
        $em = $this->getEntityManager();
        $em->beginTransaction();

        try {
            /** @var Author $author */
            $author = $this->find($id);

            if (empty($author)) {
                return;
            }

            $i = 0;
            $batchSize = 5000;
            $numberBooks = $author->getNumberBooks();
            while ($i < $numberBooks) {
                $em->createQuery(
                    "delete from App\Entity\Book b where b.author = :author"
                )
                    ->setParameter('author', $author)
                    ->setFirstResult($i)
                    ->setMaxResults($batchSize)
                    ->execute();

                $i += $batchSize;
            }

            $em->remove($author);
            $em->flush();

            $em->commit();
        } catch (\Exception $exception) {
            $em->rollback();
        }
    }
}
