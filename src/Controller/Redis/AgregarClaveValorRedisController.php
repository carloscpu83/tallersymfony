<?php

namespace App\Controller\Redis;

use Symfony\Component\HttpFoundation\Request;
use App\Services\Redis\AgregarClaveValorRedis;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class AgregarClaveValorRedisController
{
    private AgregarClaveValorRedis $agregarClaveValorRedis;

    public function __construct(AgregarClaveValorRedis $agregarClaveValorRedis)
    {
        $this->agregarClaveValorRedis = $agregarClaveValorRedis;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $content = json_decode($request->getContent(), true);

        try{
            $this->checkParams($content);
            $this->agregarClaveValorRedis->execute($content['clave'], $content['valor']);

            return new JsonResponse(['message' => ''], Response::HTTP_OK);
        }catch(Throwable $e){
            return new JsonResponse(['message' => $e->getMessage()], $e->getCode());
        }
    }

    private function checkParams(array $content)
    {
        $indexParams = ['clave', 'valor'];

        foreach($indexParams as $indexParam){
            if(false === isset($content[$indexParam]) || true === empty($content[$indexParam])){
                throw new InvalidArgumentException('Parametro ' . $indexParam . ' no valido.', Response::HTTP_NOT_FOUND);
            }
        }
    }
}
