<?php namespace App\Helpers;

use Illuminate\Support\Collection;
use App\Helpers\Resource;

class ResourceCollection extends Collection
{

    /**
     * @param array $items
     */
    public function __construct(array $items = [])
    {
        parent::__construct($items);
    }
    /**
     * Iterate over resources in the collection and output their array values
     *
     * @return array
     */
    public function toArray()
    {
        $response = [];
        /** @var \App\Helpers\Resource $resource */
        foreach ($this->items as $resource) {
            $response[] = $resource->toArray();
        }

        return $response;
    }

}