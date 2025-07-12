<?php

declare(strict_types=1);

namespace App\Admin\Author\Command\DeleteAuthor;

use App\Admin\Author\Repository\AuthorRepository;

class DeleteAuthorHandler
{
    public function __construct(private AuthorRepository $authorRepository) {}

    public function handler(int $id): void
    {
        $this->authorRepository->removeWithBook($id);
    }
}
