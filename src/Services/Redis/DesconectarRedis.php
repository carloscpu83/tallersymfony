<?php

namespace App\Services\Redis;

use Predis\Client;

class DesconectarRedis
{
    public function execute(Client $client)
    {
        $client->disconnect();
    }
}
