<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'authors')]
class Author
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'string', nullable: false)]
    private string $fio;

    #[ORM\Column(type: 'integer', options: ["default" => 0])]
    private int $numberBooks = 0;

    #[ORM\OneToMany(targetEntity: Book::class, mappedBy: 'author', orphanRemoval: true)]
    private Collection $books;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getFio(): string
    {
        return $this->fio;
    }

    public function setFio(string $fio): void
    {
        $this->fio = $fio;
    }

    public function getNumberBooks(): int
    {
        return $this->numberBooks;
    }

    public function setNumberBooks(int $numberBooks): void
    {
        $this->numberBooks = $numberBooks;
    }

    public function getBooks(): Collection
    {
        return $this->books;
    }

    public function addBooks(Book $book): static
    {
        if (!$this->books->contains($book)) {
            $this->books->add($book);
            $book->setAuthor($this);
        }
        return $this;
    }

    public function removeBook(Book $book): static
    {
        if ($this->books->removeElement($book)) {
            $book->setAuthor(null);
        }
        return $this;
    }

    public function numberBooksIncrement():void
    {
        $this->numberBooks++;
    }

    public function numberBooksDecrement():void
    {
        $this->numberBooks--;
    }
}
