<?php

declare(strict_types=1);

namespace App\Api\V1\Book\Command\UpdateBook;

use App\Entity\Author;
use App\Entity\Book;
use Doctrine\ORM\EntityManagerInterface;

class UpdateBookHandler
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    public function handler(int $id, UpdateBookCommand $command): void
    {
        $book = $this->entityManager->find(Book::class, $id);
        $book->setTitle($command->title);

        if ($book->getAuthor()->getId() != $command->authorId) {
            $oldAuthor = $book->getAuthor();
            $oldAuthor->numberBooksDecrement();
            $newAuthor = $this->entityManager->find(Author::class, $command->authorId);
            $newAuthor->numberBooksIncrement();

            $book->setAuthor($newAuthor);
        }

        $this->entityManager->persist($book);
        $this->entityManager->flush();
    }
}
