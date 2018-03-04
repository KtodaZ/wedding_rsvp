<?php namespace App\Helpers;

trait NameHelper
{
    /**
     * @param string $name
     *
     * @see https://stackoverflow.com/questions/38268137/laravel-5-2-split-string-first-name-last-name/38268197
     *
     * @return array
     */
    private function splitName(string $name)
    {
        $splitName = explode(' ', $name, 2); // Restricts it to only 2 values, for names like Billy Bob Jones

        $first_name = $splitName[0];
        $last_name = !empty($splitName[1]) ? $splitName[1] : ''; // If last name doesn't exist, make it empty

        return [$first_name, $last_name];
    }

    private function splitNameReturnArray(string $name)
    {
        list($fname, $lname) = $this->splitName($name);
        return ['fname' => $fname, 'lname' => $lname];
    }
}