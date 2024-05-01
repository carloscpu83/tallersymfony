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

    public function execute(string $key): ?string
    {
        return $this->predisClient->get($key);
    }
}
