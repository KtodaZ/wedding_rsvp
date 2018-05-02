<?php namespace App\Utility\Generators;

use App\Contracts\Generators\CodeGenerator;
use Illuminate\Support\Arr;

class RsvpCodeGenerator implements CodeGenerator
{
    /**
     * @var array
     */
    private $codeWords;

    /**
     * RsvpCodeGenerator constructor.
     *
     * @param array $codeWords
     */
    public function __construct(array $codeWords)
    {
        $this->codeWords = $codeWords;
    }

    /**
     * @param int $lengthOfNumbers
     *
     * @return mixed
     */
    public function generate(int $lengthOfNumbers)
    {
        return strtoupper(Arr::random($this->codeWords)) . $this->getNumberOfLength($lengthOfNumbers);
    }

    /**
     * @param int $length
     *
     * @return int
     */
    private function getNumberOfLength(int $length): int
    {
        do {
            $number = rand(pow(10, $length - 1), pow(10, $length));
        } while ($this->numberContainsZero($number) && ($number == 69));

        return $number;
    }

    /**
     * @param $number
     *
     * @return bool
     */
    private function numberContainsZero(int $number)
    {
        return str_contains(((string) $number), '0') ;
    }
}