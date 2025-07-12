<?php

declare(strict_types=1);

namespace App\Admin\Author\Command\UpdateAuthor;

use App\Entity\Author;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAuthorHandler
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    public function handler(int $id, UpdateAuthorCommand $command)
    {
        $author = $this->entityManager->find(Author::class, $id);
        $author->setFio($command->fio);

        $this->entityManager->persist($author);
        $this->entityManager->flush();
    }
}
