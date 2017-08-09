<?php

namespace RDSysCo\PHPSpec;

class PrimeFactors
{
    public function generate($number)
    {
        $result = [];
        for ($factor = 2; $number > 1; $factor++) {
            for(; $number % $factor == 0; $number /= $factor) {
                $result[] = $factor;
            }
        }
        return $result;
    }
}
