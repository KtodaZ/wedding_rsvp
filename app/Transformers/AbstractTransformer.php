<?php namespace App\Transformers;

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
    abstract public function transform(Model $model);

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
