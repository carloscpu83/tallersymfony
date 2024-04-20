<?php

namespace App\Services\Redis;

use Throwable;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class AgregarClaveValorRedis
{
    private ConectarRedis $conectarRedis;
    private DesconectarRedis $desconectarRedis;

    public function __construct(ConectarRedis $conectarRedis, DesconectarRedis $desconectarRedis)
    {
        $this->conectarRedis = $conectarRedis;
        $this->desconectarRedis = $desconectarRedis;
    }

    public function execute(string $key, string $value):JsonResponse
    {
        try{
            $client = $this->conectarRedis->execute();
            $client->set($key, $value);
            $this->desconectarRedis->execute($client);
        }catch(Throwable $e){
            return new JsonResponse(['message' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse(['data' => ''], Response::HTTP_OK);

    }
}
