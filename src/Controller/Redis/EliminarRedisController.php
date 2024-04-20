<?php

namespace App\Controller\Redis;

use App\Services\Redis\EliminarRedis;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EliminarRedisController
{
    private EliminarRedis $eliminarRedis;

    public function __construct(EliminarRedis $eliminarRedis)
    {
        $this->eliminarRedis = $eliminarRedis;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $content = json_decode($request->getContent(), true);
        $this->eliminarRedis->execute($content['clave']);

        return new JsonResponse([], Response::HTTP_OK);

    }
}
