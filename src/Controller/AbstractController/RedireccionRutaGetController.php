<?php

namespace App\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class RedireccionRutaGetController extends AbstractController
{
    private const RUTA_DESTINO_GET = 'ruta_generada_get';
    private const RUTA_DESTINO_GET_SIN_PARAMETROS = 'ruta_generada_get_sin_parametros';

    public function __invoke(Request $request): RedirectResponse {
        $content = json_decode($request->getContent(), true);

        // Distintos tipos de redirecciones
        //return $this->redireccionGetUrlGenerada($content);
        return $this->redireccionGetSinParametros($content);
    }

    private function redireccionGetUrlGenerada(array $content):RedirectResponse{
        $url = $this->generateUrl(
            self::RUTA_DESTINO_GET,
            $content,
            UrlGeneratorInterface::ABSOLUTE_URL
        );

        return $this->redirect($url, Response::HTTP_MOVED_PERMANENTLY);
    }

    private function redireccionGetSinParametros():RedirectResponse
    {
        //El metodo redirectToRoute solamente permite hacer redirecciones a rutas GET
        return $this->redirectToRoute(
            self::RUTA_DESTINO_GET_SIN_PARAMETROS,
            [],
            Response::HTTP_MOVED_PERMANENTLY
        );
    }
}
