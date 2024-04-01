<?php

namespace App\Controller\Enrutado;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class PruebaRequestFuncionesPutController
{
    public function __invoke(Request $request): JsonResponse
    {
        $respuesta = [
            'basepath' => $request->getBasePath(),
            'baseurl' => $request->getBaseUrl(),
            'locale' => $request->getDefaultLocale(),
            'uri' => $request->getUri(),
            'pathinfo' => $request->getPathInfo(),
            'contenttype' => $request->getContentType()
        ];

        return new JsonResponse($respuesta, Response::HTTP_OK);
    }
}
