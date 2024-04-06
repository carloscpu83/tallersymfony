<?php

namespace App\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class GeneracionRutasController extends AbstractController
{
    public function __invoke(Request $request): JsonResponse {
        $content = json_decode($request->getContent(), true);

        // Si el nombre de la clave en el array asociativo coincide con el que esta en el routes.yaml lo inyecta como atributo de lo contrario lo mete como querystring.
        $respuesta = [
            'url-get-con-atrubutos' => $this->generateUrl('ruta_generada_get', $content, UrlGeneratorInterface::NETWORK_PATH),
            // En el caso para la peticion POST como en la url no puede hacer match con nada entonces todos los parametros del content son querystring
            'url-post' => $this->generateUrl('ruta_generada_post', $content, UrlGeneratorInterface::NETWORK_PATH)
        ];

        return new JsonResponse($respuesta, Response::HTTP_OK);
    }
}
