<?php

namespace App\Services\Redis;

use Predis\Client;
use Throwable;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class AgregarClaveValorRedis
{
    private Client $predisClient;

    public function __construct(Client $predisClient)
    {
        $this->predisClient = $predisClient;
    }

    public function execute(string $key, string $value):JsonResponse
    {
        try{
            $this->predisClient->set($key, $value);
        }catch(Throwable $e){
            return new JsonResponse(['message' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse(['data' => ''], Response::HTTP_OK);

    }
}
