<?php

namespace App\Controller\AbstractController\RutasGeneradas;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class RutaGeneradaGetController
{
    public function __invoke(Request $request): JsonResponse
    {
        return new JsonResponse($request->attributes->all(), Response::HTTP_OK);
    }
}
