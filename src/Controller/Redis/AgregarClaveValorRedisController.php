<?php

namespace App\Controller\Redis;

use Symfony\Component\HttpFoundation\Request;
use App\Services\Redis\AgregarClaveValorRedis;
use Symfony\Component\HttpFoundation\JsonResponse;

class AgregarClaveValorRedisController
{
    private AgregarClaveValorRedis $agregarClaveValorRedis;

    public function __construct(AgregarClaveValorRedis $agregarClaveValorRedis)
    {
        $this->agregarClaveValorRedis = $agregarClaveValorRedis;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $content = json_decode($request->getContent(), true);
        return $this->agregarClaveValorRedis->execute($content['clave'], $content['valor']);
   }}
