<?php

namespace spec\RDSysCo\RomanNumbers;

use RDSysCo\RomanNumbers\RomanNumbers;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RomanNumbersSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(RomanNumbers::class);
    }

    function it_returns_I_for_1()
    {
        $this->convert(1)->shouldReturn("I");
    }

    function it_returns_II_for_2() {
        $this->convert(2)->shouldReturn("II");
    }

    function it_returns_III_for_3() {
        $this->convert(3)->shouldReturn("III");
    }

    function it_returns_V_for_5() {
        $this->convert(5)->shouldReturn("V");
    }

    function it_returns_VIII_for_8(){
        $this->convert(8)->shouldReturn("VIII");
    }

    function it_returns_X_for_10(){
        $this->convert(10)->shouldReturn("X");
    }

    function it_returns_XXVI_for_26() {
        $this->convert(26)->shouldReturn("XXVI");
    }

    function it_returns_L_for_50() {
        $this->convert(50)->shouldReturn("L");
    }

    function it_returns_IV_for_4() {
        $this->convert(4)->shouldReturn("IV");
    }

    function it_returns_IX_for_9() {
        $this->convert(9)->shouldReturn("IX");
    }

    function it_returns_C_for_100() {
        $this->convert(100)->shouldReturn("C");
    }

    function it_returns_XL_for_40() {
        $this->convert(40)->shouldReturn("XL");
    }

    function it_returns_XC_for_90() {
        $this->convert(90)->shouldReturn("XC");
    }

    function it_returns_D_for_500() {
        $this->convert(500)->shouldReturn("D");
    }

    function it_returns_CD_for_400() {
        $this->convert(400)->shouldReturn("CD");
    }

    function it_returns_M_for_1000() {
        $this->convert(1000)->shouldReturn("M");
    }

    function it_returns_CM_for_900() {
        $this->convert(900)->shouldReturn("CM");
    }

    function it_returns_CMLXXXIV_for_984() {
        $this->convert(984)->shouldReturn("CMLXXXIV");
    }

    function it_throws_invalid_argument_exception_for_zero() {
        $this->shouldThrow(\InvalidArgumentException::class)->during("convert", [0]);
    }

    function it_throws_invalid_argument_exception_for_negative_numbers() {
        $this->shouldThrow(\InvalidArgumentException::class)->during('convert', [-1]);
    }

}
