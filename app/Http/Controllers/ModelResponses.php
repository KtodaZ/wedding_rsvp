<?php namespace App\Http\Controllers;

use App\Transformers\Transformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * Trait ModelResponses
 *
 * @package Riskalyze\Http\Controllers
 */
trait ModelResponses
{

    /**
     * @param Model|\Illuminate\Database\Eloquent\Collection | \Illuminate\Support\Collection $model
     * @param Transformer $transformer
     * @param int $httpStatus
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function response($model, Transformer $transformer, int $httpStatus = Response::HTTP_OK) : JsonResponse
    {
        if ($model instanceof Model) {
            return $this->singularResponse($model, $transformer, $httpStatus);
        } else {
            return $this->collectionResponse($model, $transformer, $httpStatus);
        }
    }

    /**
     * @param Model $model
     * @param Transformer $transformer
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createdResponse(Model $model, Transformer $transformer) : JsonResponse
    {
        $data = $transformer->transform($model);

        return new JsonResponse($data, Response::HTTP_CREATED);
    }

    /**
     * @return JsonResponse
     */
    protected function emptyResponse() : JsonResponse
    {
        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * @param $model
     * @param Transformer $transformer
     * @param int $httpStatus
     *
     * @return \Illuminate\Http\JsonResponse
     */
    private function singularResponse($model, Transformer $transformer, int $httpStatus) : JsonResponse
    {
        $data = $transformer->transform($model);

        return new JsonResponse($data, $httpStatus);
    }

    /**
     * @param \Illuminate\Support\Collection | \Illuminate\Database\Eloquent\Collection $collection
     * @param Transformer $transformer
     * @param int $httpStatus
     *
     * @return \Illuminate\Http\JsonResponse
     */
    private function collectionResponse($collection, Transformer $transformer, int $httpStatus = Response::HTTP_OK)
    {
        $data = [];
        foreach ($collection as $model) {
            $data[] = $transformer->transform($model);
        }

        return new JsonResponse($data, $httpStatus);
    }

}
