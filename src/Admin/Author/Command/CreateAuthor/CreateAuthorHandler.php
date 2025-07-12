<?php

declare(strict_types=1);

namespace App\Admin\Author\Command\CreateAuthor;

use App\Entity\Author;
use Doctrine\ORM\EntityManagerInterface;

class CreateAuthorHandler
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function handler(CreateAuthorCommand $command)
    {
        $author = new Author();
        $author->setFio($command->fio);

        $this->entityManager->persist($author);
        $this->entityManager->flush();
    }
}
