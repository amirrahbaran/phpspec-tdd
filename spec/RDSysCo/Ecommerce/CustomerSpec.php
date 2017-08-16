<?php

namespace spec\RDSysCo\Ecommerce;

use RDSysCo\Ecommerce\Customer;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CustomerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Customer::class);
    }
}
