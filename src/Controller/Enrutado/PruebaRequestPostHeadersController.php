<?php

namespace App\Controller\Enrutado;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class PruebaRequestPostHeadersController
{
    public function __invoke(Request $request): JsonResponse
    {
        // Agregamos nuevas headers
        $this->agregar($request, 'header2', 'valor2');
        $this->agregar($request, 'header3', 'valor3');
        $this->agregar($request, 'headerToDelete', 'a-eliminar');

        // Eliminamos header
        $this->eliminar($request, 'headerToDelete');

        // Actualizar el valor de un header
        $this->actualizar($request, 'header2', 'minuevovalor');

        $respuesta = [
            'cantidad' => $this->cantidad($request),
            'keys' => $this->keys($request),
            'todos' => $this->todos($request),
            'headers_individual' => [
                'Content-Type' => $this->individual($request, 'Content-Type'),
                'noExiste' => $this->individual($request, 'noExiste')
            ],
            'header_tiene_como_valor' => [
                "Content-Type = application/json" => $this->headerTieneComoValor($request, "Content-Type", "application/json"),
                "header1 = valor33" => $this->headerTieneComoValor($request, "header1", "valor33"),
            ],
            'existe' => [
                'header2' => $this->existe($request, 'header2'),
                'noexiste' => $this->existe($request, 'noexiste')
            ]
        ];

        return new JsonResponse($respuesta, Response::HTTP_OK);
    }

    /**
     * @param Request $request
     * @return integer
     */
    private function cantidad(Request $request): int
    {
        return $request->headers->count();
    }

    /**
     * @param Request $request
     * @return array
     */
    private function keys(Request $request):array
    {
        return $request->headers->keys();
    }

    /**
     * @param Request $request
     * @return array
     */
    private function todos(Request $request):array
    {
        return $request->headers->all();
    }

    /**
     * @param Request $request
     * @param string $key
     * @return string|null
     */
    private function individual(Request $request, string $key): ?string
    {
        return $request->headers->get($key);
    }

    /**
     * @param Request $request
     * @param string $key
     * @param string $value
     * @return boolean
     */
    private function headerTieneComoValor(Request $request, string $key, string $value):bool
    {
        return $request->headers->contains($key, $value);
    }

    /**
     * @param Request $request
     * @param string $key
     * @param string $valor
     * @return void
     */
    private function agregar(Request $request, string $key, string $valor):void
    {
        $request->headers->add([$key => $valor]);
    }

    private function eliminar(Request $request, string $key):void
    {
        $request->headers->remove($key);
    }

    /**
     * @param Request $request
     * @param string $key
     * @param string $value
     * @return void
     */
    private function actualizar(Request $request, string $key, string $value):void
    {
        $request->headers->set($key, $value);
    }

    /**
     * @param Request $request
     * @param string $key
     * @return boolean
     */
    private function existe(Request $request, string $key): bool
    {
        return $request->headers->has($key);
    }

}
