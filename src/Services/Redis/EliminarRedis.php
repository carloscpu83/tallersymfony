<?php

namespace App\Services\Redis;

class EliminarRedis
{
    private ConectarRedis $conectarRedis;
    private DesconectarRedis $desconectarRedis;

    public function __construct(ConectarRedis $conectarRedis, DesconectarRedis $desconectarRedis)
    {
        $this->conectarRedis = $conectarRedis;
        $this->desconectarRedis = $desconectarRedis;
    }

    public function execute(string $key):void
    {
        $client = $this->conectarRedis->execute();
        $client->del($key);
        $this->desconectarRedis->execute($client);
    }

}
