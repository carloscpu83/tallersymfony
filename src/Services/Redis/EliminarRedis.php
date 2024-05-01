<?php

namespace App\Services\Redis;

use Predis\Client;

class EliminarRedis
{
    private Client $predisClient;

    public function __construct(Client $predisClient)
    {
        $this->predisClient = $predisClient;
    }

    public function execute(string $key):void
    {
        $this->predisClient->del($key);
    }

}
