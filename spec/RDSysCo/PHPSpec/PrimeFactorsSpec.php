<?php

namespace spec\RDSysCo\PHPSpec;

use RDSysCo\PHPSpec\PrimeFactors;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PrimeFactorsSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(PrimeFactors::class);
    }

    function it_returns_empty_for_1 (){
        $this->generate(1)->shouldReturn([]);
    }

    function it_returns_2_for_2 (){
        $this->generate(2)->shouldReturn([2]);
    }

    function it_returns_3_for_3 (){
        $this->generate(3)->shouldReturn([3]);
    }

    function it_returns_2_2_for_4 () {
        $this->generate(4)->shouldReturn([2,2]);
    }
}
