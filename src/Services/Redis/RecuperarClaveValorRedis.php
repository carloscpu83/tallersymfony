<?php

namespace App\Services\Redis;

use Throwable;
use Predis\Client;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class RecuperarClaveValorRedis
{
    private Client $predisClient;

    public function __construct(Client $predisClient)
    {
        $this->predisClient = $predisClient;
    }

    public function execute(string $key): JsonResponse
    {
        try{
            $value = $this->predisClient->get($key);
        }catch(Throwable $e){
            return new JsonResponse(['message' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse(['data' => $value], Response::HTTP_OK);
    }
}
