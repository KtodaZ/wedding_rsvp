<?php namespace App\Contracts\Generators;


interface CodeGenerator
{

    /**
     * @param int $lengthOfNumbers
     *
     * @return mixed
     */
    public function generate(int $lengthOfNumbers);

}