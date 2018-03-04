<?php namespace app\Transformers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class AbstractTransformer
 *
 * @package Riskalyze\Transformers
 */
abstract class AbstractTransformer implements Transformer
{

    /**
     * @param Model $model
     *
     * @return array
     */
    abstract public function transform(Model $model): array;

    /**
     * @param \Illuminate\Support\Collection $collection
     *
     * @return \Illuminate\Support\Collection
     */
    public function transformCollection(Collection $collection): Collection
    {
        return $collection->map(function (Model $model) {
            return (new static)->transform($model);
        });
    }
}
