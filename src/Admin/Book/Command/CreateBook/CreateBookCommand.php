<?php

declare(strict_types=1);

namespace App\Admin\Book\Command\CreateBook;

class CreateBookCommand
{
    public string $title;
    public int $authorId;

    public function __construct(array $data)
    {
        $this->title = $data['title'];
        $this->authorId = $data['authorId'];
    }
}
