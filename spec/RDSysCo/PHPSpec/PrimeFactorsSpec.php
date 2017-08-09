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

    function generate_method_should_return_empty_for_1 (){
        $this->generate(1)->shouldReturn([]);
    }
}
