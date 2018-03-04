<?php namespace app\Transformers;

use Illuminate\Database\Eloquent\Model;

/**
 * Interface Transformer
 *
 * @package Riskalyze\Transformers
 */
interface Transformer
{

    /**
     * @param Model $model
     *
     * @return array
     */
    public function transform(Model $model) : array;

}