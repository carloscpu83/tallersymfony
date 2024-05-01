<?php

namespace App\Controller\Redis;

use Throwable;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\Redis\RecuperarClaveValorRedis;
use Symfony\Component\HttpFoundation\JsonResponse;

class RecuperarClaveValorRedisController
{
    private RecuperarClaveValorRedis $recuperarClaveValorRedis;

    public function __construct(RecuperarClaveValorRedis $recuperarClaveValorRedis)
    {
        $this->recuperarClaveValorRedis = $recuperarClaveValorRedis;
    }

    public function __invoke(Request $request):JsonResponse
    {
        $content = json_decode($request->getContent(), true);

        try{
            $this->checkParams($content);

            $valor = $this->recuperarClaveValorRedis->execute($content['clave']);

            return new JsonResponse(['message' => $valor], Response::HTTP_OK);
        }catch(Throwable $e){
            return new JsonResponse(['message' => $e->getMessage()], $e->getCode());
        }
    }

    private function checkParams(array $content)
    {
        $indexParams = ['clave'];

        foreach($indexParams as $indexParam){
            if(false === isset($content[$indexParam]) || true === empty($content[$indexParam])){
                throw new InvalidArgumentException('Parametro ' . $indexParam . ' no valido.', Response::HTTP_NOT_FOUND);
            }
        }
    }
}
