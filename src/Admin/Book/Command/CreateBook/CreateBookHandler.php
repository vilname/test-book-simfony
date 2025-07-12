<?php

declare(strict_types=1);

namespace App\Admin\Book\Command\CreateBook;

use App\Entity\Author;
use App\Entity\Book;
use Doctrine\ORM\EntityManagerInterface;

class CreateBookHandler
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    public function handler(CreateBookCommand $command): void
    {
        $author = $this->entityManager->find(Author::class, $command->authorId);
        $author->numberBooksIncrement();

        $book = new Book();
        $book->setTitle($command->title);
        $book->setAuthor($author);

        $this->entityManager->persist($book);
        $this->entityManager->flush();
    }
}
