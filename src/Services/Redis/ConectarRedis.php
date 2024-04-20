<?php

namespace App\Services\Redis;

use Predis\Client;

class ConectarRedis
{
    private string $scheme;
    private string $host;
    private int $port;
    private int $database;

    public function __construct(string $scheme, string $host, int $port, int $database)
    {
        $this->scheme = $scheme;
        $this->host = $host;
        $this->port = $port;
        $this->database = $database;
    }

    public function execute(): Client
    {
        return new Client([
            'scheme' => $this->scheme,
            'host'   => $this->host,
            'port'   => $this->port,
            'database' => $this->database
        ]);
    }
}
