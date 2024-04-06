<?php

namespace App\Controller\Redis;

use Predis\Client;
use Predis\Autoloader;
use Predis\Response\Status;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class PrubaClaveValorController
{
    private Client $client;

    public function __construct()
    {
        Autoloader::register();

        $this->client = new Client([
            'scheme' => 'tcp',
            'host'   => 'redis_service',
            'port'   => 6379
        ]);
    }

    public function __invoke(): JsonResponse
    {
        $respuesta = [];

        $status = $this->client->set('hola', 11);

        return new JsonResponse($respuesta, Response::HTTP_OK);
    }

}
