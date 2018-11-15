<?php

namespace App\Services;


interface CalculatorInterface
{

    /**
     * @param int $a
     * @param int $b
     *
     * @return int
     */
    public function add(int $a, int $b): int;

}