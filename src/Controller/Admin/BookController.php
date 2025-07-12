<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Admin\Book\Command\CreateBook\CreateBookCommand;
use App\Admin\Book\Command\CreateBook\CreateBookHandler;
use App\Admin\Book\Command\DeleteBook\DeleteBookHandler;
use App\Admin\Book\Command\UpdateBook\UpdateBookCommand;
use App\Admin\Book\Command\UpdateBook\UpdateBookHandler;
use App\Admin\Book\Query\GetBook\GetBookHandler;
use App\Admin\Book\Query\ListBook\ListBookHandler;
use App\Common\Dto\PaginationDto;
use App\Common\Dto\ResultWithPagination;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: "/books")]
class BookController extends AbstractController
{
    public function __construct(
        private CreateBookHandler $createBookHandler,
        private UpdateBookHandler $updateBookHandler,
        private GetBookHandler $getBookHandler,
        private ListBookHandler $listBookHandler,
        private DeleteBookHandler $deleteBookHandler,
        private PaginationDto $paginationDto
    ) {}

    #[Route('/create', methods: ["POST"])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $command = new CreateBookCommand($data);
        $this->createBookHandler->handler($command);

        return $this->json(null);
    }

    #[Route('/update/{id}', methods: ["POST"])]
    public function update(int $id, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $command = new UpdateBookCommand($data);
        $this->updateBookHandler->handler($id, $command);

        return $this->json(null);
    }

    #[Route('/by-id/{id}', methods: ["GET"])]
    public function getById(int $id): JsonResponse
    {
        $result = $this->getBookHandler->handler($id);

        return $this->json([
            "data" => $result
        ]);
    }

    #[Route('/list', methods: ["GET"])]
    public function list(Request $request): JsonResponse
    {
        $paginationDto = $this->paginationDto->pagination($request);
        $result = $this->listBookHandler->handler($paginationDto);

        return $this->json(new ResultWithPagination($result, $paginationDto));
    }

    #[Route('/delete/{id}', methods: ["DELETE"])]
    public function delete(int $id): JsonResponse
    {
        $this->deleteBookHandler->handler($id);

        return $this->json(null);
    }
}
