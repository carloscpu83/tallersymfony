<?php

namespace App\Controller\Redis;

use Symfony\Component\HttpFoundation\Request;
use App\Services\Redis\RecuperarClaveValorRedis;
use Symfony\Component\HttpFoundation\JsonResponse;

class RecuperarClaveValorRedisController
{
    private RecuperarClaveValorRedis $recuperarClaveValorRedis;

    public function __construct(RecuperarClaveValorRedis $recuperarClaveValorRedis)
    {
        $this->recuperarClaveValorRedis = $recuperarClaveValorRedis;
    }

    public function __invoke(Request $request):JsonResponse
    {
        $content = json_decode($request->getContent(), true);
        return $this->recuperarClaveValorRedis->execute($content['clave']);
    }
}
