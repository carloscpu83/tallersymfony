<?php

namespace App\Controller\Redis;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class AgregarClaveValorRedisController
{
    //private GuardarClaveValorRedis $guardarClaveValorRedis;

    //public function __construct(GuardarClaveValorRedis $guardarClaveValorRedis)
    public function __construct()
    {
        //Autoloader::register();
        //$this->guardarClaveValorRedis = $guardarClaveValorRedis;

       /*  $this->client = new Client([
            'scheme' => 'tcp',
            'host'   => 'redis_service',
            'port'   => 6379
        ]); */
    }

    public function __invoke(): JsonResponse
    {
        /* $respuesta = [];

        $guardarClaveValorRedis

        $status = $this->client->set('hola', 11); */

        //return $this->guardarClaveValorRedis->execute('carlos', 'sabado');
        return new JsonResponse([], Response::HTTP_OK + 1);
    }

}
