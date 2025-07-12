<?php

declare(strict_types=1);

namespace App\Admin\Author\Query\GetAuthor;

use App\Entity\Author;

class GetAuthorResult
{
    public string $fio;
    public int $numberBooks;

    public function __construct(Author $author)
    {
        $this->fio = $author->getFio();
        $this->numberBooks = $author->getNumberBooks();
    }
}
