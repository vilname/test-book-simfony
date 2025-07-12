<?php

declare(strict_types=1);

namespace App\Admin\Book\Command\DeleteBook;

use App\Entity\Book;
use Doctrine\ORM\EntityManagerInterface;

class DeleteBookHandler
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    public function handler(int $id): void
    {
        $book = $this->entityManager->find(Book::class, $id);
        if (empty($book)) {
            return;
        }

        $book->getAuthor()->numberBooksDecrement();

        $this->entityManager->remove($book);
        $this->entityManager->flush();
    }
}
