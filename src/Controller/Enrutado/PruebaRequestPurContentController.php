<?php

namespace App\Controller\Enrutado;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class PruebaRequestPurContentController
{
    public function __invoke(Request $request): JsonResponse
    {
        $respuesta = [

        ];

        return new JsonResponse($respuesta, Response::HTTP_OK);
    }
}
