<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: "/author")]
class AuthorController extends AbstractController
{
    #[Route('/create', name: 'author_admin_create', methods: ["POST"])]
    public function create(Request $request): JsonResponse
    {
        echo "<pre>";
        print_r('111111111');
        echo "</pre>";
        die();

        $data = json_decode($request->getContent(), true);

        return $this->json([]);
    }
}
