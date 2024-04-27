<?php

namespace App\Services;

class ServicioConAlias
{
    private string $valorString;
    private string $valorEntero;

    public function __construct(
        string $valorString,
        string $valorEntero
    ){
        $this->valorEntero = $valorEntero;
        $this->valorString = $valorString;
    }

    public function execute():string
    {
        return 'Hola, soy el servicio ServicioConAlias y tengo como parametros: ' . $this->valorString . ' y ' . $this->valorEntero . '.' ;
    }
}
