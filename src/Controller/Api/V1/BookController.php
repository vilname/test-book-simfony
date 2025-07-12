<?php

declare(strict_types=1);

namespace App\Controller\Api\V1;

use App\Api\V1\Book\Command\DeleteBook\DeleteBookHandler;
use App\Api\V1\Book\Command\UpdateBook\UpdateBookCommand;
use App\Api\V1\Book\Command\UpdateBook\UpdateBookHandler;
use App\Api\V1\Book\Query\GetBook\GetBookHandler;
use App\Api\V1\Book\Query\ListBook\ListBookHandler;
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
        private UpdateBookHandler $updateBookHandler,
        private ListBookHandler $listBookHandler,
        private GetBookHandler $getBookHandler,
        private DeleteBookHandler $deleteBookHandler,
        private PaginationDto $paginationDto
    ) {}

    #[Route('/update/{id}', methods: ["POST"])]
    public function update(int $id, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $command = new UpdateBookCommand($data);
        $this->updateBookHandler->handler($id, $command);

        return $this->json(null);
    }

    #[Route('/list', methods: ["GET"])]
    public function list(Request $request): JsonResponse
    {
        $paginationDto = $this->paginationDto->pagination($request);
        $result = $this->listBookHandler->handler($paginationDto);

        return $this->json(new ResultWithPagination($result, $paginationDto));
    }

    #[Route('/by-id/{id}', methods: ["GET"])]
    public function getById(int $id): JsonResponse
    {
        $result = $this->getBookHandler->handler($id);

        return $this->json([
            "data" => $result
        ]);
    }

    #[Route('/delete/{id}', methods: ["DELETE"])]
    public function delete(int $id): JsonResponse
    {
        $this->deleteBookHandler->handler($id);

        return $this->json(null);
    }
}
