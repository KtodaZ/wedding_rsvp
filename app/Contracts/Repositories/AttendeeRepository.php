<?php

use App\Helpers\Resource;
use Illuminate\Support\Collection;

interface AttendeeRepository
{

    /**
     * @param Resource $plusOneList
     *
     * @return Collection
     */
    public function addPlusOnes(Resource $plusOneList) : Collection;

}