<?php

declare(strict_types=1);

namespace App\Admin\Book\Query\GetBook;

use App\Entity\Book;

class GetBookResult
{
    public int $id;
    public string $title;
    public string $fio;

    public function __construct(Book $book)
    {
        $this->id = $book->getId();
        $this->title = $book->getTitle();
        $this->fio = $book->getAuthor()->getFio();
    }
}
