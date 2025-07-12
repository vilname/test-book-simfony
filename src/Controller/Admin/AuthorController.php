<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Admin\Author\Command\CreateAuthor\CreateAuthorCommand;
use App\Admin\Author\Command\CreateAuthor\CreateAuthorHandler;
use App\Admin\Author\Command\UpdateAuthor\UpdateAuthorCommand;
use App\Admin\Author\Command\UpdateAuthor\UpdateAuthorHandler;
use App\Admin\Author\Query\GetAuthor\GetAuthorHandler;
use App\Admin\Author\Query\ListAuthor\ListAuthorHandler;
use App\Common\Dto\PaginationDto;
use App\Common\Dto\ResultWithPagination;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: "/authors")]
class AuthorController extends AbstractController
{
    public function __construct(
        private CreateAuthorHandler $createAuthorHandler,
        private UpdateAuthorHandler $updateAuthorHandler,
        private GetAuthorHandler $getAuthorHandler,
        private ListAuthorHandler $listAuthorHandler,
        private PaginationDto $paginationDto
    ) {}

    #[Route('/create', methods: ["POST"])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $command = new CreateAuthorCommand($data);
        $this->createAuthorHandler->handler($command);


        return $this->json(null);
    }

    #[Route('/update/{id}', methods: ["POST"])]
    public function update(int $id, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $command = new UpdateAuthorCommand($data);
        $this->updateAuthorHandler->handler($id, $command);

        return $this->json(null);
    }

    #[Route('/by-id/{id}', methods: ["GET"])]
    public function getById(int $id): JsonResponse
    {
        $result = $this->getAuthorHandler->handler($id);

        return $this->json(["data" => $result]);
    }

    #[Route('/list', methods: ["GET"])]
    public function list(Request $request): JsonResponse
    {
        $paginationDto = $this->paginationDto->pagination($request);
        $result = $this->listAuthorHandler->handler($paginationDto);

        return $this->json(new ResultWithPagination($result, $paginationDto));
    }
}
