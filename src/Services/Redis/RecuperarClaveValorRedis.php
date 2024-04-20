<?php

namespace App\Services\Redis;

use Throwable;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class RecuperarClaveValorRedis
{
    private ConectarRedis $conectarRedis;
    private DesconectarRedis $desconectarRedis;

    public function __construct(ConectarRedis $conectarRedis, DesconectarRedis $desconectarRedis)
    {
        $this->conectarRedis = $conectarRedis;
        $this->desconectarRedis = $desconectarRedis;
    }

    public function execute(string $key): JsonResponse
    {
        try{
            $client = $this->conectarRedis->execute();
            $value = $client->get($key);
            $this->desconectarRedis->execute($client);
        }catch(Throwable $e){
            return new JsonResponse(['message' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse(['data' => $value], Response::HTTP_OK);
    }
}
