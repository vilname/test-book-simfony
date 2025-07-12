<?php

declare(strict_types=1);

namespace App\Admin\Author\Command\UpdateAuthor;

class UpdateAuthorCommand
{
    public string $fio;

    public function __construct(array $data)
    {
        $this->fio = $data['fio'];
    }
}
