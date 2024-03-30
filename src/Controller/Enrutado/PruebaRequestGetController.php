<?php

namespace App\Controller\Enrutado;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\InvalidParameterException;

class PruebaRequestGetController
{
    public function __invoke(
        Request $request
    ): JsonResponse {
        $valorEntero = $this->individual($request, 'valorentero');
        $valorPorDefecto = $this->individual($request, 'pordefecto');

        // Agregamos nuevos valores a la request
        $this->agregar($request, 'nuevo', 'valor');
        $this->agregar($request, 'cambiar', 'valor');
        $this->agregar($request, 'eliminar', 'eliminar');

        // Eliminamos un paramtro de la request
        $this->eliminar($request, 'eliminar');

        // Cambiamos el valor del parametros de la request
        $this->cambiar($request, 'cambiar', 'nuevovalor');

        // Agregamos nuevos paramtros a la request para realizar castings
        $this->agregarVariosTipos($request);

        $respuesta = [
            'parametroIndividual' => [
                'valorentero' => $valorEntero,
                'pordefecto' => $valorPorDefecto
            ],
            'parametrosTodos' => $this->todos($request),
            'parametrosKeys' => $this->keys($request),
            'parametrosExiste' =>[
                'valorentero' => $this->existe($request, 'valorentero'),
                'cambiar' => $this->existe($request, 'cambiar'),
                'eliminar' => $this->existe($request, 'eliminar')
            ],
            'casting' => [
                'alfanumerico' => $request->attributes->getAlnum('alfanumerico'),
                'alfa' => $request->attributes->getAlpha('alfanumerico'),
                'numerico' => $request->attributes->getDigits('alfanumerico'),
                'boolean' => $request->attributes->getBoolean('boolean'),
                'entero' => $request->attributes->getInt('entero')
            ],
            'filtros' => [
                'boolean' => $request->attributes->filter('boolean', FILTER_VALIDATE_BOOL),
                'entero' => $request->attributes->filter('entero', FILTER_VALIDATE_INT),
                'asignarNullenError' => $request->attributes->filter('entero', FILTER_VALIDATE_EMAIL, FILTER_NULL_ON_FAILURE)
            ]
        ];

        return new JsonResponse($respuesta, Response::HTTP_OK);
    }

    /**
     * @param Request $request
     * @param string $nombreParametro
     * @return string
     * @throws InvalidParameterException
     */
    private function individual(Request $request, string $nombreParametro):string
    {
        $value = $request->get($nombreParametro);

        // La siguiente definicion es un sinonimo
        // $value = $request->attributes->get($nombreParametro);

        if(null === $value){
            throw new InvalidParameterException("El parametro {$nombreParametro} no existe.", Response::HTTP_NOT_FOUND);
        }

        return $value;
    }

    /**
     * @param Request $request
     * @return array
     */
    private function todos(Request $request):array
    {
        return $request->attributes->all();
    }

    /**
     * @param Request $request
     * @return array
     */
    private function keys(Request $request):array
    {
        return $request->attributes->keys('valorentero');
    }

    /**
     * @param Request $request
     * @param string $clave
     * @param string $valor
     * @return void
     */
    private function agregar(Request $request, string $clave, string $valor ): void
    {
        $request->attributes->add([$clave => $valor]);
    }

    /**
     * @param Request $request
     * @param string $clave
     * @return void
     */
    private function eliminar(Request $request, string $clave): void
    {
        $request->attributes->remove($clave);
    }

    /**
     * @param Request $request
     * @param string $clave
     * @param string $valor
     * @return void
     */
    private function cambiar(Request $request, string $clave, string $valor)
    {
        $request->attributes->set($clave, $valor);
    }

    private function existe(Request $request, string $clave): bool
    {
        return $request->attributes->has($clave);
    }

    private function agregarVariosTipos(Request $request): void
    {
        $request->attributes->add([
            'alfanumerico' => 'a1b2c3',
            'boolean' => 'false',
            'entero' => '2342',
            'string' => 'soyUnaCadena'
        ]);
    }
}
