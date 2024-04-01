<?php

namespace App\Controller\Enrutado;

use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class PruebaRequestPutContentController
{
    public function __invoke(Request $request): JsonResponse
    {
        $contenidoBody = json_decode($request->getContent(), true);

        $this->validarTipos($contenidoBody);

        $respuesta = [
            'contenidoBody' => $contenidoBody
        ];

        return new JsonResponse($respuesta, Response::HTTP_OK);
    }

    private function validarTipos(array $contenido):void
    {
        if(false === filter_var($contenido['campoint'], FILTER_VALIDATE_INT)){
            throw new InvalidArgumentException('Error en entero');
        }

        if(false === is_bool($contenido['campobool'])){
            throw new InvalidArgumentException('Error en bool');
        }
    }
}
