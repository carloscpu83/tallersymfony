<?php

namespace App\Controller\Enrutado;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class PruebaRequestPostHeadersController
{
    public function __invoke(): JsonResponse
    {
        $respuesta = [];

        return new JsonResponse($respuesta, Response::HTTP_OK);
    }
}
