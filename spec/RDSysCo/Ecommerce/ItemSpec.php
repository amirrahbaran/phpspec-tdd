<?php

namespace spec\RDSysCo\Ecommerce;

use RDSysCo\Ecommerce\Item;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ItemSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Item::class);
    }

    function it_should_return_default_code()
    {
        $this->getCode()->shouldReturn(0);
    }

    function it_should_return_desired_code()
    {
        $itemCode = 00101;
        $this->setCode($itemCode);
        $this->getCode()->shouldReturn($itemCode);
    }

    function it_should_return_default_price()
    {
        $this->getPrice()->shouldReturn(0);
    }

    function it_should_return_desired_price()
    {
        $itemPrice = 10;
        $this->setPrice($itemPrice);
        $this->getPrice()->shouldReturn($itemPrice);
    }

    function it_should_return_desired_description()
    {
        $itemDescription = 'Test item description';
        $this->setDescription($itemDescription);
        $this->getDescription()->shouldReturn($itemDescription);
    }

    function it_should_return_default_quantity()
    {
        $this->getQuantity()->shouldReturn(0);
    }

    function it_should_return_desired_quantity()
    {
        $itemQuantity = 14;
        $this->setQuantity($itemQuantity);
        $this->getQuantity()->shouldReturn($itemQuantity);
    }
}
