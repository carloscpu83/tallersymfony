<?php

namespace App\Controller\Enrutado;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class PruebaRequestGetQueryStringController
{
    // Las querystrigs tienen un subconjunto de operaciones del apartado de atributes
    public function __invoke(Request $request): JsonResponse
    {
        $respuesta = [
            'cantidad_query_params' => $this->cantidad($request),
            'query_params_individual' => [
                'parametro1' => $this->individual($request, 'parametro1'),
                'parametroNoExistente' => $this->individual($request, 'noExiste')
            ],
            'keys' => $this->keys($request),
            'query_params_todos' => $this->todos($request)
        ];

        return new JsonResponse($respuesta, Response::HTTP_OK);
    }

    private function cantidad(Request $request):int
    {
        return $request->query->count();
    }

    private function todos(Request $request):array
    {
        return $request->query->all();
    }

    private function individual(Request $request, string $key):?string
    {
        return $request->query->get($key);
    }

    private function keys(Request $request):array
    {
        return $request->query->keys();
    }
}
