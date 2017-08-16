<?php

namespace spec\RDSysCo\Ecommerce;

use RDSysCo\Ecommerce\Discount;
use PhpSpec\ObjectBehavior;

class DiscountSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Discount::class);
    }
}
