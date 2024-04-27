<?php

namespace App\Controller\Services;

use App\Services\ServicioConAlias;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ServicesController
{
    private ContainerInterface $containerInterface;

    public function __construct(
        ContainerInterface $containerInterface
    ){
        $this->containerInterface = $containerInterface;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $servicioConAlias = $this->containerInterface->get('servicio.alias');

        return new JsonResponse([$servicioConAlias->execute()], Response::HTTP_OK);
    }

}
