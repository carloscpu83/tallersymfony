<?php

namespace App\Controller\Redis;

use App\Services\Redis\PublicarMensaje;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PublicarMensajeRedisController
{
    private PublicarMensaje $publicarMensaje;

    public function __construct(PublicarMensaje $publicarMensaje)
    {
        $this->publicarMensaje = $publicarMensaje;
    }

    public function __invoke(): JsonResponse
    {
        $this->publicarMensaje->execute(500);
        return new JsonResponse([], Response::HTTP_OK);
    }
}
