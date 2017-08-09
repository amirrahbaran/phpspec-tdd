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

    function it_returns_I_for_1 () {
        $this->convert(1)->shouldReturn("I");
    }
}
