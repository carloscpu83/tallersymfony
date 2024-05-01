<?php

namespace App\Controller\Redis;

use Throwable;
use InvalidArgumentException;
use App\Services\Redis\EliminarRedis;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class EliminarRedisController
{
    private EliminarRedis $eliminarRedis;

    public function __construct(EliminarRedis $eliminarRedis)
    {
        $this->eliminarRedis = $eliminarRedis;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $content = json_decode($request->getContent(), true);

        try{
            $this->checkParams($content);
            $this->eliminarRedis->execute($content['clave']);

            return new JsonResponse(['message' => ''], Response::HTTP_OK);
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
