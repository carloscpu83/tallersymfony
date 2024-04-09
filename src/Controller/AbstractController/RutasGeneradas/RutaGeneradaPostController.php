<?php

namespace App\Controller\AbstractController\RutasGeneradas;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class RutaGeneradaPostController
{
    public function __invoke(Request $request): JsonResponse
    {
        $content = json_decode($request->getContent(), true);
        return new JsonResponse($content, Response::HTTP_OK);
    }
}
