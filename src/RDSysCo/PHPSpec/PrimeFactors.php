<?php

namespace RDSysCo\PHPSpec;

class PrimeFactors
{
    public function generate($number)
    {
        return $number == 1 ? [] : [$number];
    }
}
