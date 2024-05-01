<?php

namespace App\Services\Redis;

use Predis\Client;

class AgregarClaveValorRedis
{
    private Client $predisClient;

    public function __construct(Client $predisClient)
    {
        $this->predisClient = $predisClient;
    }

    public function execute(string $key, string $value):void
    {
        $this->predisClient->set($key, $value);
    }
}
