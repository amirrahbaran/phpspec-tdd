<?php

namespace RDSysCo\RomanNumbers;

use Psr\Log\InvalidArgumentException;

class RomanNumbers
{
    protected static $lookup = [
            1000 => "M",
            900 => "CM",
            500 => "D",
            400 => "CD",
            100 => "C",
            90  => "XC",
            50  => "L",
            40  => "XL",
            10  => "X",
            9   => "IX",
            5   => "V",
            4   => "IV",
            1   => "I"
        ];

    public function convert($number)
    {
        $this->protect($number);

        $converted = "";

        foreach (self::$lookup as $factor => $char) {
            for(; $number >= $factor; $number -= $factor){
                $converted .= $char;
            }
        }

        return $converted;
    }

    private function protect($number)
    {
        if($number <= 0) {
            throw new \InvalidArgumentException();
        }
    }
}
