<?php

namespace App\Services\Redis;

use Predis\Client;

class PublicarMensaje
{
    private Client $predisClient;
    private string $canal;

    public function __construct(Client $predisClient, string $canal)
    {
        $this->predisClient = $predisClient;
        $this->canal = $canal;
    }

    public function execute(int $cantidad = 1):void
    {
        for($iterador = 0; $iterador < $cantidad; $iterador++){
            $this->predisClient->publish($this->canal, 'Mensaje enviado ' . $iterador);
        }
    }
}
