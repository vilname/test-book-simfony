<?php

declare(strict_types=1);

namespace App\Admin\Author\Command\CreateAuthor;

class CreateAuthorCommand
{
    public string $fio;

    public function __construct(array $data)
    {
        $this->fio = $data['fio'];
    }
}
