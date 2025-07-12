<?php

declare(strict_types=1);

namespace App\Admin\Author\Query\GetAuthor;

use App\Entity\Author;
use Doctrine\ORM\EntityManagerInterface;

class GetAuthorHandler
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    public function handler(int $id): GetAuthorResult
    {
        $author = $this->entityManager->find(Author::class, $id);

        return new GetAuthorResult($author);
    }
}
